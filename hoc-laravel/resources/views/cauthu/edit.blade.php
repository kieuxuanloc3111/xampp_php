@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Sửa cầu thủ</h2>

    @if ($errors->any())
        <div style="color:red; margin-bottom:10px">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/cauthu/update/'.$cauthu->id) }}"
        method="POST"
        enctype="multipart/form-data">
        @csrf

        <input type="text" name="name"
               value="{{ old('name', $cauthu->name) }}">
        <input type="number" name="age"
               value="{{ old('age', $cauthu->age) }}">
        <input type="number" name="salary"
               value="{{ old('salary', $cauthu->salary) }}">

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
