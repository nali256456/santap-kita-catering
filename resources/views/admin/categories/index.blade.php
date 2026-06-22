@extends('layouts.admin')

@section('title', 'Kelola Kategori')
@section('page-title', 'Kelola Kategori')

@section('content')
<div class="panel">
    <div class="panel-head">
        <h3>Daftar Kategori</h3>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">+ Tambah Kategori</a>
    </div>

    @if($categories->count() > 0)
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr><th>Nama Kategori</th><th>Jumlah Paket</th><th>Dibuat</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @foreach($categories as $cat)
                        <tr>
                            <td>{{ $cat->category_name }}</td>
                            <td><span class="badge badge-secondary">{{ $cat->packages_count }} paket</span></td>
                            <td>{{ $cat->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.categories.edit', $cat) }}" class="btn btn-outline btn-sm">Edit</a>
                                    <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST" data-confirm="Hapus kategori ini?">
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
        <div class="pagination-wrap">{{ $categories->links() }}</div>
    @else
        <div class="empty-state"><div class="emoji">🏷️</div><p>Belum ada kategori.</p></div>
    @endif
</div>
@endsection
