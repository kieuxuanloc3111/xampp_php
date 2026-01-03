@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Thêm sản phẩm</h2>

    <form method="POST" action="/products">
        @csrf

        <p>
            Tên sản phẩm:<br>
            <input type="text" name="name">
        </p>

        <p>
            Giá:<br>
            <input type="number" name="price">
        </p>

        <p>
            Số lượng:<br>
            <input type="number" name="quantity">
        </p>

        <p>
            Danh mục:<br>
            <select name="category_id">
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </p>

        <button type="submit">Lưu</button>
    </form>
</div>
@endsection
