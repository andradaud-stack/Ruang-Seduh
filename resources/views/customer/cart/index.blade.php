<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>Keranjang Kamu - Ruang Seduh</title>
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

  .cart-wrap {
    width: 100%;
    max-width: 480px;
    margin: 0 auto;
    min-height: 100vh;
    background: var(--bg-page);
    position: relative;
    padding-bottom: 140px;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    display: flex;
    flex-direction: column;
  }

  /* Header */
  .cart-header {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 24px 20px 18px;
    background: #ffffff;
    border-bottom: 1px solid var(--border);
    position: sticky;
    top: 0;
    z-index: 30;
  }
  .cart-back {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: #f8fafc;
    border: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    color: var(--text-primary);
    flex-shrink: 0;
    transition: all 0.15s ease;
  }
  .cart-back:hover {
    background: #ffffff;
    border-color: var(--border-hover);
  }
  .cart-back svg {
    width: 18px;
    height: 18px;
    stroke: currentColor;
    stroke-width: 2.2;
    fill: none;
  }
  .cart-header h1 {
    font-size: 18px;
    font-weight: 800;
    letter-spacing: -0.02em;
    color: var(--text-primary);
  }
  .cart-count-badge {
    font-size: 12px;
    font-weight: 600;
    color: var(--text-muted);
    margin-left: auto;
  }

  /* Body Content */
  .cart-body {
    flex: 1;
    padding: 18px 20px;
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  /* Cart Item Card */
  .cart-card {
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 14px;
    display: flex;
    align-items: center;
    gap: 14px;
    transition: border-color 0.15s ease;
  }
  .cart-card:hover {
    border-color: var(--border-hover);
  }
  .item-thumb {
    width: 60px;
    height: 60px;
    border-radius: var(--radius-md);
    background: #f1f5f9;
    overflow: hidden;
    flex-shrink: 0;
  }
  .item-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }
  .item-thumb-fallback {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    color: var(--text-muted);
  }

  .item-info {
    flex: 1;
    min-width: 0;
  }
  .item-name {
    font-size: 14.5px;
    font-weight: 700;
    color: var(--text-primary);
    line-height: 1.3;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  .item-price {
    font-size: 13.5px;
    font-weight: 700;
    color: var(--brand);
    margin-top: 3px;
    font-variant-numeric: tabular-nums;
  }
  .item-details {
    font-size: 11.5px;
    color: var(--text-secondary);
    margin-top: 3px;
  }
  .item-notes {
    font-size: 11.5px;
    color: #b45309;
    margin-top: 4px;
    font-style: italic;
    display: inline-block;
    background: #fef3c7;
    padding: 2px 8px;
    border-radius: 6px;
  }

  /* Stepper */
  .stepper {
    display: flex;
    align-items: center;
    background: #f8fafc;
    border: 1px solid var(--border);
    border-radius: 999px;
    padding: 3px 6px;
    gap: 8px;
    flex-shrink: 0;
  }
  .step-btn {
    width: 26px;
    height: 26px;
    border-radius: 50%;
    background: #ffffff;
    border: 1px solid var(--border);
    color: var(--text-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    padding: 0;
    transition: all 0.15s ease;
  }
  .step-btn:hover {
    background: #0f172a;
    color: #ffffff;
    border-color: #0f172a;
  }
  .step-btn svg {
    width: 12px;
    height: 12px;
    stroke: currentColor;
    stroke-width: 2.4;
    fill: none;
    stroke-linecap: round;
  }
  .step-qty {
    font-size: 13.5px;
    font-weight: 700;
    color: var(--text-primary);
    min-width: 18px;
    text-align: center;
    font-variant-numeric: tabular-nums;
  }

  /* Empty State */
  .empty-state {
    text-align: center;
    padding: 60px 20px 40px;
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  .empty-icon {
    width: 72px;
    height: 72px;
    border-radius: 50%;
    background: #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    margin-bottom: 16px;
  }
  .empty-title {
    font-size: 17px;
    font-weight: 800;
    color: var(--text-primary);
    margin-bottom: 6px;
  }
  .empty-desc {
    font-size: 13.5px;
    color: var(--text-muted);
    line-height: 1.5;
    max-width: 280px;
    margin-bottom: 24px;
  }
  .btn-explore {
    padding: 12px 24px;
    border-radius: 999px;
    background: var(--brand);
    color: #ffffff;
    font-size: 13.5px;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.15s ease;
  }
  .btn-explore:hover {
    background: var(--brand-hover);
  }

  /* Bottom Checkout Dock */
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
    width: 100%;
    max-width: 480px;
    pointer-events: auto;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border-top: 1px solid var(--border);
    padding: 16px 20px calc(16px + env(safe-area-inset-bottom));
    box-shadow: 0 -10px 25px rgba(15, 23, 42, 0.05);
  }
  .total-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 14px;
  }
  .total-label {
    font-size: 13px;
    font-weight: 600;
    color: var(--text-secondary);
  }
  .total-val {
    font-size: 19px;
    font-weight: 800;
    color: var(--text-primary);
    letter-spacing: -0.01em;
    font-variant-numeric: tabular-nums;
  }
  .btn-checkout {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 14px;
    border-radius: var(--radius-md);
    font-size: 15px;
    font-weight: 700;
    text-decoration: none;
    text-align: center;
    transition: all 0.15s ease;
  }
  .btn-checkout.enabled {
    background: var(--brand);
    color: #ffffff;
    cursor: pointer;
    box-shadow: 0 4px 14px rgba(15, 23, 42, 0.15);
  }
  .btn-checkout.enabled:hover {
    background: var(--brand-hover);
  }
  .btn-checkout.disabled {
    background: #f1f5f9;
    color: #94a3b8;
    cursor: not-allowed;
    border: 1px solid var(--border);
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
        <h2 class="empty-title">Keranjang Kamu Masih Kosong</h2>
        <p class="empty-desc">Yuk temukan kopi dan hidangan favoritmu dari menu Ruang Seduh.</p>
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
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
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
</body>
</html>