<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Menampilkan semua pengguna yang ada di database
    public function showUsers()
    {
        $users = User::where('created_at', '<', now()->subDay())->get(); // Ambil data pengguna yang sudah ada sebelum hari ini
        return view('users', ['users' => $users]); // Tampilkan semua pengguna
    }

    // Menambahkan pengguna baru ke dalam database
    public function addUser(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        return redirect()->route('users')->with('success', 'Pengguna baru berhasil ditambahkan.');
    }

    // Menghapus pengguna dari database
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users')->with('success', 'Pengguna berhasil dihapus.');
    }
}