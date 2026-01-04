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
            <td>
                <a href="/products/{{ $product->id }}/edit">Sửa</a>

                <form action="/products/{{ $product->id }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Xóa sản phẩm này?')">
                        Xóa
                    </button>
                </form>
            </td>

        </tr>
        @endforeach
    </table>
</div>
@endsection
