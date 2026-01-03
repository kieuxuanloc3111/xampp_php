@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Danh sách sản phẩm</h2>

    <a href="/products/create">+ Thêm sản phẩm</a>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Danh mục</th>
        </tr>

        @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ number_format($product->price) }} đ</td>
            <td>{{ $product->quantity }}</td>
            <td>
                {{ $product->category ? $product->category->name : 'Chưa có' }}
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
