@extends('layout')

@section('content')
<h4 class="mb-4">Tambah Kategori Baru</h4>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('kategori.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Nama Kategori</label>
        <input type="text" name="nama_kategori" class="form-control" value="{{ old('nama_kategori') }}" required>
    </div>
    <div class="mb-3">
        <label>Tipe</label>
        <select name="tipe" class="form-control" required>
            <option value="pemasukan" {{ old('tipe') == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
            <option value="pengeluaran" {{ old('tipe') == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
        </select>
    </div>
    <button class="btn btn-success">Simpan</button>
    <a href="{{ route('transaksi.create') }}" class="btn btn-primary mb-3 float-end">
    ← Kembali
    </a>
</form>
@endsection
