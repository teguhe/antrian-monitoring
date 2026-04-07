<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query();

        // Search by nama atau email
        if ($request->filled('search')) {
            $users->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // Filter role
        if ($request->filled('role') && $request->role !== 'all') {
            $users->where('role', $request->role);
        }

        // Filter status aktif/nonaktif
        if ($request->filled('status') && $request->status !== 'all') {
            $users->where('is_active', $request->status === 'active');
        }

        $users = $users->orderByRaw("CASE role 
            WHEN 'superadmin' THEN 1 
            WHEN 'admin' THEN 2 
            WHEN 'admin_loket' THEN 3 
            ELSE 4 
        END")
        ->orderBy('name', 'asc')
        ->paginate(15)
        ->appends($request->only(['search', 'role', 'status']));

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
