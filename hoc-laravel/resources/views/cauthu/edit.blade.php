@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Sửa cầu thủ</h2>

    <form action="/cauthu/update/{{ $cauthu->id }}" method="POST">
        @csrf

        <div>
            <label>Tên cầu thủ</label><br>
            <input type="text" name="name" value="{{ $cauthu->name }}">
        </div>

        <br>

        <div>
            <label>Tuổi</label><br>
            <input type="number" name="age" value="{{ $cauthu->age }}">
        </div>

        <br>

        <div>
            <label>Lương</label><br>
            <input type="number" name="salary" value="{{ $cauthu->salary }}">
        </div>

        <br>

        <button type="submit">Cập nhật</button>
        <a href="/cauthu">Quay lại</a>
    </form>
</div>
@endsection
