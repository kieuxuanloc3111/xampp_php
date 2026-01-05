@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Thêm cầu thủ</h2>

    <form action="/cauthu/store" method="POST">
        @csrf

        <div>
            <label>Tên cầu thủ</label><br>
            <input type="text" name="name">
        </div>

        <br>

        <div>
            <label>Tuổi</label><br>
            <input type="number" name="age">
        </div>

        <br>

        <div>
            <label>Lương</label><br>
            <input type="number" name="salary">
        </div>

        <br>

        <button type="submit">Lưu</button>
        <a href="/players">Quay lại</a>
    </form>
</div>
@endsection
