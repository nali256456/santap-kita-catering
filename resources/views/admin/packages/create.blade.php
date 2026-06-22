@extends('layouts.admin')

@section('title', 'Tambah Paket')
@section('page-title', 'Tambah Paket Catering')

@section('content')
<div class="panel" style="max-width: 680px;">
    <h3>Form Tambah Paket Catering</h3>
    <form action="{{ route('admin.packages.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="category_id">Kategori</label>
            <select id="category_id" name="category_id" class="form-control">
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->category_name }}</option>
                @endforeach
            </select>
            @error('category_id')<span class="form-error">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
            <label for="package_name">Nama Paket</label>
            <input type="text" id="package_name" name="package_name" class="form-control" value="{{ old('package_name') }}" placeholder="Contoh: Nasi Kotak Harian">
            @error('package_name')<span class="form-error">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea id="description" name="description" class="form-control" rows="4" placeholder="Deskripsi paket catering">{{ old('description') }}</textarea>
            @error('description')<span class="form-error">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
            <label for="price">Harga per Porsi (Rp)</label>
            <input type="number" id="price" name="price" class="form-control" value="{{ old('price') }}" placeholder="25000">
            @error('price')<span class="form-error">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
            <label for="image">Gambar Paket</label>
            <input type="file" id="image" name="image" class="form-control" accept="image/*" data-preview="previewImg">
            @error('image')<span class="form-error">{{ $message }}</span>@enderror
            <img id="previewImg" style="display:none; margin-top:10px; border-radius:8px; max-height:200px;">
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Simpan Paket</button>
            <a href="{{ route('admin.packages.index') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection
