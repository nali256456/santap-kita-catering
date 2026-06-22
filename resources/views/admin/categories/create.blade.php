@extends('layouts.admin')

@section('title', 'Tambah Kategori')
@section('page-title', 'Tambah Kategori')

@section('content')
<div class="panel" style="max-width: 560px;">
    <h3>Form Tambah Kategori</h3>
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="category_name">Nama Kategori</label>
            <input type="text" id="category_name" name="category_name" class="form-control" value="{{ old('category_name') }}" placeholder="Contoh: Paket Harian">
            @error('category_name')<span class="form-error">{{ $message }}</span>@enderror
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Simpan Kategori</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection
