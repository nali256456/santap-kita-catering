@extends('layouts.admin')

@section('title', 'Edit Pengguna')
@section('page-title', 'Edit Pengguna')

@section('content')
<div class="panel" style="max-width: 600px;">
    <h3>Form Edit Pengguna</h3>
    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}">
            @error('name')<span class="form-error">{{ $message }}</span>@enderror
        </div>
        <div class="form-row">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                @error('email')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="phone">No. Telepon</label>
                <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
            </div>
        </div>
        <div class="form-group">
            <label for="address">Alamat</label>
            <textarea id="address" name="address" class="form-control" rows="2">{{ old('address', $user->address) }}</textarea>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label for="role">Role</label>
                <select id="role" name="role" class="form-control" {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                    <option value="member" {{ $user->role == 'member' ? 'selected' : '' }}>Member</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @if($user->id === auth()->id())
                    <input type="hidden" name="role" value="{{ $user->role }}">
                    <span class="form-hint">Anda tidak dapat mengubah role akun sendiri.</span>
                @endif
            </div>
            <div class="form-group">
                <label for="password">Password Baru (opsional)</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diubah">
                @error('password')<span class="form-error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection
