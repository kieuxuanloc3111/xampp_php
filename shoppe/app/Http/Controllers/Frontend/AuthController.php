<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Hiển thị form register
    public function registerForm()
    {
        return view('frontend.member.register');
    }

    // Xử lý register
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),

            // QUAN TRỌNG
            'level'    => 0, // MEMBER
        ]);

        return redirect()->route('member.login')
                        ->with('success', 'Register success! Please login.');

    }
}
