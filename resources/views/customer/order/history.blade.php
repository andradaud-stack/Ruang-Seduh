<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>Riwayat Pesanan - Ruang Seduh</title>
<link rel="icon" href="{{ asset('assets/images/LOGO_RUANG_SEDUH(putih).png') }}" type="image/png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  :root {
    --bg-page: #f8fafc;
    --card-bg: #ffffff;
    --border: #e2e8f0;
    --border-hover: #cbd5e1;
    --text-primary: #0f172a;
    --text-secondary: #475569;
    --text-muted: #94a3b8;
    --brand: #0f172a;
    --brand-hover: #1e293b;
    --radius-lg: 18px;
    --radius-md: 12px;
  }

  * { box-sizing: border-box; margin: 0; padding: 0; }
  html, body { min-height: 100%; background: #0f172a; }
  body {
    font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    color: var(--text-primary);
    -webkit-font-smoothing: antialiased;
  }

  .oh-wrap {
    width: 100%;
    max-width: 480px;
    margin: 0 auto;
    min-height: 100vh;
    background: var(--bg-page);
    position: relative;
    padding-bottom: 110px;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
  }

  /* Header */
  .oh-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 24px 20px 18px;
    background: #ffffff;
    border-bottom: 1px solid var(--border);
    position: sticky;
    top: 0;
    z-index: 30;
  }
  .oh-header h1 {
    font-size: 18px;
    font-weight: 800;
    letter-spacing: -0.02em;
    color: var(--text-primary);
  }
  .oh-count {
    font-size: 12px;
    font-weight: 600;
    color: var(--text-muted);
  }

  /* List */
  .oh-list {
    padding: 18px 20px;
    display: flex;
    flex-direction: column;
    gap: 14px;
  }

  .order-card {
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 18px;
    transition: all 0.15s ease;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
  }
  .order-card:hover {
    border-color: var(--border-hover);
    box-shadow: 0 8px 20px -4px rgba(15, 23, 42, 0.06);
  }

  .card-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding-bottom: 12px;
    border-bottom: 1px solid #f1f5f9;
    margin-bottom: 12px;
  }
  .order-num {
    font-size: 15px;
    font-weight: 800;
    color: var(--text-primary);
  }
  .order-meta {
    font-size: 12px;
    color: var(--text-muted);
    margin-top: 2px;
  }

  /* Status Badges */
  .badge-status {
    font-size: 11px;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 999px;
    white-space: nowrap;
  }
  .badge-waiting { background: #fef3c7; color: #b45309; }
  .badge-processing { background: #e0f2fe; color: #0369a1; }
  .badge-ready { background: #ecfdf5; color: #047857; }
  .badge-completed { background: #f1f5f9; color: #334155; }
  .badge-cancelled { background: #fee2e2; color: #b91c1c; }

  /* Items summary */
  .items-list {
    display: flex;
    flex-direction: column;
    gap: 6px;
    margin-bottom: 14px;
  }
  .item-row {
    display: flex;
    justify-content: space-between;
    font-size: 13px;
    color: var(--text-secondary);
  }
  .item-row-name {
    flex: 1;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    padding-right: 8px;
  }
  .item-row-price {
    font-weight: 600;
    color: var(--text-primary);
    font-variant-numeric: tabular-nums;
  }

  /* Card Bottom */
  .card-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 12px;
    border-top: 1px solid #f1f5f9;
  }
  .total-group {
    display: flex;
    flex-direction: column;
  }
  .total-lbl {
    font-size: 11px;
    font-weight: 600;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 0.04em;
  }
  .total-val {
    font-size: 16px;
    font-weight: 800;
    color: var(--text-primary);
    font-variant-numeric: tabular-nums;
  }
  .btn-detail {
    font-size: 12.5px;
    font-weight: 700;
    color: #ffffff;
    background: var(--brand);
    padding: 8px 16px;
    border-radius: var(--radius-md);
    text-decoration: none;
    transition: all 0.15s ease;
  }
  .btn-detail:hover {
    background: var(--brand-hover);
  }

  /* Empty State */
  .empty-box {
    text-align: center;
    padding: 60px 20px;
    color: var(--text-muted);
    font-size: 13.5px;
  }

  /* Floating Bottom Dock Navigation */
  .dock-wrap {
    position: fixed;
    bottom: 16px;
    left: 0;
    right: 0;
    display: flex;
    justify-content: center;
    z-index: 45;
    pointer-events: none;
  }
  .dock-nav {
    width: calc(100% - 32px);
    max-width: 440px;
    pointer-events: auto;
    background: rgba(255, 255, 255, 0.94);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border: 1px solid rgba(226, 232, 240, 0.9);
    border-radius: 24px;
    padding: 8px 12px;
    display: flex;
    justify-content: space-around;
    align-items: center;
    box-shadow: 0 12px 30px -8px rgba(15, 23, 42, 0.12);
  }
  .dock-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 3px;
    text-decoration: none;
    color: var(--text-muted);
    padding: 6px 14px;
    border-radius: 16px;
    transition: all 0.15s ease;
  }
  .dock-item svg {
    width: 20px;
    height: 20px;
    stroke: currentColor;
    stroke-width: 2;
    fill: none;
    stroke-linecap: round;
    stroke-linejoin: round;
    transition: transform 0.15s ease;
  }
  .dock-item span {
    font-size: 11px;
    font-weight: 600;
  }
  .dock-item:hover {
    color: var(--text-primary);
  }
  .dock-item.active {
    color: #0f172a;
    background: #f1f5f9;
  }
  .dock-item.active svg {
    stroke-width: 2.3;
    transform: translateY(-1px);
  }
</style>
</head>
<body>

@php
  $statusLabels = [
    'menunggu_konfirmasi' => 'Menunggu Konfirmasi',
    'diproses'            => 'Diproses',
    'siap_disajikan'      => 'Siap Disajikan',
    'selesai'             => 'Selesai',
    'dibatalkan'          => 'Dibatalkan',
  ];

  $statusBadgeClasses = [
    'menunggu_konfirmasi' => 'badge-waiting',
    'diproses'            => 'badge-processing',
    'siap_disajikan'      => 'badge-ready',
    'selesai'             => 'badge-completed',
    'dibatalkan'          => 'badge-cancelled',
  ];
@endphp

<div class="oh-wrap">

  <!-- Header -->
  <header class="oh-header">
    <h1>Riwayat Pesanan</h1>
    <span class="oh-count">{{ $orders->count() }} pesanan</span>
  </header>

  <!-- Orders List -->
  <div class="oh-list">
    @forelse($orders as $order)
      @php
        $label = $statusLabels[$order->status] ?? ucfirst(str_replace('_', ' ', $order->status));
        $badgeClass = $statusBadgeClasses[$order->status] ?? 'badge-waiting';
      @endphp
      <div class="order-card">
        <div class="card-top">
          <div>
            <div class="order-num">Pesanan #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</div>
            <div class="order-meta">{{ $order->created_at->diffForHumans() }} &middot; Meja {{ $order->tabel->table_number ?? '-' }}</div>
          </div>
          <span class="badge-status {{ $badgeClass }}">{{ $label }}</span>
        </div>

        <div class="items-list">
          @foreach($order->orderItems as $item)
            <div class="item-row">
              <span class="item-row-name">{{ $item->menu_name }} <span style="color:var(--text-muted);">&times; {{ $item->qty }}</span></span>
              <span class="item-row-price">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
            </div>
          @endforeach
        </div>

        <div class="card-bottom">
          <div class="total-group">
            <span class="total-lbl">Total Bayar</span>
            <span class="total-val">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
          </div>
          @if(Route::has('customer.order.detail'))
            <a href="{{ route('customer.order.detail', $order->id) }}" class="btn-detail">Lihat Detail &rarr;</a>
          @endif
        </div>
      </div>
    @empty
      <div class="empty-box">
        <div style="font-size: 36px; margin-bottom: 10px;">📋</div>
        <div style="font-weight: 700; color: var(--text-primary); margin-bottom: 4px;">Belum Ada Pesanan</div>
        <div>Pesanan yang telah kamu buat akan muncul di sini.</div>
      </div>
    @endforelse
  </div>

  <!-- Floating Bottom Dock Navigation -->
  <div class="dock-wrap">
    <nav class="dock-nav">
      <a href="{{ route('customer.home') }}" class="dock-item" aria-label="Beranda">
        <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
        <span>Beranda</span>
      </a>
      <a href="{{ route('customer.order.history') }}" class="dock-item active" aria-label="Riwayat">
        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
        <span>Riwayat</span>
      </a>
      <a href="{{ route('customer.cart.index') }}" class="dock-item" aria-label="Keranjang">
        <svg viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
        <span>Keranjang</span>
      </a>
      <a href="{{ route('customer.profile.index') }}" class="dock-item" aria-label="Profil">
        <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
        <span>Profil</span>
      </a>
    </nav>
  </div>

</div>
@include('customer.include.order_notifications')
</body>
</html>