@extends('layouts.main')

@section('title', 'Trang chủ')

@section('content')
    <h1>Xin chào {{ $name }} 👋</h1>
    <p>Tuổi của bạn là: {{ $age }}</p>
@endsection
