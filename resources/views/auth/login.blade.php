@extends('layouts.auth')
@section('title', 'Login Murid')
@section('content')
<div class="col d-none d-md-flex d-lg-flex justify-content-center bg-white">
    <img src="{{ asset('/images/siswa-removebg.png') }}" width="200px" height="500px" style="margin-top: 100px" alt="" class="w-75">
</div>
<div class="col d-flex align-items-center bg-white">
    <div class="p-4 w-100">
        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.login') }}">Login Guru <i class="mdi mdi-arrow-right"></i></a>
        </div>

        @include('messages.alert')
        
        <div class="bg-white d-flex flex-column pt-4 pb-0">
            <h1><strong>Selamat Datang</strong></h1>
            <p>Login untuk melanjutkan</p>
        </div>
        <div class="pt-4">
            {!! Form::open(['route' => 'login', 'method' => 'POST']) !!}
            @csrf
            <div class="form-group">
                <label for="nis">NISN</label>
                {!! Form::text('nis', null, ['class' => 'form-control', 'id' => 'nis', 'placeholder' => 'Nomor Induk Siswa Nasional',
                'required']) !!}
                @error('nis')
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
@endsection
