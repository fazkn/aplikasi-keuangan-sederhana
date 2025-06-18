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
    @foreach ($transaksi as $t)
    <tr>
        <td>{{ $t->tanggal }}</td>
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
    @endforeach
  </tbody>
</table>
