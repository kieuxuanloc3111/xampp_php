@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Sửa cầu thủ</h2>

    <form action="{{ url('/cauthu/update/'.$cauthu->id) }}"
        method="POST"
        enctype="multipart/form-data">
        @csrf

        <input type="text" name="name" value="{{ $cauthu->name }}">
        <input type="number" name="age" value="{{ $cauthu->age }}">
        <input type="number" name="salary" value="{{ $cauthu->salary }}">

        <br><br>

        <input type="file" name="image">

        @if ($cauthu->image)
            <br>
            <img src="{{ asset('uploads/cauthu/'.$cauthu->image) }}" width="100">
        @endif

        <br><br>

        <button type="submit">Cập nhật</button>
    </form>

</div>
@endsection
