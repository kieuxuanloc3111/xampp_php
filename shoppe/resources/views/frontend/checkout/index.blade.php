@extends('frontend.layouts.app')

@section('title', 'Checkout')

@section('content')

<section id="cart_items">
    <div class="container">

        {{-- BREADCRUMB --}}
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="active">Checkout</li>
            </ol>
        </div>

        {{-- THÔNG TIN NGƯỜI MUA --}}
        <div class="shopper-informations">
            <div class="row">

                {{-- CỘT TRÁI: ĐĂNG KÝ NHANH (CHỈ HIỆN KHI CHƯA LOGIN) --}}
                @guest
                <div class="col-sm-4">
                    <div class="shopper-info">
                        <p>Register & Checkout</p>

                        <form method="POST" action="{{ route('checkout.process') }}">
                            @csrf

                            <input type="email"
                                   name="email"
                                   placeholder="Email"
                                   required>

                            <input type="password"
                                   name="password"
                                   placeholder="Password"
                                   required>

                            <input type="text"
                                   name="name"
                                   placeholder="Your Name">

                            <input type="text"
                                   name="phone"
                                   placeholder="Phone">

                            <button type="submit"
                                    class="btn btn-primary">
                                Continue
                            </button>
                        </form>
                    </div>
                </div>
                @endguest

                {{-- CỘT PHẢI: ĐÃ LOGIN --}}
                @auth
                <div class="col-sm-4">
                    <div class="shopper-info">
                        <p>Shopper Information</p>

                        <form method="POST" action="{{ route('checkout.process') }}">
                            @csrf

                            <input type="text"
                                   name="name"
                                   value="{{ auth()->user()->name ?? auth()->user()->email }}"
                                   placeholder="Your Name">

                            <input type="text"
                                name="phone"
                                value="{{ auth()->user()->phone ?? '' }}"
                                placeholder="Phone">


                            <button type="submit"
                                    class="btn btn-primary">
                                Continue
                            </button>
                        </form>
                    </div>
                </div>
                @endauth

                {{-- TÓM TẮT ĐƠN HÀNG --}}
                <div class="col-sm-8">
                    <div class="table-responsive cart_info">
                        <table class="table table-condensed">
                            <thead>
                                <tr class="cart_menu">
                                    <td>Item</td>
                                    <td>Price</td>
                                    <td>Qty</td>
                                    <td>Total</td>
                                </tr>
                            </thead>
                            <tbody>

                            @php $total = 0; @endphp

                            @foreach($cart as $item)
                                @php
                                    $rowTotal = $item['price'] * $item['qty'];
                                    $total += $rowTotal;
                                @endphp
                                <tr>
                                    <td>{{ $item['name'] }}</td>
                                    <td>${{ $item['price'] }}</td>
                                    <td>{{ $item['qty'] }}</td>
                                    <td>${{ $rowTotal }}</td>
                                </tr>
                            @endforeach

                            <tr>
                                <td colspan="3"><b>Total</b></td>
                                <td><b>${{ $total }}</b></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

@endsection
