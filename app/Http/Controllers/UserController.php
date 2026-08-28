<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    private function authorizeManage()
    {
        $currentUser = auth()->user();
        if (!$currentUser || !$currentUser->is_admin) {
            abort(403, 'Unauthorized action. Only administrators can perform this request.');
        }
    }

    public function index()
    {
        $this->authorizeManage();

        $users = User::all();

        return view('users.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        $this->authorizeManage();
        return view('users.create');
    }

    public function store(Request $request)
    {
        $this->authorizeManage();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'pre_verified' => ['nullable', 'boolean'],
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->created_by = auth()->id();
        $user->is_admin = false;
        $user->email_verified_at = $request->boolean('pre_verified') ? now() : null;
        $user->save();

        return redirect()->route('dashboard')->with('status', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $this->authorizeManage();
        return view('users.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        $this->authorizeManage();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('dashboard')->with('status', 'User details updated successfully.');
    }

    public function resetPassword(Request $request, User $user)
    {
        $this->authorizeManage();

        $request->validate([
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user->password = $request->password;
        $user->save();

        return redirect()->route('dashboard')->with('status', 'User password reset successfully.');
    }

    public function toggleBlock(User $user)
    {
        $this->authorizeManage();

        if ($user->id === auth()->id()) {
            return back()->withErrors(['error' => 'You cannot block yourself.']);
        }

        $user->is_ban = !$user->is_ban;
        $user->save();

        if ($user->is_ban) {
            DB::table('sessions')->where('user_id', $user->id)->delete();
        }

        $status = $user->is_ban ? 'User blocked successfully.' : 'User unblocked successfully.';
        return redirect()->route('dashboard')->with('status', $status);
    }

    public function toggleAdmin(User $user)
    {
        $this->authorizeManage();

        if ($user->id === auth()->id()) {
            return back()->withErrors(['error' => 'You cannot change your own admin role.']);
        }

        $user->is_admin = !$user->is_admin;
        $user->save();

        $status = $user->is_admin ? 'User promoted to Admin.' : 'User demoted from Admin.';
        return redirect()->route('dashboard')->with('status', $status);
    }

    public function destroy(User $user)
    {
        $this->authorizeManage();

        if ($user->id === auth()->id()) {
            return back()->withErrors(['error' => 'You cannot delete yourself.']);
        }

        DB::transaction(function () use ($user) {
            DB::table('archived_users')->insert([
                'name' => $user->name,
                'email' => $user->email,
                'password' => $user->password,
                'is_admin' => $user->is_admin,
                'is_ban' => $user->is_ban,
                'original_created_at' => $user->created_at,
                'original_updated_at' => $user->updated_at,
                'archived_at' => now(),
            ]);

            $user->delete();
        });

        return redirect()->route('dashboard')->with('status', 'User archived and deleted.');
    }
}
