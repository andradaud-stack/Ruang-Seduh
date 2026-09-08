<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <title>Profil Saya — Ruang Seduh</title>
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

    .pf-wrap {
      width: min(100%, 720px);
      margin: 0 auto;
      min-height: 100vh;
      background: var(--cream);
      position: relative;
      padding-bottom: 120px;
      box-shadow: 0 0 50px rgba(36, 23, 15, 0.08);
    }

    /* Header */
    .pf-header {
      padding: 24px 28px 18px;
      background: rgba(247, 241, 233, 0.95);
      backdrop-filter: blur(14px);
      -webkit-backdrop-filter: blur(14px);
      border-bottom: 1px solid rgba(233, 224, 214, 0.8);
      position: sticky;
      top: 0;
      z-index: 30;
    }

    .pf-header h1 {
      font-family: "Playfair Display", serif;
      font-size: 22px;
      font-weight: 700;
      color: var(--ink);
    }

    .pf-body {
      padding: 24px 28px;
      display: flex;
      flex-direction: column;
      gap: 18px;
    }

    /* Success Alert */
    .pf-alert {
      background: var(--green-bg);
      border: 1px solid #bbf7d0;
      border-radius: 16px;
      padding: 13px 18px;
      font-size: 13px;
      font-weight: 600;
      color: var(--green);
    }

    /* User Info Card */
    .user-card {
      background: var(--paper);
      border: 1px solid var(--line);
      border-radius: 24px;
      padding: 28px 20px;
      text-align: center;
      box-shadow: 0 6px 20px rgba(36, 23, 15, 0.04);
    }
    .avatar-circle {
      width: 76px;
      height: 76px;
      border-radius: 50%;
      background: var(--brown);
      color: #ffffff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: "Playfair Display", serif;
      font-size: 28px;
      font-weight: 800;
      margin: 0 auto 14px;
      box-shadow: 0 8px 20px rgba(90, 53, 31, 0.25);
    }
    .user-name {
      font-family: "Playfair Display", serif;
      font-size: 20px;
      font-weight: 700;
      color: var(--ink);
      margin-bottom: 4px;
    }
    .user-email {
      font-size: 13px;
      color: var(--muted);
    }

    /* Menu Links Group */
    .menu-group {
      background: var(--paper);
      border: 1px solid var(--line);
      border-radius: 22px;
      overflow: hidden;
      box-shadow: 0 6px 20px rgba(36, 23, 15, 0.04);
    }
    .menu-item {
      display: flex;
      align-items: center;
      gap: 16px;
      padding: 18px 22px;
      border-bottom: 1px solid var(--line);
      color: var(--ink);
      transition: background 0.15s ease;
    }
    .menu-item:last-child {
      border-bottom: none;
    }
    .menu-item:hover {
      background: #fbf6f0;
    }
    .menu-icon {
      width: 40px;
      height: 40px;
      border-radius: 12px;
      background: #f3eae0;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--brown);
      flex-shrink: 0;
    }
    .menu-icon svg {
      width: 19px;
      height: 19px;
      stroke: currentColor;
      stroke-width: 2.2;
      fill: none;
    }
    .menu-text {
      flex: 1;
      font-size: 14.5px;
      font-weight: 700;
      color: var(--ink);
    }
    .menu-chevron {
      color: var(--muted);
    }
    .menu-chevron svg {
      width: 18px;
      height: 18px;
      stroke: currentColor;
      stroke-width: 2.3;
      fill: none;
    }

    /* Logout Button */
    .btn-logout {
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      background: var(--paper);
      border: 1.5px solid #fecdd3;
      color: #be123c;
      padding: 15px;
      border-radius: 18px;
      font-family: inherit;
      font-size: 14.5px;
      font-weight: 700;
      cursor: pointer;
      box-shadow: 0 4px 14px rgba(190, 18, 60, 0.05);
      transition: all 0.2s ease;
    }
    .btn-logout:hover {
      background: #fff1f2;
      border-color: #fda4af;
      transform: translateY(-1px);
    }
    .btn-logout svg {
      width: 18px;
      height: 18px;
      stroke: currentColor;
      stroke-width: 2.2;
      fill: none;
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
      border: 1px solid rgba(255, 255, 255, 0.85);
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
      gap: 3px;
      position: relative;
      text-decoration: none;
      transition: all 0.15s ease;
      padding: 4px 6px;
    }

    .nav-icon {
      width: 24px;
      height: 24px;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
    }

    .nav-icon svg {
      width: 22px;
      height: 22px;
      stroke: currentColor;
      stroke-width: 2.2;
      fill: none;
      stroke-linecap: round;
      stroke-linejoin: round;
      transition: transform 0.15s ease;
    }

    .nav-item small {
      font-size: 11px;
      font-weight: 700;
      letter-spacing: -0.01em;
      line-height: 1;
    }

    .nav-item.active {
      background: #f2e9df;
      color: var(--brown);
    }

    .nav-item.active .nav-icon svg {
      stroke-width: 2.5;
      transform: translateY(-1px);
    }

    .nav-item b {
      position: absolute;
      top: -4px;
      right: -8px;
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
      .pf-header { padding: 18px 20px 14px; }
      .pf-body { padding: 18px 20px; }
      .menu-item { padding: 16px 18px; }
    }
  </style>
</head>
<body>

@php
  $cart = session('cart', []);
  $cartCount = is_array($cart) ? array_sum(array_column($cart, 'qty')) : 0;
@endphp

<div class="pf-wrap">

  <!-- Header -->
  <header class="pf-header">
    <h1>Profil Saya</h1>
  </header>

  <main class="pf-body">

    @if(session('message_success'))
      <div class="pf-alert">
        {{ session('message_success') }}
      </div>
    @endif

    <!-- User Profile Card -->
    <div class="user-card">
      <div class="avatar-circle">
        {{ strtoupper(substr($user->name ?? 'C', 0, 1)) }}
      </div>
      <h2 class="user-name">{{ $user->name ?? 'Pelanggan' }}</h2>
      <p class="user-email">{{ $user->email ?? '' }}</p>
    </div>

    <!-- Menu Links -->
    <div class="menu-group">
      <a href="{{ Route::has('customer.order.history') ? route('customer.order.history') : '#' }}" class="menu-item">
        <div class="menu-icon">
          <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
        </div>
        <span class="menu-text">Riwayat Pesanan</span>
        <div class="menu-chevron">
          <svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </div>
      </a>

      <a href="{{ Route::has('customer.profile.edit') ? route('customer.profile.edit') : '#' }}" class="menu-item">
        <div class="menu-icon">
          <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
        </div>
        <span class="menu-text">Ubah Profil</span>
        <div class="menu-chevron">
          <svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </div>
      </a>

      <a href="{{ Route::has('customer.password.edit') ? route('customer.password.edit') : '#' }}" class="menu-item">
        <div class="menu-icon">
          <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
        </div>
        <span class="menu-text">Ubah Kata Sandi</span>
        <div class="menu-chevron">
          <svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </div>
      </a>
    </div>

    <!-- Logout Form -->
    <form action="{{ route('customer.logout') }}" method="POST">
      @csrf
      <button type="submit" class="btn-logout">
        <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
        <span>Keluar dari Akun</span>
      </button>
    </form>

  </main>

  <!-- Bottom Navigation Dock -->
  <nav class="bottom-nav">
    <a href="{{ route('customer.home') }}" class="nav-item">
      <span class="nav-icon">
        <svg viewBox="0 0 24 24">
          <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
          <polyline points="9 22 9 12 15 12 15 22"></polyline>
        </svg>
      </span>
      <small>Beranda</small>
    </a>

    <a href="{{ route('customer.order.history') }}" class="nav-item">
      <span class="nav-icon">
        <svg viewBox="0 0 24 24">
          <circle cx="12" cy="12" r="10"></circle>
          <polyline points="12 6 12 12 16 14"></polyline>
        </svg>
      </span>
      <small>Riwayat</small>
    </a>

    <a href="{{ route('customer.cart.index') }}" class="nav-item">
      <span class="nav-icon">
        <svg viewBox="0 0 24 24">
          <circle cx="9" cy="21" r="1"></circle>
          <circle cx="20" cy="21" r="1"></circle>
          <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
        </svg>
        <b id="navBadge" style="{{ $cartCount > 0 ? '' : 'display:none;' }}">{{ $cartCount }}</b>
      </span>
      <small>Keranjang</small>
    </a>

    <a href="{{ route('customer.profile.index') }}" class="nav-item active">
      <span class="nav-icon">
        <svg viewBox="0 0 24 24">
          <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
          <circle cx="12" cy="7" r="4"></circle>
        </svg>
      </span>
      <small>Profil</small>
    </a>
  </nav>

</div>

@include('customer.include.order_notifications')
</body>
</html>