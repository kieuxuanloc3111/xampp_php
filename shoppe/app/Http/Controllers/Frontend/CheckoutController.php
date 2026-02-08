<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\History;
use App\Mail\MailNotify;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('home');
        }

        return view('frontend.checkout.index', compact('cart'));
    }

    public function process(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('home');
        }

        // ======================
        // LOGIN / REGISTER NHANH
        // ======================
        if (!Auth::check()) {

            $request->validate([
                'email'    => 'required|email|unique:users,email',
                'password' => 'required|min:6'
            ]);

            $user = User::create([
                'name'     => $request->name ,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'level'    => 0
            ]);

            Auth::login($user);

        } else {
            $user = Auth::user();
        }

        // ======================
        // TÍNH TỔNG TIỀN
        // ======================
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        // ======================
        // LƯU HISTORY
        // ======================
        History::create([
            'id_user' => $user->id,
            'name'    => $request->name ?? $user->name,
            'email'   => $user->email,
            'phone'   => $request->phone,
            'price'   => $total
        ]);

        // ======================
        // SEND MAIL
        // ======================
        Mail::to($user->email)->send(
            new MailNotify($cart, $total, $user)
        );

        // ======================
        // CLEAR CART
        // ======================
        session()->forget('cart');

        return redirect()->route('home')
                         ->with('success', 'Checkout thành công!');
    }
}
