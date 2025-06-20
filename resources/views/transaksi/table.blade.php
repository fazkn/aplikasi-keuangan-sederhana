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
        <td>{{ $t->kategori }}</td>
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
