@extends('layouts.main')

@section('title', 'Login')

@section('content')

    <h2>Login</h2>

    <form method="POST" action="/login">
        @csrf

        Username:
        <input type="text" name="username">
        <br><br>

        Password:
        <input type="password" name="password">
        <br><br>

        <button type="submit">Send</button>
    </form>

@endsection
