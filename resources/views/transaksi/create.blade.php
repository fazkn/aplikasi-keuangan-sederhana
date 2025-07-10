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

<a href="{{ route('kategori.create') }}" class="btn btn-outline-primary btn-sm mb-3">
    + Tambah Kategori Baru
</a>

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
        <select name="kategori_id" id="kategori_id" class="form-control" required>
            <option value="">-- Pilih Kategori --</option>

            @if ($pemasukanKategori->isEmpty())
                <option value="" disabled>Belum ada kategori Pemasukan</option>
            @else
                @foreach ($pemasukanKategori as $k)
                    <option value="{{ $k->id }}" data-tipe="pemasukan"> {{ $k->nama_kategori}}</option>
                @endforeach
            @endif
            @if ($pengeluaranKategori->isEmpty())
                <option value="" disabled>Belum ada kategori Pengeluaran</option>
            @else
                @foreach ($pengeluaranKategori as $k)
                    <option value="{{ $k->id }}" data-tipe="pengeluaran"> {{ $k->nama_kategori}}</option>
                @endforeach
            @endif
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
    <button class="btn btn-success">
        <i class= "bi bi-save"></i>Simpan Transaksi</button>
</form>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tipeSelect = document.querySelector('select[name="tipe"]');
        const kategoriSelect = document.querySelector('select[name="kategori_id"]');

        function filterKategori() {
            const tipe = tipeSelect.value;

            Array.from(kategoriSelect.options).forEach(option => {
                const cocok = option.dataset.tipe === tipe || option.value === "";
                option.style.display = cocok ? 'block' : 'none';
            });

            if (kategoriSelect.selectedOptions.length &&
                kategoriSelect.selectedOptions[0].style.display === 'none') {
                kategoriSelect.value = "";
            }
        }

        tipeSelect.addEventListener('change', filterKategori);
        filterKategori(); // jalanin pertama kali
    });
</script>
@endpush
