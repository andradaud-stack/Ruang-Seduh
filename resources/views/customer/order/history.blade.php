<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <title>Riwayat Pesanan — Ruang Seduh</title>
  <link rel="icon" href="{{ asset('assets/images/LOGO_RUANG_SEDUH(putih).png') }}" type="image/png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600;1,700&display=swap" rel="stylesheet">
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --ink: #24170f;
      --muted: #84776e;
      --cream: #f7f1e9;
      --paper: #fffdf9;
      --brown: #5a351f;
      --brown-2: #754a2c;
      --line: #e9e0d6;
      --green: #39775b;
      --green-bg: #e7f3eb;
      --gold: #c99b51;
    }

    body {
      min-height: 100vh;
      background: #eee8df;
      color: var(--ink);
      font-family: "DM Sans", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
      -webkit-font-smoothing: antialiased;
    }

    button { font: inherit; border: 0; cursor: pointer; }
    a { color: inherit; text-decoration: none; }

    .oh-wrap {
      width: min(100%, 720px);
      margin: 0 auto;
      min-height: 100vh;
      background: var(--cream);
      position: relative;
      padding-bottom: 120px;
      box-shadow: 0 0 50px rgba(36, 23, 15, 0.08);
    }

    /* Header */
    .oh-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 24px 28px 18px;
      background: rgba(247, 241, 233, 0.95);
      backdrop-filter: blur(14px);
      -webkit-backdrop-filter: blur(14px);
      border-bottom: 1px solid rgba(233, 224, 214, 0.8);
      position: sticky;
      top: 0;
      z-index: 30;
    }

    .oh-header h1 {
      font-family: "Playfair Display", serif;
      font-size: 22px;
      font-weight: 700;
      color: var(--ink);
    }

    .oh-count {
      font-size: 12px;
      font-weight: 700;
      color: var(--brown);
      background: #f1e7dd;
      padding: 5px 12px;
      border-radius: 999px;
    }

    /* List */
    .oh-list {
      padding: 22px 28px;
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    .order-card {
      background: var(--paper);
      border: 1px solid var(--line);
      border-radius: 22px;
      padding: 20px;
      box-shadow: 0 6px 20px rgba(36, 23, 15, 0.04);
      transition: transform 0.2s ease, border-color 0.2s ease;
    }
    .order-card:hover {
      border-color: #dfd3c5;
      transform: translateY(-2px);
    }

    .card-top {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      padding-bottom: 14px;
      border-bottom: 1px solid var(--line);
      margin-bottom: 14px;
    }
    .order-num {
      font-family: "Playfair Display", serif;
      font-size: 16px;
      font-weight: 800;
      color: var(--ink);
    }
    .order-meta {
      font-size: 12px;
      color: var(--muted);
      margin-top: 2px;
    }

    /* Status Badges */
    .badge-status {
      font-size: 11px;
      font-weight: 700;
      padding: 4px 12px;
      border-radius: 999px;
      white-space: nowrap;
    }
    .badge-waiting { background: #fef3c7; color: #92400e; }
    .badge-processing { background: #e0f2fe; color: #0369a1; }
    .badge-ready { background: var(--green-bg); color: var(--green); }
    .badge-completed { background: #f1e9df; color: var(--brown); }
    .badge-cancelled { background: #fee2e2; color: #b91c1c; }

    /* Items */
    .items-list {
      display: flex;
      flex-direction: column;
      gap: 8px;
      margin-bottom: 14px;
    }
    .item-row {
      display: flex;
      justify-content: space-between;
      font-size: 13.5px;
      color: #655950;
    }
    .item-row-name {
      flex: 1;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      padding-right: 8px;
    }
    .item-row-price {
      font-weight: 700;
      color: var(--ink);
      font-variant-numeric: tabular-nums;
    }

    /* Card Bottom */
    .card-bottom {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding-top: 14px;
      border-top: 1px solid var(--line);
    }
    .total-group {
      display: flex;
      flex-direction: column;
    }
    .total-lbl {
      font-size: 11px;
      font-weight: 600;
      color: var(--muted);
      text-transform: uppercase;
      letter-spacing: 0.04em;
    }
    .total-val {
      font-family: "Playfair Display", serif;
      font-size: 17px;
      font-weight: 800;
      color: var(--ink);
      font-variant-numeric: tabular-nums;
    }
    .btn-detail {
      font-size: 12.5px;
      font-weight: 700;
      color: #ffffff;
      background: var(--brown);
      padding: 9px 18px;
      border-radius: 14px;
      transition: all 0.15s ease;
      box-shadow: 0 4px 12px rgba(90, 53, 31, 0.2);
    }
    .btn-detail:hover {
      background: var(--brown-2);
      transform: translateY(-1px);
    }

    /* Empty State */
    .empty-box {
      text-align: center;
      padding: 70px 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .empty-icon {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      background: #f3eae0;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 36px;
      margin-bottom: 18px;
    }
    .empty-title {
      font-family: "Playfair Display", serif;
      font-size: 20px;
      font-weight: 700;
      color: var(--ink);
      margin-bottom: 6px;
    }
    .empty-desc {
      font-size: 13.5px;
      color: var(--muted);
      line-height: 1.5;
      max-width: 300px;
      margin-bottom: 24px;
    }
    .btn-order-now {
      padding: 12px 26px;
      border-radius: 999px;
      background: var(--brown);
      color: #ffffff;
      font-size: 13.5px;
      font-weight: 700;
      box-shadow: 0 6px 18px rgba(90, 53, 31, 0.25);
      transition: all 0.15s ease;
    }
    .btn-order-now:hover {
      background: var(--brown-2);
      transform: translateY(-2px);
    }

    /* Bottom Navigation Dock */
    .bottom-nav {
      position: fixed;
      z-index: 24;
      left: 50%;
      transform: translateX(-50%);
      bottom: 18px;
      width: min(calc(100% - 36px), 540px);
      height: 74px;
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      padding: 6px;
      border-radius: 25px;
      background: rgba(255, 253, 249, 0.94);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.8);
      box-shadow: 0 16px 45px rgba(54, 35, 22, 0.17);
    }

    .nav-item {
      background: transparent;
      color: #a29a93;
      border-radius: 19px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 2px;
      position: relative;
      transition: all 0.15s ease;
    }
    .nav-item > span {
      font-size: 20px;
      line-height: 1;
    }
    .nav-item small {
      font-size: 10.5px;
      font-weight: 700;
    }
    .nav-item.active {
      background: #f2e9df;
      color: var(--brown);
    }
    .nav-item b {
      position: absolute;
      top: 6px;
      margin-left: 6px;
      width: 17px;
      height: 17px;
      display: grid;
      place-items: center;
      background: var(--brown);
      color: #fff;
      border-radius: 50%;
      font-size: 9px;
      font-weight: 800;
    }

    @media (max-width: 480px) {
      .oh-header { padding: 18px 20px 14px; }
      .oh-list { padding: 18px 20px; }
      .order-card { padding: 16px; }
    }
  </style>
</head>
<body>

@php
  $cart = session('cart', []);
  $cartCount = is_array($cart) ? array_sum(array_column($cart, 'qty')) : 0;

  $statusBadgeClasses = [
    'menunggu_konfirmasi' => 'badge-waiting',
    'diproses'            => 'badge-processing',
    'siap_disajikan'      => 'badge-ready',
    'selesai'             => 'badge-completed',
    'dibatalkan'          => 'badge-cancelled',
  ];

  $statusTitles = [
    'menunggu_konfirmasi' => 'Menunggu Konfirmasi',
    'diproses'            => 'Sedang Diproses',
    'siap_disajikan'      => 'Siap Disajikan',
    'selesai'             => 'Selesai',
    'dibatalkan'          => 'Dibatalkan',
  ];
@endphp

<div class="oh-wrap">

  <!-- Header -->
  <header class="oh-header">
    <h1>Riwayat Pesanan</h1>
    <span class="oh-count">{{ $orders->count() }} Pesanan</span>
  </header>

  <!-- List -->
  <main class="oh-list">
    @forelse($orders as $order)
      <div class="order-card">
        <div class="card-top">
          <div>
            <div class="order-num">Pesanan #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</div>
            <div class="order-meta">
              {{ $order->created_at->format('d M Y, H:i') }} WIB · Meja {{ $order->tabel->table_number ?? '-' }}
            </div>
          </div>
          <span class="badge-status {{ $statusBadgeClasses[$order->status] ?? 'badge-waiting' }}">
            {{ $statusTitles[$order->status] ?? ucfirst(str_replace('_', ' ', $order->status)) }}
          </span>
        </div>

        <div class="items-list">
          @foreach($order->orderItems->take(3) as $item)
            <div class="item-row">
              <span class="item-row-name">{{ $item->menu_name }} &times;{{ $item->qty }}</span>
              <span class="item-row-price">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
            </div>
          @endforeach

          @if($order->orderItems->count() > 3)
            <div style="font-size: 11.5px; color: var(--muted); font-style: italic;">
              +{{ $order->orderItems->count() - 3 }} item lainnya
            </div>
          @endif
        </div>

        <div class="card-bottom">
          <div class="total-group">
            <span class="total-lbl">Total Bayar</span>
            <span class="total-val">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
          </div>
          <a href="{{ route('customer.order.detail', $order->id) }}" class="btn-detail">
            Lihat Status →
          </a>
        </div>
      </div>
    @empty
      <div class="empty-box">
        <div class="empty-icon">☕</div>
        <h2 class="empty-title">Belum Ada Riwayat Pesanan</h2>
        <p class="empty-desc">Kamu belum melakukan pemesanan di Ruang Seduh. Silakan pilih kopi favoritmu!</p>
        <a href="{{ route('customer.home') }}" class="btn-order-now">Mulai Pesan Sekarang</a>
      </div>
    @endforelse
  </main>

  <!-- Bottom Navigation Dock -->
  <nav class="bottom-nav">
    <a href="{{ route('customer.home') }}" class="nav-item">
      <span>⌂</span>
      <small>Beranda</small>
    </a>
    <a href="{{ route('customer.order.history') }}" class="nav-item active">
      <span>◷</span>
      <small>Riwayat</small>
    </a>
    <a href="{{ route('customer.cart.index') }}" class="nav-item">
      <span>🛒<b id="navBadge" style="{{ $cartCount > 0 ? '' : 'display:none;' }}">{{ $cartCount }}</b></span>
      <small>Keranjang</small>
    </a>
    <a href="{{ route('customer.profile.index') }}" class="nav-item">
      <span>♙</span>
      <small>Profil</small>
    </a>
  </nav>

</div>

@include('customer.include.order_notifications')
</body>
</html>