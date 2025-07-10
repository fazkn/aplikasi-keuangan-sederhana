@extends('layout')

@section('content')
<h4 class="mb-4">Daftar Kategori</h4>

<a href="{{ route('kategori.create') }}" class="btn btn-primary mb-3">+ Tambah Kategori Baru</a>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if($kategori->isEmpty())
    <div class="alert alert-info text-center">
        Belum ada kategori. Silakan tambahkan kategori baru.
    </div>
@else
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-sm">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nama Kategori</th>
                    <th>Tipe</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kategori as $index => $k)
                <tr>
                    <td>{{ $kategori->firstItem() + $index }}</td>
                    <td>{{ $k->nama_kategori }}</td>
                    <td>
                        <span class="badge {{ $k->tipe === 'pemasukan' ? 'bg-success' : 'bg-danger'}}">
                            {{ ucfirst($k->tipe) }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                        <a href="{{ route('kategori.edit', $k->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                        <form action="{{ route('kategori.destroy', $k->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus kategori ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Hapus</button>
                        </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $kategori->links() }}
    </div>
@endif

<div class="d-flex justify-content-between mt-3">
    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">
        ← Kembali ke Transaksi
    </a>
</div>

@endsection