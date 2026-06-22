@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="page-banner">
    <div class="container">
        <h1>Profil Saya</h1>
        <p class="breadcrumb"><a href="{{ route('home') }}">Beranda</a> / Profil Saya</p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="detail-grid" style="align-items:start;">
            <div class="panel">
                <h3>Informasi Akun</h3>
                <form action="{{ route('member.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                        @error('name')<span class="form-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" value="{{ $user->email }}" disabled style="background: var(--cream-deep);">
                        <span class="form-hint">Email tidak dapat diubah.</span>
                    </div>
                    <div class="form-group">
                        <label for="phone">No. Telepon</label>
                        <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                        @error('phone')<span class="form-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <textarea id="address" name="address" class="form-control" rows="3">{{ old('address', $user->address) }}</textarea>
                        @error('address')<span class="form-error">{{ $message }}</span>@enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>

            <div class="panel">
                <h3>Ubah Password</h3>
                <form action="{{ route('member.profile.password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="current_password">Password Saat Ini</label>
                        <input type="password" id="current_password" name="current_password" class="form-control">
                        @error('current_password')<span class="form-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password Baru</label>
                        <input type="password" id="password" name="password" class="form-control">
                        @error('password')<span class="form-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password Baru</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Perbarui Password</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
