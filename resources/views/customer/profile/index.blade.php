<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>Profil Saya - Ruang Seduh</title>
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
    --danger: #ef4444;
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

  .pf-wrap {
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
  .pf-header {
    padding: 24px 20px 18px;
    background: #ffffff;
    border-bottom: 1px solid var(--border);
    position: sticky;
    top: 0;
    z-index: 30;
  }
  .pf-header h1 {
    font-size: 18px;
    font-weight: 800;
    letter-spacing: -0.02em;
    color: var(--text-primary);
  }

  .pf-body {
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 16px;
  }

  /* Success Alert */
  .pf-alert {
    background: #ecfdf5;
    border: 1px solid #a7f3d0;
    border-radius: var(--radius-md);
    padding: 12px 16px;
    font-size: 13px;
    font-weight: 600;
    color: #065f46;
  }

  /* User Info Card */
  .user-card {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 24px 20px;
    text-align: center;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
  }
  .avatar-circle {
    width: 68px;
    height: 68px;
    border-radius: 50%;
    background: #0f172a;
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    font-weight: 800;
    margin: 0 auto 12px;
    box-shadow: 0 4px 14px rgba(15, 23, 42, 0.15);
  }
  .user-name {
    font-size: 18px;
    font-weight: 800;
    color: var(--text-primary);
    margin-bottom: 3px;
  }
  .user-email {
    font-size: 13px;
    color: var(--text-muted);
  }

  /* Menu Links Group */
  .menu-group {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    overflow: hidden;
  }
  .menu-item {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 16px 18px;
    border-bottom: 1px solid #f1f5f9;
    text-decoration: none;
    color: var(--text-primary);
    transition: background 0.15s ease;
  }
  .menu-item:last-child {
    border-bottom: none;
  }
  .menu-item:hover {
    background: #f8fafc;
  }
  .menu-icon {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-primary);
    flex-shrink: 0;
  }
  .menu-icon svg {
    width: 18px;
    height: 18px;
    stroke: currentColor;
    stroke-width: 2;
    fill: none;
  }
  .menu-text {
    flex: 1;
    font-size: 14px;
    font-weight: 600;
  }
  .menu-chevron {
    color: var(--text-muted);
  }
  .menu-chevron svg {
    width: 16px;
    height: 16px;
    stroke: currentColor;
    stroke-width: 2.2;
    fill: none;
  }

  /* Logout Button */
  .btn-logout {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    background: #ffffff;
    border: 1px solid #fecaca;
    color: #dc2626;
    padding: 14px;
    border-radius: var(--radius-md);
    font-family: inherit;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.15s ease;
  }
  .btn-logout:hover {
    background: #fef2f2;
    border-color: #f87171;
  }
  .btn-logout svg {
    width: 16px;
    height: 16px;
    stroke: currentColor;
    stroke-width: 2.2;
    fill: none;
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
      <h2 class="user-name">{{ $user->name ?? 'Customer' }}</h2>
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

    <!-- Logout -->
    <form action="{{ route('customer.logout') }}" method="POST">
      @csrf
      <button type="submit" class="btn-logout">
        <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
        <span>Keluar dari Akun</span>
      </button>
    </form>

  </main>

  <!-- Floating Bottom Dock Navigation -->
  <div class="dock-wrap">
    <nav class="dock-nav">
      <a href="{{ route('customer.home') }}" class="dock-item" aria-label="Beranda">
        <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
        <span>Beranda</span>
      </a>
      <a href="{{ route('customer.order.history') }}" class="dock-item" aria-label="Riwayat">
        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
        <span>Riwayat</span>
      </a>
      <a href="{{ route('customer.cart.index') }}" class="dock-item" aria-label="Keranjang">
        <svg viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
        <span>Keranjang</span>
      </a>
      <a href="{{ route('customer.profile.index') }}" class="dock-item active" aria-label="Profil">
        <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
        <span>Profil</span>
      </a>
    </nav>
  </div>

</div>
</body>
</html>