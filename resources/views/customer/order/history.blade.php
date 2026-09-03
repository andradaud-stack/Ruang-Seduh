<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>Riwayat Pesanan - Ruang Seduh</title>
<style>
  :root{
    --accent: #e07a5f;
    --dark: #141414;
    --muted: #8a8580;
    --cream: #f6ece3;
  }
  *{ box-sizing:border-box; margin:0; padding:0; }
  body{
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    background: #111;
  }
  .oh-wrap{
    max-width:480px;
    margin:0 auto;
    min-height:100dvh;
    background: var(--cream);
    position:relative;
    overflow-x:hidden;
  }

  .oh-title{
    text-align:center;
    font-size:24px;
    font-weight:800;
    color:var(--dark);
    padding:48px 20px 26px;
  }

  .oh-list{
    padding:0 20px 130px;
    display:flex;
    flex-direction:column;
    gap:16px;
  }

  .oh-card{
    background:#ffffff;
    border-radius:20px;
    padding:20px;
    box-shadow:0 4px 14px rgba(0,0,0,.05);
  }

  .oh-top{
    display:flex;
    align-items:flex-start;
    justify-content:space-between;
    margin-bottom:4px;
  }
  .oh-number{
    font-size:16px;
    font-weight:800;
    color:var(--dark);
    margin-bottom:2px;
  }
  .oh-meta{
    font-size:13px;
    color:var(--muted);
  }

  .oh-badge{
    flex-shrink:0;
    font-size:12px;
    font-weight:700;
    padding:6px 14px;
    border-radius:999px;
    background:rgba(224,122,95,0.15);
    color:var(--accent);
    white-space:nowrap;
  }

  .oh-items{
    margin:16px 0 12px;
  }
  .oh-item-row{
    display:flex;
    justify-content:space-between;
    font-size:14px;
    color:#4a4540;
    padding:2px 0;
  }

  .oh-divider{
    border:none;
    border-top:1px solid #eee2d8;
    margin:14px 0;
  }

  .oh-bottom{
    display:flex;
    align-items:center;
    justify-content:space-between;
  }
  .oh-total{
    font-size:17px;
    font-weight:800;
    color:var(--dark);
  }

  .oh-detail-btn{
    font-size:13px;
    font-weight:700;
    color:var(--accent);
    border:1.5px solid var(--accent);
    background:none;
    padding:8px 18px;
    border-radius:999px;
    text-decoration:none;
    cursor:pointer;
    white-space:nowrap;
  }

  .oh-empty{
    text-align:center;
    color:var(--muted);
    font-size:14px;
    padding:60px 20px;
  }

  /* Bottom Navbar (fixed to real screen) */
  .navbar-wrap{
    position:fixed;
    left:0;
    right:0;
    bottom:0;
    display:flex;
    justify-content:center;
    padding:0 20px 20px;
    pointer-events:none;
  }
  .navbar{
    width:100%;
    max-width:440px;
    pointer-events:auto;
    display:flex;
    align-items:center;
    justify-content:space-around;
    background:#ffffff;
    border-radius:999px;
    padding:14px 16px;
    box-shadow: 0 10px 30px rgba(0,0,0,.25);
  }
  .nav-item{
    background:none;
    border:none;
    padding:9px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
    text-decoration:none;
  }
  .nav-item img{
    width:22px;
    height:22px;
    object-fit:contain;
  }
  .nav-item.active{
    background: var(--accent);
    box-shadow: 0 0 0 4px #ffffff, 0 4px 10px rgba(224,122,95,0.5);
  }

  @media (min-width:700px){
    .oh-wrap{ margin-top:24px; margin-bottom:24px; border-radius:28px; overflow:hidden; box-shadow:0 20px 60px rgba(0,0,0,.4); }
  }
</style>
</head>
<body>

@php
  $statusLabel = [
    'menunggu_konfirmasi' => 'Menunggu Konfirmasi',
    'diproses'            => 'Diproses',
    'selesai'             => 'Selesai',
    'dibatalkan'          => 'Dibatalkan',
  ];
@endphp

<div class="oh-wrap">

  <div class="oh-title">Riwayat Pesanan</div>

  <div class="oh-list">
    @forelse($orders as $order)
      @php
        $label = $statusLabel[$order->status] ?? ucfirst(str_replace('_', ' ', $order->status));
      @endphp
      <div class="oh-card">
        <div class="oh-top">
          <div>
            <div class="oh-number">Pesanan #{{ $order->id }}</div>
            <div class="oh-meta">{{ $order->created_at->diffForHumans() }} &middot; Meja {{ $order->tabel->table_number ?? '-' }}</div>
          </div>
          <div class="oh-badge">{{ $label }}</div>
        </div>

        <div class="oh-items">
          @foreach($order->orderItems as $item)
            <div class="oh-item-row">
              <span>{{ $item->menu_name }} x{{ $item->qty }}</span>
              <span>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
            </div>
          @endforeach
        </div>

        <hr class="oh-divider">

        <div class="oh-bottom">
          <div class="oh-total">Rp {{ number_format($order->total, 0, ',', '.') }}</div>
          @if(Route::has('customer.order.detail'))
            <a href="{{ route('customer.order.detail', $order->id) }}" class="oh-detail-btn">Lihat Detail</a>
          @endif
        </div>
      </div>
    @empty
      <div class="oh-empty">Belum ada riwayat pesanan.</div>
    @endforelse
  </div>

  <div class="navbar-wrap">
    <nav class="navbar">
      <a href="{{ route('customer.profile.index') }}" class="nav-item" aria-label="Profil">
        <img src="{{ asset('assets/images/navbar/profile.png') }}" alt="" aria-hidden="true">
      </a>
      <a href="{{ route('customer.order.history') }}" class="nav-item active" aria-label="Riwayat">
        <img src="{{ asset('assets/images/navbar/history.png') }}" alt="" aria-hidden="true">
      </a>
      <a href="{{ route('customer.home') }}" class="nav-item" aria-label="Beranda">
        <img src="{{ asset('assets/images/navbar/home.png') }}" alt="" aria-hidden="true">
      </a>
      <a href="{{ route('customer.cart.index') }}" class="nav-item" aria-label="Keranjang">
        <img src="{{ asset('assets/images/navbar/cart.png') }}" alt="" aria-hidden="true">
      </a>
    </nav>
  </div>

</div>
</body>
</html>