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
            'avatar'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $avatarPath = null;

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/avatars'), $fileName);

            $avatarPath = 'uploads/avatars/' . $fileName;
        }

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'avatar'   => $avatarPath,
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
            return redirect('/blog/');
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/member/login');
    }



}
