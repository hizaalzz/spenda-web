@extends('layouts.auth')
@section('title', 'Login Admin')
@section('content')
<div class="col d-flex align-items-center bg-white">
    <div class="p-4 w-100">
        <a href="{{ route('login') }}"><i class="mdi mdi-keyboard-backspace"></i> Login Siswa</a>

        @include('messages.alert')

        <div class="bg-white d-flex flex-column pt-4 pb-0">
            <h1><strong>Login Guru</strong></h1>
        </div>
        <div class="pt-4">
            {!! Form::open(['route' => 'admin.login', 'method' => 'POST']) !!}
            @csrf
            <div class="form-group">
                <label for="Email">Email</label>
                {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Masukkan Email',
                'required']) !!}
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' =>
                'Masukkan Password',
                'required']) !!}
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mt-3">
                <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log In</button>
            </div>

            {!! Form::close() !!}

            <x-footer-auth></x-footer-auth>
        </div>
    </div>
</div>
<div class="col d-none d-md-flex d-lg-flex justify-content-center bg-white">
    <img src="{{ asset('/images/guru.jpg') }}" width="200px" height="500px" style="margin-top: 100px" alt="" class="w-75">
</div>
@endsection
