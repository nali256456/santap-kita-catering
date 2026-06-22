@extends('layouts.app')

@section('title', 'Masuk')

@section('content')
<div class="auth-wrap">
    <div class="auth-card">
        <div class="auth-head">
            <img src="{{ asset('images/logo.png') }}" alt="SantapKita" class="brand-mark" style="display:inline-flex;">
            <h2>Selamat Datang Kembali</h2>
            <p>Masuk untuk memesan catering favorit Anda</p>
        </div>

        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="email@anda.com" autofocus>
                @error('email')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password">
                @error('password')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group" style="display:flex; justify-content: space-between; align-items:center;">
                <label class="form-check">
                    <input type="checkbox" name="remember"> Ingat saya
                </label>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
            <a href="{{ route('google.login') }}" class="btn btn-outline btn-block" style="margin-top:10px;">  Masuk dengan Google </a>
        </form>

        <div class="auth-footer">
            Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
        </div>
    </div>
</div>
@endsection
