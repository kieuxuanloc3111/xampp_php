@extends('layouts.app')

@section('title', 'Profile')

@section('content')

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Profile</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">

    {{-- HIỂN THỊ LỖI VALIDATE --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">

        <!-- LEFT PROFILE -->
        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card">
                <div class="card-body">
                    <center class="m-t-30">
                        <img
                            src="{{ $user->avatar
                                    ? asset($user->avatar)
                                    : asset('assets/images/users/5.jpg') }}"
                            class="rounded-circle"
                            width="150"
                        />

                        <h4 class="card-title m-t-10">{{ $user->name }}</h4>
                        <h6 class="card-subtitle">{{ $user->email }}</h6>
                    </center>
                </div>
                <div><hr></div>
                <div class="card-body">
                    <small class="text-muted">Phone</small>
                    <h6>{{ $user->phone }}</h6>

                    <small class="text-muted p-t-30 db">Address</small>
                    <h6>{{ $user->address }}</h6>
                </div>
            </div>
        </div>

        <!-- RIGHT FORM -->
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">
                <div class="card-body">

                    <form method="POST"
                          action="{{ route('admin.profile.update') }}"
                          enctype="multipart/form-data">
                        @csrf

                        <!-- USERNAME -->
                        <div class="form-group">
                            <label class="col-md-12">Username</label>
                            <div class="col-md-12">
                                <input
                                    type="text"
                                    name="name"
                                    value="{{ old('name', $user->name) }}"
                                    class="form-control form-control-line"
                                    required
                                >
                            </div>
                        </div>

                        <!-- EMAIL (READONLY) -->
                        <div class="form-group">
                            <label class="col-md-12">Email</label>
                            <div class="col-md-12">
                                <input
                                    type="email"
                                    name="email"
                                    value="{{ $user->email }}"
                                    class="form-control form-control-line"
                                    readonly
                                >
                            </div>
                        </div>

                        <!-- PASSWORD (OPTIONAL) -->
                        <div class="form-group">
                            <label class="col-md-12">New Password</label>
                            <div class="col-md-12">
                                <input
                                    type="password"
                                    name="password"
                                    class="form-control form-control-line"
                                    placeholder="Leave blank if you don't want to change"
                                >
                            </div>
                        </div>

                        <!-- PHONE -->
                        <div class="form-group">
                            <label class="col-md-12">Phone</label>
                            <div class="col-md-12">
                                <input
                                    type="text"
                                    name="phone"
                                    value="{{ old('phone', $user->phone) }}"
                                    class="form-control form-control-line"
                                >
                            </div>
                        </div>

                        <!-- ADDRESS -->
                        <div class="form-group">
                            <label class="col-md-12">Address</label>
                            <div class="col-md-12">
                                <textarea
                                    name="address"
                                    rows="3"
                                    class="form-control form-control-line"
                                >{{ old('address', $user->address) }}</textarea>
                            </div>
                        </div>

                        <!-- COUNTRY -->
                        <div class="form-group">
                            <label class="col-sm-12">Select Country</label>
                            <div class="col-sm-12">
                                <select name="id_country" class="form-control form-control-line">
                                    <option value="">-- Select country --</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}"
                                            {{ old('id_country', $user->id_country) == $country->id ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- AVATAR -->
                        <div class="form-group">
                            <label class="col-md-12">Avatar</label>
                            <div class="col-md-12">
                                <input
                                    type="file"
                                    name="avatar"
                                    class="form-control form-control-line"
                                >
                                <small class="text-muted">
                                    Image only (jpeg, png, jpg, gif) – max 1MB
                                </small>
                            </div>
                        </div>

                        <!-- SUBMIT -->
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success">
                                    Update Profile
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>
</div>

@endsection
