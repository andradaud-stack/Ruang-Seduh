<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <title>{{ $menu->name }} — Ruang Seduh</title>
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

    button, input { font: inherit; }
    button { border: 0; cursor: pointer; }

    .detail-wrap {
      width: min(100%, 720px);
      margin: 0 auto;
      min-height: 100vh;
      background: var(--cream);
      position: relative;
      padding-bottom: 120px;
      box-shadow: 0 0 50px rgba(36, 23, 15, 0.08);
    }

    /* Hero Image / Art Container */
    .hero-container {
      position: relative;
      width: 100%;
      height: 360px;
      background: #d9c1a6;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .hero-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    /* Stylized Fallback Art */
    .cup-art {
      width: 150px;
      height: 105px;
      border-radius: 26px 26px 50px 50px;
      background: #f8f5ef;
      position: relative;
      box-shadow: 0 20px 30px rgba(52, 28, 15, 0.25);
      transform: translateY(10px);
    }
    .cup-art::before {
      content: "";
      position: absolute;
      width: 124px;
      height: 38px;
      top: 6px;
      left: 13px;
      border-radius: 50%;
      background: radial-gradient(circle at 50% 50%, #d79b5f, #5a351f 70%);
      box-shadow: inset 0 5px 8px rgba(255, 255, 255, 0.25);
    }
    .cup-art::after {
      content: "";
      position: absolute;
      width: 42px;
      height: 46px;
      border: 12px solid #f8f5ef;
      border-left: 0;
      border-radius: 0 50% 50% 0;
      right: -32px;
      top: 25px;
    }

    /* Floating Back Button */
    .nav-back-btn {
      position: absolute;
      top: 20px;
      left: 24px;
      z-index: 20;
      width: 44px;
      height: 44px;
      border-radius: 50%;
      background: rgba(255, 253, 249, 0.92);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border: 1px solid rgba(255, 255, 255, 0.9);
      display: flex;
      align-items: center;
      justify-content: center;
      text-decoration: none;
      color: var(--ink);
      box-shadow: 0 8px 24px rgba(36, 23, 15, 0.12);
      transition: all 0.2s ease;
    }
    .nav-back-btn:hover {
      background: #ffffff;
      transform: scale(1.06);
    }
    .nav-back-btn svg {
      width: 20px;
      height: 20px;
      stroke: currentColor;
      stroke-width: 2.3;
      fill: none;
    }

    /* Detail Sheet */
    .detail-sheet {
      position: relative;
      margin-top: -28px;
      background: var(--paper);
      border-radius: 32px 32px 0 0;
      border-top: 1px solid rgba(255, 255, 255, 0.8);
      padding: 30px 28px;
      box-shadow: 0 -12px 30px rgba(36, 23, 15, 0.05);
    }

    .detail-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      gap: 16px;
      margin-bottom: 14px;
    }

    .product-title {
      font-family: "Playfair Display", serif;
      font-size: 26px;
      font-weight: 700;
      color: var(--ink);
      line-height: 1.25;
    }

    .product-price {
      flex-shrink: 0;
      font-size: 22px;
      font-weight: 800;
      color: var(--brown);
      font-variant-numeric: tabular-nums;
    }

    .meta-row {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 18px;
    }

    .category-badge {
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.06em;
      background: #f3eae0;
      color: var(--brown);
      padding: 5px 12px;
      border-radius: 999px;
    }

    .stock-pill {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 12px;
      font-weight: 700;
      padding: 4px 12px;
      border-radius: 999px;
    }
    .stock-pill.in-stock {
      background: var(--green-bg);
      color: var(--green);
    }
    .stock-pill.out-stock {
      background: #fee2e2;
      color: #b91c1c;
    }
    .stock-dot {
      width: 7px;
      height: 7px;
      border-radius: 50%;
      background: currentColor;
    }

    .product-desc {
      font-size: 14px;
      line-height: 1.65;
      color: #665950;
      margin-bottom: 26px;
      padding-bottom: 22px;
      border-bottom: 1px solid var(--line);
    }

    /* Option Groups */
    .option-group {
      margin-bottom: 24px;
    }

    .group-title {
      font-size: 12px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      color: var(--brown-2);
      margin-bottom: 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .group-optional {
      font-size: 11px;
      font-weight: 600;
      text-transform: none;
      color: var(--muted);
    }

    /* Segmented Control */
    .segmented-control {
      display: flex;
      background: #f1e9df;
      border-radius: 16px;
      padding: 5px;
      gap: 6px;
      border: 1px solid var(--line);
    }

    .segment-btn {
      flex: 1;
      text-align: center;
      padding: 11px 14px;
      border-radius: 12px;
      font-size: 13.5px;
      font-weight: 700;
      color: var(--muted);
      cursor: pointer;
      border: none;
      background: transparent;
      transition: all 0.2s ease;
      user-select: none;
    }

    .segment-btn.active {
      background: #ffffff;
      color: var(--brown);
      box-shadow: 0 4px 12px rgba(90, 53, 31, 0.12);
    }

    /* Chips Row */
    .chips-row {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 10px;
    }

    .chip-option {
      padding: 12px 8px;
      border-radius: 16px;
      border: 1.5px solid var(--line);
      background: #ffffff;
      color: #655950;
      font-size: 12.5px;
      font-weight: 700;
      text-align: center;
      cursor: pointer;
      transition: all 0.2s ease;
      user-select: none;
    }

    .chip-option:hover {
      border-color: var(--brown);
      color: var(--brown);
    }

    .chip-option.active {
      background: var(--brown);
      border-color: var(--brown);
      color: #ffffff;
      box-shadow: 0 4px 12px rgba(90, 53, 31, 0.2);
    }

    /* Notes Input */
    .notes-input {
      width: 100%;
      padding: 13px 16px;
      border-radius: 16px;
      background: #ffffff;
      border: 1px solid var(--line);
      font-family: inherit;
      font-size: 13.5px;
      color: var(--ink);
      outline: none;
      transition: all 0.2s ease;
    }

    .notes-input:focus {
      border-color: var(--brown);
      box-shadow: 0 0 0 3px rgba(90, 53, 31, 0.1);
    }

    .notes-input::placeholder {
      color: #a89f97;
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
      width: min(100%, 720px);
      pointer-events: auto;
      background: rgba(255, 253, 249, 0.94);
      backdrop-filter: blur(18px);
      -webkit-backdrop-filter: blur(18px);
      border-top: 1px solid var(--line);
      padding: 16px 28px calc(16px + env(safe-area-inset-bottom));
      box-shadow: 0 -10px 30px rgba(36, 23, 15, 0.08);
    }

    .btn-add-cart {
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      padding: 15px;
      border-radius: 16px;
      background: var(--brown);
      color: #ffffff;
      border: none;
      font-family: inherit;
      font-size: 15px;
      font-weight: 700;
      cursor: pointer;
      box-shadow: 0 8px 22px rgba(90, 53, 31, 0.25);
      transition: all 0.15s ease;
    }

    .btn-add-cart:hover {
      background: var(--brown-2);
      transform: translateY(-2px);
    }

    .btn-add-cart:active {
      transform: scale(0.98);
    }

    .btn-add-cart:disabled {
      background: #d8cec3;
      color: #8c8179;
      cursor: not-allowed;
      box-shadow: none;
      transform: none;
    }

    .btn-add-cart svg {
      width: 19px;
      height: 19px;
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
      <div class="cup-art"></div>
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
      <div style="margin-bottom: 20px; border-bottom: 1px solid var(--line);"></div>
    @endif

    @if(Route::has('customer.cart.add'))
      <form action="{{ route('customer.cart.add') }}" method="POST" id="menuForm">
        @csrf
        <input type="hidden" name="product_id" value="{{ $menu->id }}">

        @if(!empty($variants))
          <input type="hidden" name="variant" id="inputVariant" value="{{ $variants[0] }}">
          <div class="option-group">
            <div class="group-title">
              <span>Pilihan Suhu / Varian</span>
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

@include('customer.include.order_notifications')
</body>
</html>