<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Menampilkan semua pengguna yang ada di database
    public function showUsers()
    {
        // Ambil data pengguna yang sudah ada sebelum hari ini
        $users = User::where('created_at', '<', now()->subDay())->get();
        
        return view('users', ['users' => $users]); // Tampilkan semua pengguna
    }

    // Menghapus pengguna dari database
    public function deleteUser($id)
    {
        if (Auth::user()->role === 'admin') {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route('users')->with('success', 'Pengguna berhasil dihapus.');
        } else {
            return redirect()->route('users')->with('error', 'Anda tidak memiliki izin untuk melakukan operasi ini.');
        }
    }

    // Mengubah peran pengguna
    public function setRole(Request $request, $id)
    {
        if (Auth::user()->role === 'admin') {
            $user = User::findOrFail($id);
            $user->role = $request->input('role');
            $user->save();

            return redirect()->route('users')->with('success', 'Role pengguna berhasil diubah.');
        } else {
            return redirect()->route('users')->with('error', 'Anda tidak memiliki izin untuk melakukan operasi ini.');
        }
    }
}
