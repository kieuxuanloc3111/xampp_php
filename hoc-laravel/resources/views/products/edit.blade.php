@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Chỉnh sửa sản phẩm</h2>

    <form method="POST" action="/products/{{ $product->id }}">
        @csrf
        @method('PUT')

        <p>
            Tên sản phẩm:<br>
            <input type="text" name="name" value="{{ $product->name }}">
        </p>

        <p>
            Giá:<br>
            <input type="number" name="price" value="{{ $product->price }}">
        </p>

        <p>
            Số lượng:<br>
            <input type="number" name="quantity" value="{{ $product->quantity }}">
        </p>

        <p>
            Danh mục:<br>
            <select name="category_id">
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}"
                        {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </p>

        <button type="submit">Cập nhật</button>
    </form>
</div>
@endsection
