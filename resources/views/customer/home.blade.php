<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>Ruang Seduh - Order Online</title>
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
    --accent: #d97706;
    --accent-light: #fef3c7;
    --success: #10b981;
    --success-light: #ecfdf5;
    --radius-lg: 16px;
    --radius-md: 12px;
  }

  * { box-sizing: border-box; margin: 0; padding: 0; }
  html, body { min-height: 100%; background: #0f172a; }
  body {
    font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    color: var(--text-primary);
    -webkit-font-smoothing: antialiased;
  }

  /* Main Container */
  .app-wrap {
    width: 100%;
    max-width: 480px;
    margin: 0 auto;
    min-height: 100vh;
    background: var(--bg-page);
    position: relative;
    padding-bottom: 120px;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
  }

  /* Header Section */
  .header-bar {
    padding: 24px 20px 16px;
    background: #ffffff;
    border-bottom: 1px solid var(--border);
    position: sticky;
    top: 0;
    z-index: 40;
  }
  .header-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 14px;
  }
  .brand-area {
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .brand-logo {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    background: #0f172a;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
  }
  .brand-logo img {
    width: 22px;
    height: 22px;
    object-fit: contain;
  }
  .brand-title {
    font-size: 17px;
    font-weight: 800;
    letter-spacing: -0.02em;
    color: var(--text-primary);
    line-height: 1.2;
  }
  .brand-sub {
    font-size: 11px;
    font-weight: 500;
    color: var(--text-muted);
  }

  /* Table Pill Indicator */
  .table-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 700;
    background: #f1f5f9;
    color: #334155;
    border: 1px solid #e2e8f0;
    cursor: pointer;
    font-family: inherit;
    transition: all 0.15s ease;
  }
  .table-pill:hover {
    background: #e2e8f0;
    transform: translateY(-1px);
  }
  .table-pill.active {
    background: var(--success-light);
    color: #065f46;
    border-color: #a7f3d0;
  }
  .table-pill.active:hover {
    background: #d1fae5;
  }
  .status-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: #94a3b8;
  }
  .table-pill.active .status-dot {
    background: var(--success);
    box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2);
    animation: pulseDot 2s infinite;
  }
  @keyframes pulseDot {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.4; }
  }

  /* Table Selection Grid */
  .table-selection-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
    margin-top: 10px;
  }
  .table-select-card {
    background: #ffffff;
    border: 1.5px solid var(--border);
    border-radius: var(--radius-md);
    padding: 14px 12px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 6px;
    cursor: pointer;
    font-family: inherit;
    transition: all 0.15s ease;
  }
  .table-select-card:hover {
    border-color: var(--border-hover);
    background: #f8fafc;
  }
  .table-select-card.active {
    background: #0f172a;
    border-color: #0f172a;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.15);
  }
  .table-card-icon {
    font-size: 20px;
  }
  .table-card-num {
    font-size: 15px;
    font-weight: 800;
  }
  .table-card-badge {
    font-size: 10.5px;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 999px;
    background: #f1f5f9;
    color: var(--text-secondary);
  }
  .table-select-card.active .table-card-badge {
    background: rgba(255, 255, 255, 0.2);
    color: #ffffff;
  }

  /* Search Input */
  .search-wrap {
    position: relative;
    width: 100%;
  }
  .search-wrap svg {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    width: 16px;
    height: 16px;
    stroke: var(--text-muted);
    stroke-width: 2;
    fill: none;
    pointer-events: none;
  }
  .search-input {
    width: 100%;
    padding: 10px 14px 10px 40px;
    border-radius: var(--radius-md);
    background: #f8fafc;
    border: 1px solid var(--border);
    font-family: inherit;
    font-size: 13.5px;
    color: var(--text-primary);
    outline: none;
    transition: all 0.15s ease;
  }
  .search-input:focus {
    background: #ffffff;
    border-color: #0f172a;
    box-shadow: 0 0 0 3px rgba(15, 23, 42, 0.08);
  }
  .search-input::placeholder {
    color: var(--text-muted);
  }

  /* Body Content */
  .main-content {
    padding: 18px 20px;
  }

  /* Category Filter Pills */
  .category-bar {
    display: flex;
    gap: 8px;
    overflow-x: auto;
    padding-bottom: 14px;
    margin-bottom: 12px;
    scrollbar-width: none;
  }
  .category-bar::-webkit-scrollbar { display: none; }
  .chip {
    flex-shrink: 0;
    padding: 8px 16px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 600;
    background: #ffffff;
    color: var(--text-secondary);
    border: 1px solid var(--border);
    cursor: pointer;
    white-space: nowrap;
    transition: all 0.15s ease;
  }
  .chip:hover {
    border-color: var(--border-hover);
    color: var(--text-primary);
  }
  .chip.active {
    background: #0f172a;
    color: #ffffff;
    border-color: #0f172a;
    box-shadow: 0 2px 8px rgba(15, 23, 42, 0.15);
  }

  /* Section Title */
  .section-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 14px;
  }
  .section-heading {
    font-size: 16px;
    font-weight: 700;
    letter-spacing: -0.01em;
    color: var(--text-primary);
  }
  .section-count {
    font-size: 12px;
    font-weight: 600;
    color: var(--text-muted);
  }

  /* Menu Cards Grid */
  .menu-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
  }
  .menu-card {
    display: flex;
    flex-direction: column;
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    overflow: hidden;
    text-decoration: none;
    color: inherit;
    transition: all 0.15s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.02);
  }
  .menu-card:hover {
    transform: translateY(-2px);
    border-color: #cbd5e1;
    box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.06);
  }
  .card-image-wrap {
    width: 100%;
    aspect-ratio: 4 / 3;
    position: relative;
    background: #f1f5f9;
    overflow: hidden;
  }
  .card-image-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.3s ease;
  }
  .menu-card:hover .card-image-wrap img {
    transform: scale(1.04);
  }
  .card-fallback {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    color: #94a3b8;
    font-size: 28px;
  }

  .card-content {
    padding: 12px 14px 14px;
    display: flex;
    flex-direction: column;
    flex: 1;
  }
  .card-category {
    font-size: 10.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: var(--text-muted);
    margin-bottom: 4px;
  }
  .card-title {
    font-size: 14px;
    font-weight: 700;
    color: var(--text-primary);
    line-height: 1.35;
    margin-bottom: 6px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
  .card-footer-info {
    margin-top: auto;
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    padding-top: 8px;
  }
  .card-price {
    font-size: 14px;
    font-weight: 800;
    color: #0f172a;
    font-variant-numeric: tabular-nums;
  }
  .card-stock {
    font-size: 11px;
    font-weight: 600;
    color: var(--text-muted);
  }
  .card-stock.in-stock { color: #059669; }
  .card-stock.out-stock { color: #dc2626; }

  /* Floating Call Waiter Button */
  .btn-call-waiter {
    position: fixed;
    bottom: 84px;
    right: max(18px, calc(50% - 220px));
    z-index: 50;
    display: flex;
    align-items: center;
    gap: 8px;
    background: #0f172a;
    color: #ffffff;
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 999px;
    padding: 10px 18px;
    font-family: inherit;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.35);
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
  }
  .btn-call-waiter:hover {
    background: #1e293b;
    transform: translateY(-2px);
  }
  .btn-call-waiter:active {
    transform: scale(0.96);
  }
  .bell-icon {
    font-size: 15px;
    display: inline-block;
  }

  /* Floating Bottom Navigation Dock */
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
    position: relative;
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

  /* Call Waiter Modal */
  .modal-backdrop {
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, 0.6);
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
    z-index: 100;
    display: none;
    align-items: flex-end;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.2s ease;
  }
  .modal-backdrop.show {
    display: flex;
    opacity: 1;
  }
  .modal-sheet {
    width: 100%;
    max-width: 480px;
    background: #ffffff;
    border-radius: 28px 28px 0 0;
    padding: 24px 22px calc(24px + env(safe-area-inset-bottom));
    box-shadow: 0 -20px 40px rgba(0, 0, 0, 0.15);
    transform: translateY(100%);
    transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    max-height: 90vh;
    overflow-y: auto;
  }
  .modal-backdrop.show .modal-sheet {
    transform: translateY(0);
  }
  .modal-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 18px;
  }
  .modal-title {
    font-size: 18px;
    font-weight: 800;
    color: var(--text-primary);
    letter-spacing: -0.02em;
  }
  .modal-desc {
    font-size: 13px;
    color: var(--text-secondary);
    margin-top: 2px;
  }
  .modal-close-btn {
    background: #f1f5f9;
    border: none;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    color: #64748b;
    cursor: pointer;
  }
  .modal-table-badge {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    color: #1e293b;
    padding: 10px 14px;
    border-radius: var(--radius-md);
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .service-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
    margin-bottom: 16px;
  }
  .service-opt {
    border: 1.5px solid var(--border);
    border-radius: var(--radius-md);
    padding: 12px 10px;
    text-align: center;
    font-size: 12.5px;
    font-weight: 700;
    color: var(--text-secondary);
    cursor: pointer;
    transition: all 0.15s ease;
    user-select: none;
  }
  .service-opt input { display: none; }
  .service-opt.active {
    background: #f8fafc;
    border-color: #0f172a;
    color: #0f172a;
    box-shadow: 0 0 0 1px #0f172a;
  }
  .service-notes {
    width: 100%;
    padding: 11px 14px;
    border-radius: var(--radius-md);
    border: 1px solid var(--border);
    font-family: inherit;
    font-size: 13px;
    outline: none;
    margin-bottom: 20px;
    transition: border-color 0.15s ease;
  }
  .service-notes:focus {
    border-color: #0f172a;
  }
  .btn-submit-action {
    width: 100%;
    border: none;
    background: #0f172a;
    color: #ffffff;
    padding: 14px;
    border-radius: var(--radius-md);
    font-family: inherit;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.15s ease;
  }
  .btn-submit-action:hover { background: #1e293b; }
  .btn-submit-action:disabled { opacity: 0.6; cursor: not-allowed; }
</style>
</head>
<body>

<div class="app-wrap">

  <!-- Header Section -->
  <header class="header-bar">
    <div class="header-top">
      <div class="brand-area">
        <div class="brand-logo">
          <img src="{{ asset('assets/images/LOGO_RUANG_SEDUH(putih).png') }}" alt="RS">
        </div>
        <div>
          <h1 class="brand-title">Ruang Seduh</h1>
          <p class="brand-sub">Coffee & Artisan Brew</p>
        </div>
      </div>
      
      <button type="button" class="table-pill {{ $activeTable ? 'active' : '' }}" id="btnOpenTableModal" title="{{ $activeTable ? 'Meja ' . $activeTable->table_number . ' (Klik untuk ganti)' : 'Klik untuk memilih nomor meja' }}">
        <span class="status-dot"></span>
        <span id="headerTableLabel">{{ $activeTable ? 'Meja ' . $activeTable->table_number : 'Pilih Meja' }}</span>
        <svg style="width:11px; height:11px; stroke:currentColor; stroke-width:2.5; fill:none; margin-left:1px;" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"></polyline></svg>
      </button>
    </div>

    <!-- Search Box -->
    <div class="search-wrap">
      <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
      <input type="text" class="search-input" id="searchInput" placeholder="Cari menu favorit kamu...">
    </div>
  </header>

  <!-- Main Content -->
  <main class="main-content">

    <!-- Categories Filter Pills -->
    <div class="category-bar">
      <button type="button" class="chip active" data-category="Semua">Semua</button>
      @foreach($categories as $category)
        <button type="button" class="chip" data-category="{{ $category->name }}">{{ $category->name }}</button>
      @endforeach
    </div>

    <!-- Section Heading -->
    <div class="section-row">
      <h2 class="section-heading" id="sectionTitle">Semua Menu</h2>
      <span class="section-count" id="menuCount">{{ $menus->count() }} item</span>
    </div>

    <!-- Menu Cards Grid -->
    <div class="menu-grid" id="menuGrid">
      @forelse($menus as $menu)
        <a href="{{ route('customer.menu.show', $menu->id) }}" class="menu-card" data-name="{{ $menu->name }}" data-category="{{ $menu->kategori->name ?? '' }}">
          <div class="card-image-wrap">
            @if($menu->image)
              <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" loading="lazy" decoding="async">
            @else
              <div class="card-fallback">☕</div>
            @endif
          </div>
          <div class="card-content">
            <span class="card-category">{{ $menu->kategori->name ?? 'Menu' }}</span>
            <h3 class="card-title">{{ $menu->name }}</h3>
            <div class="card-footer-info">
              <span class="card-price">{{ $menu->hargaRupiah() }}</span>
              <span class="card-stock {{ $menu->stock > 0 ? 'in-stock' : 'out-stock' }}">
                {{ $menu->stock > 0 ? 'Tersedia ' . $menu->stock : 'Habis' }}
              </span>
            </div>
          </div>
        </a>
      @empty
        <div style="grid-column: 1/-1; text-align: center; padding: 40px 0; color: var(--text-muted); font-size: 13px;">
          Belum ada menu yang tersedia.
        </div>
      @endforelse
    </div>

  </main>

  <!-- Floating Call Waiter Button -->
  <button type="button" class="btn-call-waiter" id="btnOpenCallWaiter" aria-label="Panggil Pelayan">
    <span class="bell-icon">🛎️</span>
    <span>{{ $activeTable ? 'Meja ' . $activeTable->table_number : 'Panggil Pelayan' }}</span>
  </button>

  <!-- Floating Dock Navigation Bar -->
  <div class="dock-wrap">
    <nav class="dock-nav">
      <a href="{{ route('customer.home') }}" class="dock-item active" aria-label="Beranda">
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
      <a href="{{ route('customer.profile.index') }}" class="dock-item" aria-label="Profil">
        <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
        <span>Profil</span>
      </a>
    </nav>
  </div>

</div>

<!-- Modal Panggil Pelayan -->
<div class="modal-backdrop" id="callModalOverlay">
  <div class="modal-sheet">
    <div class="modal-top">
      <div>
        <h3 class="modal-title">🛎️ Panggil Pelayan</h3>
        <p class="modal-desc">Butuh bantuan staf? Kami siap melayani mejamu.</p>
      </div>
      <button type="button" class="modal-close-btn" id="btnCloseCallModal">&times;</button>
    </div>

    <form id="callWaiterForm">
      @csrf
      @if($activeTable)
        <input type="hidden" name="table_id" value="{{ $activeTable->id }}">
        <div class="modal-table-badge">
          📍 Meja Terhubung: <strong>Meja {{ $activeTable->table_number }}</strong>
        </div>
      @else
        <div style="margin-bottom: 14px;">
          <label style="display:block; font-size: 12.5px; font-weight: 700; margin-bottom: 6px; color: #1e293b;">Pilih Nomor Mejamu:</label>
          <select name="table_id" class="service-notes" style="margin-bottom:0;" required>
            <option value="">-- Pilih Nomor Meja --</option>
            @foreach($tables as $t)
              <option value="{{ $t->id }}">Meja {{ $t->table_number }}</option>
            @endforeach
          </select>
        </div>
      @endif

      <div style="margin-bottom: 14px;">
        <label style="display:block; font-size: 12.5px; font-weight: 700; margin-bottom: 8px; color: #1e293b;">Pilih Kebutuhan:</label>
        <div class="service-grid">
          <label class="service-opt active">
            <input type="radio" name="type" value="panggil_pelayan" checked>
            <span>🙋 Bantuan Pelayan</span>
          </label>
          <label class="service-opt">
            <input type="radio" name="type" value="minta_bill">
            <span>🧾 Minta Bill / Nota</span>
          </label>
          <label class="service-opt">
            <input type="radio" name="type" value="minta_air">
            <span>💧 Air Putih / Es</span>
          </label>
          <label class="service-opt">
            <input type="radio" name="type" value="bersih_meja">
            <span>🧹 Bersihkan Meja</span>
          </label>
        </div>
      </div>

      <div>
        <label style="display:block; font-size: 12.5px; font-weight: 700; margin-bottom: 6px; color: #1e293b;">Catatan Tambahan (Opsional):</label>
        <input type="text" name="notes" class="service-notes" placeholder="Contoh: Minta tissue atau sendok tambahan..." maxlength="150">
      </div>

      <button type="submit" class="btn-submit-action" id="btnSubmitCall">
        Kirim Panggilan 🛎️
      </button>
    </form>

    <div id="callSuccessState" style="display:none; text-align:center; padding: 20px 10px;">
      <div style="font-size: 40px; margin-bottom: 8px;">🏃💨</div>
      <h4 style="font-size: 17px; font-weight: 800; margin-bottom: 4px; color: #0f172a;">Panggilan Terkirim!</h4>
      <p style="font-size: 13px; color: #64748b; margin-bottom: 20px;">Staf kami sedang menuju ke mejamu. Mohon ditunggu ya kak!</p>
      <button type="button" class="btn-submit-action" id="btnCloseSuccess">Selesai</button>
    </div>
  </div>
</div>

<!-- Modal Pilih Meja -->
<div class="modal-backdrop" id="tableModalOverlay">
  <div class="modal-sheet">
    <div class="modal-top">
      <div>
        <h3 class="modal-title">📍 Pilih Nomor Meja</h3>
        <p class="modal-desc">Pilih meja tempat kamu duduk untuk menghubungkan pesanan.</p>
      </div>
      <button type="button" class="modal-close-btn" id="btnCloseTableModal">&times;</button>
    </div>

    <div class="table-selection-grid">
      @foreach($tables as $t)
        <button type="button" 
                class="table-select-card {{ ($activeTable && $activeTable->id === $t->id) ? 'active' : '' }}" 
                data-id="{{ $t->id }}" 
                data-number="{{ $t->table_number }}">
          <span class="table-card-icon">🪑</span>
          <span class="table-card-num">Meja {{ $t->table_number }}</span>
          <span class="table-card-badge">{{ ($activeTable && $activeTable->id === $t->id) ? '✓ Terhubung' : 'Pilih' }}</span>
        </button>
      @endforeach
    </div>
  </div>
</div>

<script>
  const grid = document.getElementById('menuGrid');
  const sectionTitle = document.getElementById('sectionTitle');
  const menuCount = document.getElementById('menuCount');
  const searchInput = document.getElementById('searchInput');
  const cards = Array.from(document.querySelectorAll('#menuGrid .menu-card'));

  function renderMenu() {
    const activeChip = document.querySelector('.chip.active');
    const category = activeChip ? activeChip.dataset.category : 'Semua';
    const keyword = searchInput.value.trim().toLowerCase();

    let visible = 0;
    cards.forEach(card => {
      const name = (card.dataset.name || '').toLowerCase();
      const cat = card.dataset.category || '';

      const matchCategory = category === 'Semua' || cat === category;
      const matchKeyword = name.includes(keyword);

      if (matchCategory && matchKeyword) {
        card.style.display = '';
        visible++;
      } else {
        card.style.display = 'none';
      }
    });

    sectionTitle.textContent = category === 'Semua' ? 'Semua Menu' : category;
    menuCount.textContent = visible + ' item';

    let empty = grid.querySelector('.grid-empty');
    if (visible === 0) {
      if (!empty) {
        empty = document.createElement('div');
        empty.className = 'grid-empty';
        empty.style.cssText = 'grid-column:1/-1; text-align:center; color:var(--text-muted); padding:36px 0; font-size:13px;';
        empty.textContent = 'Menu tidak ditemukan.';
        grid.appendChild(empty);
      }
    } else if (empty) {
      empty.remove();
    }
  }

  // Filter category interaction
  const chips = document.querySelectorAll('.chip');
  chips.forEach(chip => {
    chip.addEventListener('click', () => {
      chips.forEach(c => c.classList.remove('active'));
      chip.classList.add('active');
      renderMenu();
    });
  });

  // Search input interaction
  searchInput.addEventListener('input', renderMenu);

  // Table Selection Modal Interaction
  const btnOpenTableModal = document.getElementById('btnOpenTableModal');
  const tableModalOverlay = document.getElementById('tableModalOverlay');
  const btnCloseTableModal = document.getElementById('btnCloseTableModal');
  const tableCards = document.querySelectorAll('.table-select-card');
  const headerTableLabel = document.getElementById('headerTableLabel');

  function openTableModal() {
    tableModalOverlay?.classList.add('show');
  }
  function closeTableModal() {
    tableModalOverlay?.classList.remove('show');
  }

  btnOpenTableModal?.addEventListener('click', openTableModal);
  btnCloseTableModal?.addEventListener('click', closeTableModal);
  tableModalOverlay?.addEventListener('click', (e) => {
    if (e.target === tableModalOverlay) closeTableModal();
  });

  tableCards.forEach(card => {
    card.addEventListener('click', function() {
      const tableId = this.dataset.id;
      const tableNum = this.dataset.number;
      const badge = this.querySelector('.table-card-badge');
      const originalBadgeText = badge ? badge.textContent : 'Pilih';

      if (badge) badge.textContent = 'Menyimpan...';

      fetch("{{ route('customer.table.set') }}", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ table_id: tableId })
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          tableCards.forEach(c => {
            c.classList.remove('active');
            const b = c.querySelector('.table-card-badge');
            if (b) b.textContent = 'Pilih';
          });
          this.classList.add('active');
          if (badge) badge.textContent = '✓ Terhubung';

          if (headerTableLabel) {
            headerTableLabel.textContent = 'Meja ' + tableNum;
          }
          btnOpenTableModal?.classList.add('active');

          setTimeout(() => {
            window.location.reload();
          }, 350);
        } else {
          if (badge) badge.textContent = originalBadgeText;
          alert(data.message || 'Gagal memilih meja');
        }
      })
      .catch(() => {
        if (badge) badge.textContent = originalBadgeText;
        alert('Terjadi kesalahan jaringan.');
      });
    });
  });

  // Call Waiter Modal Interaction
  const btnOpenCallWaiter = document.getElementById('btnOpenCallWaiter');
  const callModalOverlay = document.getElementById('callModalOverlay');
  const btnCloseCallModal = document.getElementById('btnCloseCallModal');
  const btnCloseSuccess = document.getElementById('btnCloseSuccess');
  const callWaiterForm = document.getElementById('callWaiterForm');
  const callSuccessState = document.getElementById('callSuccessState');
  const btnSubmitCall = document.getElementById('btnSubmitCall');

  function openCallModal() {
    callModalOverlay.classList.add('show');
    callWaiterForm.style.display = '';
    callSuccessState.style.display = 'none';
  }
  function closeCallModal() {
    callModalOverlay.classList.remove('show');
  }

  btnOpenCallWaiter?.addEventListener('click', openCallModal);
  btnCloseCallModal?.addEventListener('click', closeCallModal);
  btnCloseSuccess?.addEventListener('click', closeCallModal);
  callModalOverlay?.addEventListener('click', (e) => {
    if (e.target === callModalOverlay) closeCallModal();
  });

  const serviceOpts = document.querySelectorAll('.service-opt');
  serviceOpts.forEach(opt => {
    opt.addEventListener('click', () => {
      serviceOpts.forEach(o => o.classList.remove('active'));
      opt.classList.add('active');
    });
  });

  callWaiterForm?.addEventListener('submit', function(e) {
    e.preventDefault();
    btnSubmitCall.disabled = true;
    btnSubmitCall.textContent = 'Mengirim...';

    const formData = new FormData(callWaiterForm);
    const postData = {
      table_id: formData.get('table_id'),
      type: formData.get('type'),
      notes: formData.get('notes')
    };

    fetch("{{ route('customer.call-waiter') }}", {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify(postData)
    })
    .then(res => res.json())
    .then(data => {
      btnSubmitCall.disabled = false;
      btnSubmitCall.textContent = 'Kirim Panggilan 🛎️';
      if (data.success) {
        callWaiterForm.style.display = 'none';
        callSuccessState.style.display = 'block';
      } else {
        alert(data.message || 'Gagal mengirim panggilan.');
      }
    })
    .catch(() => {
      btnSubmitCall.disabled = false;
      btnSubmitCall.textContent = 'Kirim Panggilan 🛎️';
      alert('Terjadi kesalahan jaringan.');
    });
  });
</script>
</body>
</html>