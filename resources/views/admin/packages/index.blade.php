@extends('layouts.admin')

@section('title', 'Kelola Paket')
@section('page-title', 'Kelola Paket Catering')

@section('content')
<div class="panel">
    <div class="panel-head">
        <h3>Daftar Paket Catering</h3>
        <a href="{{ route('admin.packages.create') }}" class="btn btn-primary">+ Tambah Paket</a>
    </div>

    <form action="{{ route('admin.packages.index') }}" method="GET" style="margin-bottom: 20px;">
        <input type="text" name="search" class="form-control" style="max-width: 320px;" placeholder="Cari paket..." value="{{ request('search') }}">
    </form>

    @if($packages->count() > 0)
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr><th>Gambar</th><th>Nama Paket</th><th>Kategori</th><th>Harga</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @foreach($packages as $pkg)
                        <tr>
                            <td>
                                <div style="width:50px; height:50px; border-radius:8px; overflow:hidden; background: var(--cream-deep); display:flex; align-items:center; justify-content:center;">
                                    @if($pkg->image)
                                        <img src="{{ $pkg->image_url }}" alt="{{ $pkg->package_name }}" style="width:100%; height:100%; object-fit:cover;">
                                    @else
                                        <span>🍱</span>
                                    @endif
                                </div>
                            </td>
                            <td>{{ $pkg->package_name }}</td>
                            <td><span class="badge badge-secondary">{{ $pkg->category->category_name }}</span></td>
                            <td>{{ $pkg->formatted_price }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.packages.edit', $pkg) }}" class="btn btn-outline btn-sm">Edit</a>
                                    <form action="{{ route('admin.packages.destroy', $pkg) }}" method="POST" data-confirm="Hapus paket ini?">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination-wrap">{{ $packages->links() }}</div>
    @else
        <div class="empty-state"><div class="emoji">🍱</div><p>Belum ada paket catering.</p></div>
    @endif
</div>
@endsection
