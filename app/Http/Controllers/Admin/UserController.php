<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')
            ->orderBy('id', 'asc')
            ->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'is_admin' => 'nullable|boolean',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        // Check if the user is an admin
        if ($request->has('is_admin') && $request->input('is_admin')) {
            $validated['is_admin'] = true;
        } else {
            $validated['is_admin'] = false;
        }
        // Attempt to create the user
        try {
            User::create($validated);
        } catch (\Exception $e) {
            ToastMagic::error('Failed to create user: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }

        ToastMagic::success('User created successfully.');
        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'is_admin' => 'nullable|boolean',
        ]);
        if ($validated['password'] ?? null) {
            $user->password = Hash::make($validated['password']);
        }
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Check if the user is an admin
        if ($request->has('is_admin') && $request->input('is_admin')) {
            $user->is_admin = true;
        } else {
            $user->is_admin = false;
        }
        // Attempt to update the user
        try {
            $user->save();
        } catch (\Exception $e) {
            ToastMagic::error('Failed to update user: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
        ToastMagic::success('User updated successfully.');
        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        ToastMagic::success('User deleted successfully.');
        return redirect()->route('admin.users.index');
    }
}
