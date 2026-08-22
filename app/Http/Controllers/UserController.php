<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    private function checkAdmin()
    {
        if (! auth()->user()?->is_admin) {
            abort(403, 'Unauthorized action. Only administrators can perform this request.');
        }
    }

    public function index()
    {
        $this->checkAdmin();
        $users = User::all();

        return view('users.index', [
            'users' => $users
        ]);
    }

    public function edit(User $user)
    {
        $this->checkAdmin();
        return view('users.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        $this->checkAdmin();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('users.index')->with('status', 'User details updated successfully.');
    }

    public function resetPassword(Request $request, User $user)
    {
        $this->checkAdmin();

        $request->validate([
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('users.index')->with('status', 'User password reset successfully.');
    }

    public function toggleBlock(User $user)
    {
        $this->checkAdmin();

        if ($user->id === auth()->id()) {
            return back()->withErrors(['error' => 'You cannot block yourself.']);
        }

        $user->is_ban = !$user->is_ban;
        $user->save();

        if ($user->is_ban) {
            DB::table('sessions')->where('user_id', $user->id)->delete();
        }

        $status = $user->is_ban ? 'User blocked successfully.' : 'User unblocked successfully.';
        return redirect()->route('users.index')->with('status', $status);
    }

    public function toggleAdmin(User $user)
    {
        $this->checkAdmin();

        if ($user->id === auth()->id()) {
            return back()->withErrors(['error' => 'You cannot change your own admin role.']);
        }

        $user->is_admin = !$user->is_admin;
        $user->save();

        $status = $user->is_admin ? 'User promoted to Admin.' : 'User demoted from Admin.';
        return redirect()->route('users.index')->with('status', $status);
    }

    public function destroy(User $user)
    {
        $this->checkAdmin();

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

        return redirect()->route('users.index')->with('status', 'User archived and deleted.');
    }
}
