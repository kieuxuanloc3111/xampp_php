@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')

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
                    <form method="GET" action="{{ route('advancedsearch') }}">

                    <div class="row" style="margin-bottom:20px;">

                        <div class="col-sm-2">
                            <input type="text"
                                name="name"
                                placeholder="Name"
                                value="{{ request('name') }}"
                                class="form-control">
                        </div>

                        <div class="col-sm-2">
                            <select name="price_range" class="search_box pull-right">
                                <option value="">Price</option>
                                <option value="10-100">10 - 100</option>
                                <option value="100-500">100 - 500</option>
                                <option value="500-1000">500 - 1000</option>
                            </select>
                        </div>

                        <div class="col-sm-2">
                            <select name="category_id" class="search_box pull-right">
                                <option value="">Category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-2">
                            <select name="brand_id" class="search_box pull-right">
                                <option value="">Brand</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-2">
                            <select name="status" class="search_box pull-rightl">
                                <option value="">Status</option>
                                <option value="sale">Sale</option>
                                <option value="new">New</option>
                            </select>
                        </div>

                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-primary">
                                Search
                            </button>
                        </div>

                    </div>

                    </form>

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
                                            <a href="{{ route('product.detail', $product->id) }}">
                                                <img src="{{ asset('upload/product/'.$thumb) }}" alt="">
                                            </a>
                                        @endif

                                        <!-- price -->
                                        @if($product->is_sale)
                                            <h2>
                                                <del>${{ number_format($product->price) }}</del>
                                                ${{ number_format($product->final_price) }}
                                            </h2>
                                        @else
                                            <h2>${{ number_format($product->price) }}</h2>
                                        @endif

                                        <p>{{ $product->name }}</p>

                                        <a href="javascript:void(0)"
                                        class="btn btn-default add-to-cart"
                                        data-id="{{ $product->id }}">
                                            <i class="fa fa-shopping-cart"></i>
                                            Add to cart
                                        </a>

                                    </div>

                                    <!-- overl;ay -->
                                    <div class="product-overlay">
                                        <div class="overlay-content">
                                            <h2>${{ number_format($product->final_price) }}</h2>
                                            <p>
                                                <a href="{{ route('product.detail', $product->id) }}" style="color:#fff">
                                                    {{ $product->name }}
                                                </a>
                                            </p>

                                            <a href="javascript:void(0)"
                                            class="btn btn-default add-to-cart"
                                            data-id="{{ $product->id }}">
                                                <i class="fa fa-shopping-cart"></i>
                                                Add to cart
                                            </a>

                                        </div>
                                    </div>
                                    
                                    <!-- badge -->
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
                @if(method_exists($products, 'links'))
                    <div class="text-center">
                        {{ $products->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
$(document).ready(function () {
    $('.add-to-cart').click(function () {
        let productId = $(this).data('id');

        $.ajax({
            url: "{{ route('cart.add') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                product_id: productId
            },
            success: function (res) {
                if (res.status === 'success') {
                    $('#cart-count').text(res.total);
                }
            }
        });
    });
});
</script>
@endsection
