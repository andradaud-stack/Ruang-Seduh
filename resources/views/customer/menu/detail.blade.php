<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>{{ $menu->name }} - Ruang Seduh</title>
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
    --success: #10b981;
    --success-light: #ecfdf5;
    --danger: #ef4444;
    --danger-light: #fef2f2;
    --radius-lg: 20px;
    --radius-md: 12px;
  }

  * { box-sizing: border-box; margin: 0; padding: 0; }
  html, body { min-height: 100%; background: #0f172a; }
  body {
    font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    color: var(--text-primary);
    -webkit-font-smoothing: antialiased;
  }

  .detail-wrap {
    width: 100%;
    max-width: 480px;
    margin: 0 auto;
    min-height: 100vh;
    background: var(--bg-page);
    position: relative;
    padding-bottom: 100px;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
  }

  /* Hero Banner */
  .hero-container {
    position: relative;
    width: 100%;
    height: 330px;
    background: #f1f5f9;
    overflow: hidden;
  }
  .hero-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }
  .hero-fallback {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    font-size: 64px;
    color: var(--text-muted);
  }

  /* Floating Back Button */
  .nav-back-btn {
    position: absolute;
    top: 20px;
    left: 20px;
    z-index: 20;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    border: 1px solid rgba(226, 232, 240, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    color: var(--text-primary);
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.08);
    transition: all 0.15s ease;
  }
  .nav-back-btn:hover {
    background: #ffffff;
    transform: scale(1.05);
  }
  .nav-back-btn svg {
    width: 18px;
    height: 18px;
    stroke: currentColor;
    stroke-width: 2.2;
    fill: none;
  }

  /* Detail Content Sheet */
  .detail-sheet {
    position: relative;
    margin-top: -24px;
    background: var(--card-bg);
    border-radius: 28px 28px 0 0;
    border-top: 1px solid rgba(226, 232, 240, 0.8);
    padding: 24px 22px;
    box-shadow: 0 -8px 24px rgba(15, 23, 42, 0.04);
  }

  /* Header details */
  .detail-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 16px;
    margin-bottom: 12px;
  }
  .product-title {
    font-size: 22px;
    font-weight: 800;
    letter-spacing: -0.02em;
    color: var(--text-primary);
    line-height: 1.25;
  }
  .product-price {
    flex-shrink: 0;
    font-size: 20px;
    font-weight: 800;
    color: var(--brand);
    font-variant-numeric: tabular-nums;
  }

  .meta-row {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
  }
  .category-badge {
    font-size: 11.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    background: #f1f5f9;
    color: var(--text-secondary);
    padding: 4px 10px;
    border-radius: 6px;
  }
  .stock-pill {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    font-weight: 600;
    padding: 3px 10px;
    border-radius: 999px;
  }
  .stock-pill.in-stock {
    background: var(--success-light);
    color: #065f46;
  }
  .stock-pill.out-stock {
    background: var(--danger-light);
    color: #991b1b;
  }
  .stock-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
  }
  .stock-pill.in-stock .stock-dot { background: var(--success); }
  .stock-pill.out-stock .stock-dot { background: var(--danger); }

  .product-desc {
    font-size: 13.5px;
    line-height: 1.6;
    color: var(--text-secondary);
    margin-bottom: 24px;
    padding-bottom: 20px;
    border-bottom: 1px solid var(--border);
  }

  /* Form Customization Sections */
  .option-group {
    margin-bottom: 22px;
  }
  .group-title {
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    color: var(--text-secondary);
    margin-bottom: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .group-optional {
    font-size: 11px;
    font-weight: 500;
    text-transform: none;
    color: var(--text-muted);
  }

  /* Segmented Control / Modern Chips */
  .segmented-control {
    display: flex;
    background: #f1f5f9;
    border-radius: var(--radius-md);
    padding: 4px;
    gap: 4px;
  }
  .segment-btn {
    flex: 1;
    text-align: center;
    padding: 10px 12px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 700;
    color: var(--text-secondary);
    cursor: pointer;
    border: none;
    background: transparent;
    transition: all 0.15s ease;
    user-select: none;
  }
  .segment-btn.active {
    background: #ffffff;
    color: var(--text-primary);
    box-shadow: 0 1px 4px rgba(15, 23, 42, 0.08);
  }

  /* Chips Grid for Sugar Level */
  .chips-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 8px;
  }
  .chip-option {
    padding: 10px 6px;
    border-radius: var(--radius-md);
    border: 1.5px solid var(--border);
    background: #ffffff;
    color: var(--text-secondary);
    font-size: 12px;
    font-weight: 600;
    text-align: center;
    cursor: pointer;
    transition: all 0.15s ease;
    user-select: none;
  }
  .chip-option:hover {
    border-color: var(--border-hover);
  }
  .chip-option.active {
    background: #0f172a;
    border-color: #0f172a;
    color: #ffffff;
  }

  /* Notes Input */
  .notes-input {
    width: 100%;
    padding: 12px 14px;
    border-radius: var(--radius-md);
    background: #ffffff;
    border: 1px solid var(--border);
    font-family: inherit;
    font-size: 13.5px;
    color: var(--text-primary);
    outline: none;
    transition: all 0.15s ease;
  }
  .notes-input:focus {
    border-color: var(--brand);
    box-shadow: 0 0 0 3px rgba(15, 23, 42, 0.08);
  }
  .notes-input::placeholder {
    color: var(--text-muted);
  }

  /* Sticky Bottom Bar */
  .sticky-bottom-bar {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    display: flex;
    justify-content: center;
    z-index: 50;
    pointer-events: none;
  }
  .bottom-card {
    width: 100%;
    max-width: 480px;
    pointer-events: auto;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border-top: 1px solid var(--border);
    padding: 14px 20px calc(14px + env(safe-area-inset-bottom));
  }
  .btn-add-cart {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 14px;
    border-radius: var(--radius-md);
    background: var(--brand);
    color: #ffffff;
    border: none;
    font-family: inherit;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    box-shadow: 0 4px 14px rgba(15, 23, 42, 0.15);
    transition: all 0.15s ease;
  }
  .btn-add-cart:hover {
    background: var(--brand-hover);
  }
  .btn-add-cart:active {
    transform: scale(0.98);
  }
  .btn-add-cart:disabled {
    background: #cbd5e1;
    color: #94a3b8;
    cursor: not-allowed;
    box-shadow: none;
    transform: none;
  }
  .btn-add-cart svg {
    width: 18px;
    height: 18px;
    stroke: currentColor;
    stroke-width: 2.2;
    fill: none;
  }
</style>
</head>
<body>

<div class="detail-wrap">

  <!-- Hero Banner -->
  <div class="hero-container">
    <a href="{{ route('customer.home') }}" class="nav-back-btn" aria-label="Kembali">
      <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"></polyline></svg>
    </a>

    @if($menu->image)
      <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="hero-img">
    @else
      <div class="hero-fallback">☕</div>
    @endif
  </div>

  @php
    $variants = $menu->variants ?? ['Ice', 'Hot'];
    $stockReady = (int) ($menu->stock ?? 0) > 0;
  @endphp

  <!-- Detail Content Sheet -->
  <div class="detail-sheet">

    <div class="detail-header">
      <div>
        <h1 class="product-title">{{ $menu->name }}</h1>
      </div>
      <div class="product-price">{{ $menu->hargaRupiah() }}</div>
    </div>

    <div class="meta-row">
      <span class="category-badge">{{ $menu->kategori->name ?? 'Menu' }}</span>
      <span class="stock-pill {{ $stockReady ? 'in-stock' : 'out-stock' }}">
        <span class="stock-dot"></span>
        <span>{{ $stockReady ? 'Tersedia ' . $menu->stock . ' porsi' : 'Stok Habis' }}</span>
      </span>
    </div>

    @if(!empty($menu->description))
      <p class="product-desc">{{ $menu->description }}</p>
    @else
      <div style="margin-bottom: 20px; border-bottom: 1px solid var(--border);"></div>
    @endif

    @if(Route::has('customer.cart.add'))
      <form action="{{ route('customer.cart.add') }}" method="POST" id="menuForm">
        @csrf
        <input type="hidden" name="product_id" value="{{ $menu->id }}">

        @if(!empty($variants))
          <input type="hidden" name="variant" id="inputVariant" value="{{ $variants[0] }}">
          <div class="option-group">
            <div class="group-title">
              <span>Pilihan Suhu</span>
            </div>
            <div class="segmented-control" id="variantSegments">
              @foreach($variants as $i => $v)
                <button type="button" class="segment-btn {{ $i === 0 ? 'active' : '' }}" data-val="{{ $v }}">
                  {{ $v }}
                </button>
              @endforeach
            </div>
          </div>
        @endif

        <input type="hidden" name="sugar_level" id="inputSugar" value="Normal (100%)">
        <div class="option-group">
          <div class="group-title">
            <span>Tingkat Kemanisan (Sugar Level)</span>
          </div>
          <div class="chips-row" id="sugarChips">
            <div class="chip-option active" data-sugar="Normal (100%)">Normal (100%)</div>
            <div class="chip-option" data-sugar="Less Sugar (50%)">Less (50%)</div>
            <div class="chip-option" data-sugar="No Sugar (0%)">No Sugar (0%)</div>
          </div>
        </div>

        <div class="option-group" style="margin-bottom: 30px;">
          <div class="group-title">
            <span>Catatan Khusus</span>
            <span class="group-optional">Opsional</span>
          </div>
          <input type="text" name="notes" class="notes-input" placeholder="Contoh: Es sedikit, jangan terlalu manis..." maxlength="150">
        </div>
      </form>
    @endif

  </div>

  <!-- Sticky Bottom Action Bar -->
  <div class="sticky-bottom-bar">
    <div class="bottom-card">
      @if(Route::has('customer.cart.add'))
        <button type="submit" form="menuForm" class="btn-add-cart" {{ $stockReady ? '' : 'disabled' }}>
          <svg viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
          <span>{{ $stockReady ? 'Tambah ke Keranjang' : 'Stok Sedang Habis' }}</span>
        </button>
      @else
        <button type="button" class="btn-add-cart" disabled>Tambah ke Keranjang</button>
      @endif
    </div>
  </div>

</div>

<script>
  // Variant Toggle
  const variantBtns = document.querySelectorAll('#variantSegments .segment-btn');
  const inputVariant = document.getElementById('inputVariant');
  if (variantBtns.length > 0 && inputVariant) {
    variantBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        variantBtns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        inputVariant.value = btn.dataset.val;
      });
    });
  }

  // Sugar Level Toggle
  const sugarChips = document.querySelectorAll('#sugarChips .chip-option');
  const inputSugar = document.getElementById('inputSugar');
  if (sugarChips.length > 0 && inputSugar) {
    sugarChips.forEach(chip => {
      chip.addEventListener('click', () => {
        sugarChips.forEach(c => c.classList.remove('active'));
        chip.classList.add('active');
        inputSugar.value = chip.dataset.sugar;
      });
    });
  }
</script>
</body>
</html>