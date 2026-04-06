<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(15);
        return view('users', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::defaults()],
            'role' => 'required|string|in:admin,operator,viewer',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'is_active' => true,
        ]);

        if(request()->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'User berhasil ditambahkan', 'user' => $user]);
        }

        return back()->with('success', 'User berhasil ditambahkan');
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'role' => 'required|string|in:admin,operator,viewer',
            'is_active' => 'boolean',
        ]);

        $user->update($request->only('name', 'email', 'role', 'is_active'));

        return back()->with('success', 'User berhasil diperbarui');
    }

    public function destroy(User $user)
    {
        $user->delete();
        
        if(request()->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'User berhasil dihapus']);
        }
        
        return back()->with('success', 'User berhasil dihapus');
    }

    public function resetPassword(Request $request, User $user)
    {
        $request->validate([
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user->update(['password' => bcrypt($request->password)]);
        return back()->with('success', 'Password user berhasil direset');
    }
}
