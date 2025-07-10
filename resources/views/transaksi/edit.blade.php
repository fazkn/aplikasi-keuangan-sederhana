@extends('layout')

@section('content')
<h4 class="mb-4">Edit Transaksi</h4>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{route('transaksi.update', $transaksi->id)}}">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Tanggal</label>
        <input type="date" name="tanggal" class="form-control" value="{{old('tanggal', $transaksi->tanggal)}}" required>
    </div>
    <div class="mb-3">
        <label>Jenis Transaksi</label>
        <select name="tipe" class="form-control" required>
            <option value="pemasukan" {{ old('tipe', $transaksi->tipe) == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
            <option value="pengeluaran" {{ old('tipe', $transaksi->tipe) == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
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
                    <option value="{{ $k->id }}" data-tipe="pemasukan"
                        {{ old('kategori_id', $transaksi->kategori_id) == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kategori}}</option>
                @endforeach
            @endif

            @if ($pengeluaranKategori->isEmpty())
                <option value="" disabled>Belum ada kategori Pengeluaran</option>
            @else
                @foreach ($pengeluaranKategori as $k)
                    <option value="{{ $k->id }}" data-tipe="pengeluaran"
                        {{ old('kategori_id', $transaksi->kategori_id) == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kategori}}</option>
                @endforeach
            @endif
        </select>

    </div>
    <div class="mb-3">
        <label>Deskripsi</label>
        <input type="text" name="deskripsi" class="form-control" value="{{ old('deskripsi', $transaksi->deskripsi) }}" required>
    </div>
    <div class="mb-3">
        <label>Jumlah</label>
        <input type="number" name="jumlah" class="form-control" value="{{ old('jumlah', $transaksi->jumlah) }}" required>
    </div>
    <button class="btn btn-success">Update</button>
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
        filterKategori();
    });
</script>
@endpush
