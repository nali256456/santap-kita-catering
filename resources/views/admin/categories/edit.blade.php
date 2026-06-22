@extends('layouts.admin')

@section('title', 'Edit Kategori')
@section('page-title', 'Edit Kategori')

@section('content')
<div class="panel" style="max-width: 560px;">
    <h3>Form Edit Kategori</h3>
    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="category_name">Nama Kategori</label>
            <input type="text" id="category_name" name="category_name" class="form-control" value="{{ old('category_name', $category->category_name) }}">
            @error('category_name')<span class="form-error">{{ $message }}</span>@enderror
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection
