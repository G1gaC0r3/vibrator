<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    // Menampilkan pengguna
    public function showUsers()
    {
        $users = User::all(); // Ambil semua data user
        return view('users', ['users' => $users]);
    }

    // Memperbarui profil pengguna
    public function updateProfile(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'birthdate' => 'required|date',
            'role_user' => 'required', // Menambahkan validasi untuk role_user
        ]);

        $user = Auth::user(); // mengganti $user menjadi $userP
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->birthdate = $request->birthdate;
        $user->role_user = $request->role_user; // Menambahkan role_user ke data yang disimpan

        $user->save();

        return redirect()->back()->with('status', 'profile-updated');
    }
}

