<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Home1Controller extends Controller
{
    // Trang chủ
    public function index()
    {
        $name = 'Kiều Xuân Lộc';
        $age=25;

        return view('home1', compact('name','age'));
    }


    // // Hiển thị form login
    // public function login()
    // {
    //     return view('login');
    // }

    // // Xử lý login
    // public function handleLogin(Request $request)
    // {
    //     $username = $request->username;
    //     $password = $request->password;

    //     return "Username: $username - Password: $password";
    // }
}
