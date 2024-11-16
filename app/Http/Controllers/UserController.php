<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return view('Users.index', compact('users'));
    }

    public function create() {
        return view('Users.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'level' => 'required|in:admin,pimpinan',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => $request->level,
        ]);

        return redirect('/user-management')->with('success', 'User berhasil ditambahkan.');
    }

    public function show_edit($id) {
        $user = User::findOrFail($id);
        return view('Users.edit', compact('user'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'level' => 'required|in:admin,pimpinan',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'level' => $request->level,
        ]);

        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:8|confirmed']);
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect('/user-management')->with('success', 'User berhasil diperbarui.');
    }

    public function delete($id) {
        User::findOrFail($id)->delete();
        return redirect('/user-management')->with('success', 'User berhasil dihapus.');
    }
}
