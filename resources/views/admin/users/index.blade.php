@extends('layouts.admin')

@section('title', 'Kelola Pengguna')
@section('page-title', 'Kelola Pengguna')

@section('content')
<div class="panel">
    <div class="panel-head">
        <h3>Daftar Pengguna</h3>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">+ Tambah Pengguna</a>
    </div>

    <form action="{{ route('admin.users.index') }}" method="GET" class="filter-bar">
        <input type="text" name="search" class="form-control" placeholder="Cari nama atau email..." value="{{ request('search') }}">
        <select name="role" class="form-control" onchange="this.form.submit()">
            <option value="">Semua Role</option>
            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="member" {{ request('role') == 'member' ? 'selected' : '' }}>Member</option>
        </select>
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>

    @if($users->count() > 0)
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr><th>Nama</th><th>Email</th><th>No. Telp</th><th>Role</th><th>Pesanan</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone ?? '-' }}</td>
                            <td><span class="badge badge-{{ $user->role === 'admin' ? 'primary' : 'secondary' }}">{{ ucfirst($user->role) }}</span></td>
                            <td>{{ $user->orders_count }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-outline btn-sm">Edit</a>
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" data-confirm="Hapus pengguna ini?">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination-wrap">{{ $users->links() }}</div>
    @else
        <div class="empty-state"><div class="emoji">👥</div><p>Belum ada pengguna.</p></div>
    @endif
</div>
@endsection
