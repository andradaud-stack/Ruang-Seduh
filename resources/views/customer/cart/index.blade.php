<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <title>Keranjang Kamu — Ruang Seduh</title>
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

    .cart-wrap {
      width: min(100%, 720px);
      margin: 0 auto;
      min-height: 100vh;
      background: var(--cream);
      position: relative;
      padding-bottom: 140px;
      box-shadow: 0 0 50px rgba(36, 23, 15, 0.08);
      display: flex;
      flex-direction: column;
    }

    /* Header */
    .cart-header {
      display: flex;
      align-items: center;
      gap: 16px;
      padding: 24px 28px 18px;
      background: rgba(247, 241, 233, 0.95);
      backdrop-filter: blur(14px);
      -webkit-backdrop-filter: blur(14px);
      border-bottom: 1px solid rgba(233, 224, 214, 0.8);
      position: sticky;
      top: 0;
      z-index: 30;
    }

    .cart-back {
      width: 42px;
      height: 42px;
      border-radius: 50%;
      background: #ffffff;
      border: 1px solid var(--line);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--ink);
      box-shadow: 0 4px 12px rgba(36, 23, 15, 0.06);
      transition: all 0.2s ease;
      flex-shrink: 0;
    }
    .cart-back:hover {
      background: #fffdfa;
      transform: scale(1.05);
    }
    .cart-back svg {
      width: 20px;
      height: 20px;
      stroke: currentColor;
      stroke-width: 2.3;
      fill: none;
    }

    .cart-header h1 {
      font-family: "Playfair Display", serif;
      font-size: 22px;
      font-weight: 700;
      color: var(--ink);
    }

    .cart-count-badge {
      font-size: 12px;
      font-weight: 700;
      color: var(--brown);
      background: #f1e7dd;
      padding: 5px 12px;
      border-radius: 999px;
      margin-left: auto;
    }

    /* Body */
    .cart-body {
      flex: 1;
      padding: 22px 28px;
      display: flex;
      flex-direction: column;
      gap: 14px;
    }

    /* Item Card */
    .cart-card {
      background: var(--paper);
      border: 1px solid var(--line);
      border-radius: 20px;
      padding: 16px;
      display: flex;
      align-items: center;
      gap: 16px;
      box-shadow: 0 6px 20px rgba(36, 23, 15, 0.04);
      transition: border-color 0.2s ease, transform 0.2s ease;
    }
    .cart-card:hover {
      border-color: #dfd3c5;
      transform: translateY(-2px);
    }

    .item-thumb {
      width: 68px;
      height: 68px;
      border-radius: 16px;
      background: #eddccb;
      overflow: hidden;
      flex-shrink: 0;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .item-thumb img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }
    .item-thumb-fallback {
      font-size: 28px;
      color: var(--brown);
    }

    .item-info {
      flex: 1;
      min-width: 0;
    }
    .item-name {
      font-size: 15px;
      font-weight: 700;
      color: var(--ink);
      line-height: 1.3;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .item-price {
      font-size: 14px;
      font-weight: 800;
      color: var(--brown);
      margin-top: 4px;
      font-variant-numeric: tabular-nums;
    }
    .item-details {
      font-size: 12px;
      color: var(--muted);
      margin-top: 3px;
    }
    .item-notes {
      font-size: 11.5px;
      color: var(--brown-2);
      margin-top: 5px;
      background: #fbf1e6;
      border: 1px solid #ebd9c8;
      padding: 3px 9px;
      border-radius: 8px;
      display: inline-block;
      font-style: italic;
    }

    /* Stepper */
    .stepper {
      display: flex;
      align-items: center;
      background: #f7f1e9;
      border: 1px solid var(--line);
      border-radius: 999px;
      padding: 4px 8px;
      gap: 10px;
      flex-shrink: 0;
    }
    .step-btn {
      width: 28px;
      height: 28px;
      border-radius: 50%;
      background: #ffffff;
      border: 1px solid var(--line);
      color: var(--ink);
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.15s ease;
    }
    .step-btn:hover {
      background: var(--brown);
      color: #ffffff;
      border-color: var(--brown);
    }
    .step-btn svg {
      width: 12px;
      height: 12px;
      stroke: currentColor;
      stroke-width: 2.5;
      fill: none;
      stroke-linecap: round;
    }
    .step-qty {
      font-size: 14px;
      font-weight: 800;
      color: var(--ink);
      min-width: 20px;
      text-align: center;
      font-variant-numeric: tabular-nums;
    }

    /* Empty State */
    .empty-state {
      text-align: center;
      padding: 70px 20px 50px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .empty-icon {
      width: 84px;
      height: 84px;
      border-radius: 50%;
      background: #f3eae0;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 38px;
      margin-bottom: 20px;
      box-shadow: 0 10px 25px rgba(36, 23, 15, 0.06);
    }
    .empty-title {
      font-family: "Playfair Display", serif;
      font-size: 22px;
      font-weight: 700;
      color: var(--ink);
      margin-bottom: 8px;
    }
    .empty-desc {
      font-size: 14px;
      color: var(--muted);
      line-height: 1.55;
      max-width: 320px;
      margin-bottom: 28px;
    }
    .btn-explore {
      padding: 14px 28px;
      border-radius: 999px;
      background: var(--brown);
      color: #ffffff;
      font-size: 14px;
      font-weight: 700;
      box-shadow: 0 8px 20px rgba(90, 53, 31, 0.25);
      transition: all 0.2s ease;
    }
    .btn-explore:hover {
      background: var(--brown-2);
      transform: translateY(-2px);
    }

    /* Checkout Bar */
    .cart-bottom-wrap {
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      display: flex;
      justify-content: center;
      z-index: 40;
      pointer-events: none;
    }
    .cart-bottom {
      width: min(100%, 720px);
      pointer-events: auto;
      background: rgba(255, 253, 249, 0.95);
      backdrop-filter: blur(18px);
      -webkit-backdrop-filter: blur(18px);
      border-top: 1px solid var(--line);
      padding: 18px 28px calc(18px + env(safe-area-inset-bottom));
      box-shadow: 0 -12px 35px rgba(36, 23, 15, 0.08);
    }
    .total-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 14px;
    }
    .total-label {
      font-size: 13.5px;
      font-weight: 600;
      color: var(--muted);
    }
    .total-val {
      font-family: "Playfair Display", serif;
      font-size: 22px;
      font-weight: 800;
      color: var(--ink);
      font-variant-numeric: tabular-nums;
    }
    .btn-checkout {
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      padding: 15px;
      border-radius: 16px;
      font-size: 15px;
      font-weight: 700;
      text-align: center;
      transition: all 0.15s ease;
    }
    .btn-checkout.enabled {
      background: var(--brown);
      color: #ffffff;
      box-shadow: 0 8px 22px rgba(90, 53, 31, 0.25);
    }
    .btn-checkout.enabled:hover {
      background: var(--brown-2);
      transform: translateY(-2px);
    }
    .btn-checkout.disabled {
      background: #e9e0d6;
      color: #a89f97;
      cursor: not-allowed;
    }

    @media (max-width: 480px) {
      .cart-header { padding: 18px 20px 14px; }
      .cart-body { padding: 18px 20px; }
      .cart-bottom { padding: 16px 20px calc(16px + env(safe-area-inset-bottom)); }
      .cart-card { padding: 13px; gap: 12px; }
      .item-thumb { width: 58px; height: 58px; }
    }
  </style>
</head>
<body>

<div class="cart-wrap">

  <!-- Header -->
  <header class="cart-header">
    <a href="{{ route('customer.home') }}" class="cart-back" aria-label="Kembali ke Beranda">
      <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"></polyline></svg>
    </a>
    <h1>Keranjang Kamu</h1>
    <span class="cart-count-badge">{{ count($cart) }} item</span>
  </header>

  <!-- Cart Items List -->
  <div class="cart-body">
    @forelse($cart as $key => $item)
      <div class="cart-card">
        <div class="item-thumb">
          @if(!empty($item['image']))
            <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}">
          @else
            <div class="item-thumb-fallback">☕</div>
          @endif
        </div>
        <div class="item-info">
          <div class="item-name">{{ $item['name'] }}</div>
          <div class="item-price">Rp {{ number_format($item['price'], 0, ',', '.') }}</div>
          @php
            $details = [];
            if (!empty($item['variant'])) $details[] = $item['variant'];
            if (!empty($item['sugar_level'])) $details[] = $item['sugar_level'];
          @endphp
          @if(!empty($details))
            <div class="item-details">{{ implode(' · ', $details) }}</div>
          @endif
          @if(!empty($item['notes']))
            <div class="item-notes">"{{ $item['notes'] }}"</div>
          @endif
        </div>
        <div class="stepper">
          <button type="button" class="step-btn" onclick="changeQty(@js($key), -1)" aria-label="Kurangi">
            <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
          </button>
          <span class="step-qty" id="ckqty_{{ $key }}">{{ $item['qty'] }}</span>
          <button type="button" class="step-btn" onclick="changeQty(@js($key), 1)" aria-label="Tambah">
            <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
          </button>
        </div>
      </div>
    @empty
      <div class="empty-state">
        <div class="empty-icon">☕</div>
        <h2 class="empty-title">Keranjang Masih Kosong</h2>
        <p class="empty-desc">Yuk temukan kopi dan hidangan artisan favoritmu dari menu Ruang Seduh.</p>
        <a href="{{ route('customer.home') }}" class="btn-explore">Pilih Menu Sekarang</a>
      </div>
    @endforelse
  </div>

  <!-- Bottom Checkout Sheet -->
  <div class="cart-bottom-wrap">
    <div class="cart-bottom">
      <div class="total-row">
        <span class="total-label">Total Pembayaran</span>
        <span class="total-val">Rp {{ number_format($total, 0, ',', '.') }}</span>
      </div>
      @if(Route::has('customer.checkout') && $total > 0)
        <a href="{{ route('customer.checkout') }}" class="btn-checkout enabled">
          <span>Lanjut ke Pembayaran</span>
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
        </a>
      @else
        <span class="btn-checkout disabled">Checkout</span>
      @endif
    </div>
  </div>

</div>

<script>
  function changeQty(key, delta){
    const csrf = "{{ csrf_token() }}";
    const qtyKey = 'ckqty_' + key;
    let qty = parseInt(document.getElementById(qtyKey)?.textContent || '1') + delta;
    if (qty < 0) qty = 0;

    fetch("{{ route('customer.cart.update') }}", {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrf,
        'Accept': 'application/json'
      },
      body: JSON.stringify({ key: key, qty: qty }),
      credentials: 'same-origin'
    }).then(() => window.location.reload());
  }
</script>

@include('customer.include.order_notifications')
</body>
</html>