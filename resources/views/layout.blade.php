<!DOCTYPE html>
<html lang='id'>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Harian</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
  <div class="container">
    <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
      💰 Budget Harian
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarMenu">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('dashboard') ? 'active fw-semibold text-primary' : '' }}" href="{{ route('dashboard') }}">
            📊 Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('transaksi.index') ? 'active fw-semibold text-primary' : '' }}" href="{{ route('transaksi.index') }}">
            📋 Riwayat
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('transaksi.create') ? 'active fw-semibold text-primary' : '' }}" href="{{ route('transaksi.create') }}">
            ➕ Tambah
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<div class="container mt-4">
    <h2>Budget Harian</h2>
    @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>
