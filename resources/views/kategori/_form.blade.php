 @csrf

 @if(isset($isEdit) && $isEdit)
    @method('PUT')
@endif

    <div class="mb-3">
        <label>Nama Kategori</label>
        <input type="text" name="nama_kategori" class="form-control"
                value="{{ old('nama_kategori', $kategori->nama_kategori ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label>Tipe</label>
        <select name="tipe" class="form-control" required>
            <option value="pemasukan" {{ old('tipe', $kategori->tipe ?? '') == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
            <option value="pengeluaran" {{ old('tipe', $kategori->tipe ?? '') == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
        </select>
    </div>