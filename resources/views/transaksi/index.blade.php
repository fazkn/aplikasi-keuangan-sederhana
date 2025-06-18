@extends('layout')

@section('content')
<a href="{{ route('transaksi.create') }}" class="btn btn-primary mb-3">+ Tambah Transaksi</a>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Jenis</th>
                <th>Kategori</th>
                <th>Deskripsi</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transaksi as $t)
            <tr class="{{ $t->tipe === 'pemasukan' ? 'table-success' : 'table-danger' }}">
                <td>{{ Format::tanggalDanWaktu($t->tanggal) }}</td>
                <td>{{ ucfirst($t->tipe) }}</td>
                <td><span class="badge bg-secondary">{{ $t->kategori }}</span></td>
                <td>{{ $t->deskripsi }}</td>
                <td>{{ Format::rupiah($t->jumlah) }}</td>
                <td>
                    <form action="{{ route('transaksi.destroy', $t->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Yakin?')" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Belum ada data transaksi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-3">
    {{ $transaksi->links() }}
    </div>
</div>

<hr>
<h5>Total Pemasukan: {{ Format::rupiah($totalPemasukan) }}</h5>
<h5>Total Pengeluaran: {{ Format::rupiah($totalPengeluaran) }}</h5>
<h5><strong>Saldo: {{ Format::rupiah($saldo) }}</strong></h5>
@endsection
