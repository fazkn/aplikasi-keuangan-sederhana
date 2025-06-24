@extends('layout')

@section('title','Dashboard')

@section('content')
<h3 class="mb-4">Dashboard Keuangan</h3>
<div class="alert alert-info">
    Selamat datang di Dashboard Keuangan! Di sini Anda dapat melihat ringkasan pemasukan, pengeluaran, dan saldo Anda.</div>
<div class="row">
    <!-- Kolom Kiri: Ringkasan Keuangan -->
    <div class="col-md-8">
        <div class="row text-center">
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Total Pemasukan</div>
                    <div class="card-body">
                        <h5 class="card-title">{{Format::rupiah($pemasukan) }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-header">Total Pengeluaran</div>
                    <div class="card-body">
                        <h5 class="card-title">{{Format::rupiah($pengeluaran) }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Saldo Saat Ini</div>
                    <div class="card-body">
                        <h5 class="card-title">{{Format::rupiah($saldo) }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Grafik Pie -->
    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title text-center">Pengeluaran per Kategori</h5>
                <canvas id="kategoriChart" style="max-height: 250px;"></canvas>
            </div>
        </div>
    </div>
    @if(count($pengeluaranPerKategori) === 0)
        <p class="text-center text-muted">Belum ada data pengeluaran per kategori.</p>
    @endif
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const kategoriData = @json($pengeluaranPerKategori);
  const labels = kategoriData.map(item => item.nama_kategori);
  const data = kategoriData.map(item => item.total);

  const ctx = document.getElementById('kategoriChart').getContext('2d');
  new Chart(ctx, {
    type: 'pie',
    data: {
      labels: labels,
      datasets: [{
        label: 'Pengeluaran',
        data: data,
        backgroundColor: ['#f87171', '#fb923c', '#facc15', '#4ade80', '#60a5fa', '#a78bfa'],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'bottom'
        }
      }
    }
  });
</script>
@endsection
