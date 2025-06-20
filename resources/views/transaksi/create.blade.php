@extends('layout')

@section('content')
<h4 class="mb-4">Tambah Transaksi</h4>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ route('transaksi.store') }}">
    @csrf
    <div class="mb-3">
        <label>Tanggal</label>
        <input type="date" name="tanggal" class="form-control" value="{{old('tanggal')}}" required>
    </div>
    <div class="mb-3">
        <label>Jenis Transaksi</label>
        <select name="tipe" class="form-control" required>
            <option value="pemasukan" {{ old('tipe') == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
            <option value="pengeluaran" {{ old('tipe') == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
        </select>
    </div>
        <div class="mb-3">
        <label>Kategori</label>
        <select name="kategori" class="form-control" required>
            <option value="">-- Pilih Kategori --</option>
            <option value="Gaji" {{ old('kategori') == 'Gaji' ? 'selected' : '' }}>Gaji</option>
            <option value="Makan" {{ old('kategori') == 'Makan' ? 'selected' : '' }}>Makan</option>
            <option value="Transport" {{ old('kategori') == 'Transport' ? 'selected' : '' }}>Transport</option>
            <option value="Hiburan" {{ old('kategori') == 'Hiburan' ? 'selected' : '' }}>Hiburan</option>
            <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Deskripsi</label>
        <input type="text" name="deskripsi" class="form-control" placeholder="Contoh: Gaji bulan Juni" value="{{old('deskripsi')}}" required>
    </div>
    <div class="mb-3">
        <label>Jumlah <small class="text-muted">(dalam Rupiah)</small></label>
        <input type="number" name="jumlah" class="form-control" value="{{old('jumlah')}}" required>
    </div>
    <button class="btn btn-success">Simpan</button>
</form>
@endsection
