<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MemberLoginRequest;


class AuthController extends Controller
{
    public function registerForm()
    {
        return view('frontend.member.register');
    }

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

            'level'    => 0, 
        ]);

        return redirect()->route('member.login')
                        ->with('success', 'Register success! Please login.');

    }
    public function loginForm()
    {
        return view('frontend.member.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = [
            'email'    => $request->email,
            'password' => $request->password,
            'level'    => 0,
        ];

        if (Auth::attempt($credentials, $request->filled('remember_me'))) {
            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng',
        ]);
    }



}
