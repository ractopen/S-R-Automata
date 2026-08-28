<?php

namespace App\Modules\UserManagement\Controllers;

use App\Http\Controllers\Controller;

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
        return redirect()->route('dashboard');
    }

    public function create()
    {
        $this->authorizeManage();
        return view('UserManagement::create');
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
        return view('UserManagement::edit', [
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

        if ($user->is_ban) {
            $user->unblock();
        } else {
            $user->block();
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

        $user->toggleAdmin();

        $status = $user->is_admin ? 'User promoted to Admin.' : 'User demoted from Admin.';
        return redirect()->route('dashboard')->with('status', $status);
    }

    public function destroy(User $user)
    {
        $this->authorizeManage();

        if ($user->id === auth()->id()) {
            return back()->withErrors(['error' => 'You cannot delete yourself.']);
        }

        $user->archive();

        return redirect()->route('dashboard')->with('status', 'User archived and deleted.');
    }
}
