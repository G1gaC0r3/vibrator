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
        $userP = Auth::user();
        return view('users', ['userP' => $userP]);
    }

    // Memperbarui profil pengguna
    public function updateProfile(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'birthdate' => 'required|date',
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $userP = Auth::user(); // mengganti $user menjadi $userP
        $userP->name = $request->name;
        $userP->email = $request->email;
        $userP->phone = $request->phone;
        $userP->birthdate = $request->birthdate;

        if ($request->hasFile('profile_picture')) {
            $imageName = time().'.'.$request->profile_picture->extension();  
            $request->profile_picture->move(public_path('images'), $imageName);
            $userP->profile_picture = $imageName;
        }

        $userP->save();

        return redirect()->back()->with('status', 'profile-updated');
    }
}

