@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')

{{-- SLIDER --}}
@include('frontend.layouts.slider')

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <div class="col-sm-3">
                    @include('frontend.layouts.menuleft')
                </div>

                <div class="features_items">
                    <h2 class="title text-center">Features Items</h2>

                    @forelse($products as $product)
                        @php
                            $images = json_decode($product->image, true);
                            $thumb = $images[0] ?? null;
                        @endphp

                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">

                                    <div class="productinfo text-center">
                                        @if($thumb)
                                            <img src="{{ asset('upload/product/'.$thumb) }}" alt="">
                                        @endif

                                        {{-- PRICE --}}
                                        @if($product->is_sale)
                                            <h2>
                                                <del>${{ number_format($product->price) }}</del>
                                                ${{ number_format($product->final_price) }}
                                            </h2>
                                        @else
                                            <h2>${{ number_format($product->price) }}</h2>
                                        @endif

                                        <p>{{ $product->name }}</p>

                                        <a href="#" class="btn btn-default add-to-cart">
                                            <i class="fa fa-shopping-cart"></i>
                                            Add to cart
                                        </a>
                                    </div>

                                    {{-- OVERLAY --}}
                                    <div class="product-overlay">
                                        <div class="overlay-content">
                                            <h2>${{ number_format($product->final_price) }}</h2>
                                            <p>{{ $product->name }}</p>

                                            <a href="#" class="btn btn-default add-to-cart">
                                                <i class="fa fa-shopping-cart"></i>
                                                Add to cart
                                            </a>
                                        </div>
                                    </div>

                                    {{-- BADGE --}}
                                    @if($product->is_sale)
                                        <div class="sale-badge">
                                            -{{ $product->sale_price }}%
                                        </div>
                                    @else
                                        <img src="{{ asset('frontend/images/home/new.png') }}"
                                             class="new"
                                             alt="">
                                    @endif

                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center">No product</p>
                    @endforelse

                </div>

            </div>
        </div>
    </div>
</section>
@endsection
