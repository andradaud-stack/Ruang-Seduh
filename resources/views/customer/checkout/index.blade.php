<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>Checkout - Ruang Seduh</title>
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

  .co-wrap {
    width: 100%;
    max-width: 480px;
    margin: 0 auto;
    min-height: 100vh;
    background: var(--bg-page);
    position: relative;
    padding-bottom: 120px;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
  }

  /* Header */
  .co-header {
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
  .co-back {
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
  .co-back:hover {
    background: #ffffff;
    border-color: var(--border-hover);
  }
  .co-back svg {
    width: 18px;
    height: 18px;
    stroke: currentColor;
    stroke-width: 2.2;
    fill: none;
  }
  .co-header h1 {
    font-size: 18px;
    font-weight: 800;
    letter-spacing: -0.02em;
    color: var(--text-primary);
  }

  /* Main Form Area */
  .co-body {
    padding: 18px 20px;
    display: flex;
    flex-direction: column;
    gap: 18px;
  }

  /* Table Badge Card */
  .table-card {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    padding: 14px 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .table-card-label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    font-weight: 600;
    color: var(--text-secondary);
  }
  .table-card-label span.dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: var(--success);
    box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2);
  }
  .table-card-val {
    font-size: 14px;
    font-weight: 800;
    color: var(--text-primary);
  }

  /* Section Headings */
  .section-title {
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    color: var(--text-secondary);
    margin-bottom: 8px;
    display: block;
  }

  /* Payment Options */
  .payment-options {
    display: flex;
    flex-direction: column;
    gap: 8px;
  }
  .pay-option {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 16px;
    background: #ffffff;
    border: 1.5px solid var(--border);
    border-radius: var(--radius-md);
    cursor: pointer;
    transition: all 0.15s ease;
    text-align: left;
  }
  .pay-option:hover {
    border-color: var(--border-hover);
  }
  .pay-option.active {
    border-color: var(--brand);
    background: #f8fafc;
    box-shadow: 0 0 0 1px var(--brand);
  }
  .pay-option-left {
    display: flex;
    align-items: center;
    gap: 12px;
  }
  .pay-icon {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    background: #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    color: var(--text-primary);
  }
  .pay-name {
    font-size: 14.5px;
    font-weight: 700;
    color: var(--text-primary);
  }
  .pay-sub {
    font-size: 11.5px;
    color: var(--text-muted);
  }
  .pay-radio {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    border: 2px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.15s ease;
  }
  .pay-option.active .pay-radio {
    border-color: var(--brand);
  }
  .pay-option.active .pay-radio::after {
    content: "";
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: var(--brand);
  }

  /* Order Summary List */
  .order-summary-card {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 16px;
  }
  .summary-item {
    display: flex;
    gap: 12px;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #f1f5f9;
  }
  .summary-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
  }
  .summary-item:first-child {
    padding-top: 0;
  }
  .summary-thumb {
    width: 48px;
    height: 48px;
    border-radius: 8px;
    background: #f1f5f9;
    overflow: hidden;
    flex-shrink: 0;
  }
  .summary-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  .summary-info {
    flex: 1;
    min-width: 0;
  }
  .summary-title-row {
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    gap: 8px;
  }
  .summary-name {
    font-size: 14px;
    font-weight: 700;
    color: var(--text-primary);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  .summary-qty {
    font-size: 12.5px;
    font-weight: 600;
    color: var(--text-muted);
  }
  .summary-price {
    font-size: 13.5px;
    font-weight: 700;
    color: var(--brand);
    margin-top: 2px;
    font-variant-numeric: tabular-nums;
  }
  .summary-meta {
    font-size: 11.5px;
    color: var(--text-secondary);
    margin-top: 2px;
  }

  /* Kitchen Notes */
  .textarea-notes {
    width: 100%;
    padding: 12px 14px;
    border-radius: var(--radius-md);
    background: #ffffff;
    border: 1px solid var(--border);
    font-family: inherit;
    font-size: 13.5px;
    color: var(--text-primary);
    outline: none;
    resize: none;
    transition: all 0.15s ease;
  }
  .textarea-notes:focus {
    border-color: var(--brand);
    box-shadow: 0 0 0 3px rgba(15, 23, 42, 0.08);
  }
  .textarea-notes::placeholder {
    color: var(--text-muted);
  }

  /* Total Price Card */
  .total-card {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    padding: 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .total-title {
    font-size: 14px;
    font-weight: 600;
    color: var(--text-secondary);
  }
  .total-num {
    font-size: 20px;
    font-weight: 800;
    color: var(--text-primary);
    font-variant-numeric: tabular-nums;
  }

  /* Sticky Bottom Pay Button */
  .co-bottom-wrap {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    display: flex;
    justify-content: center;
    z-index: 40;
    pointer-events: none;
  }
  .co-bottom {
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
  .btn-pay {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 15px;
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
  .btn-pay:hover {
    background: var(--brand-hover);
  }
  .btn-pay:active {
    transform: scale(0.98);
  }
  .btn-pay svg {
    width: 16px;
    height: 16px;
    stroke: currentColor;
    stroke-width: 2.2;
    fill: none;
  }
</style>
</head>
<body>

<div class="co-wrap">

  <!-- Header -->
  <header class="co-header">
    <a href="{{ route('customer.cart.index') }}" class="co-back" aria-label="Kembali ke Keranjang">
      <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"></polyline></svg>
    </a>
    <h1>Checkout & Bayar</h1>
  </header>

  <main class="co-body">

    <!-- Active Table -->
    <div class="table-card">
      <div class="table-card-label">
        <span class="dot"></span>
        <span>Nomor Meja Terhubung</span>
      </div>
      <div class="table-card-val">
        {{ $selectedTableId ? ($tableOptions[$selectedTableId] ?? 'Meja ' . $selectedTableId) : 'Meja Kasir' }}
      </div>
    </div>

    <!-- Main Checkout Form -->
    <form action="{{ route('customer.checkout.store') }}" method="POST" id="checkoutForm">
      @csrf
      <input type="hidden" name="table_id" value="{{ $selectedTableId ?? old('table_id') ?? 1 }}">

      <!-- Payment Method Selection -->
      <section style="margin-bottom: 20px;">
        <span class="section-title">Pilih Metode Pembayaran</span>
        <div class="payment-options">

          <button type="button" class="pay-option active" data-method="qris" onclick="selectPayment(this)">
            <div class="pay-option-left">
              <div class="pay-icon">📱</div>
              <div>
                <div class="pay-name">QRIS</div>
                <div class="pay-sub">GoPay, OVO, Dana, BCA, Livin</div>
              </div>
            </div>
            <div class="pay-radio"></div>
          </button>

          <button type="button" class="pay-option" data-method="cash" onclick="selectPayment(this)">
            <div class="pay-option-left">
              <div class="pay-icon">💵</div>
              <div>
                <div class="pay-name">Tunai di Kasir</div>
                <div class="pay-sub">Bayar langsung ke kasir setelah pesan</div>
              </div>
            </div>
            <div class="pay-radio"></div>
          </button>

          <button type="button" class="pay-option" data-method="transfer" onclick="selectPayment(this)">
            <div class="pay-option-left">
              <div class="pay-icon">🏦</div>
              <div>
                <div class="pay-name">Transfer Bank</div>
                <div class="pay-sub">Virtual account / rekening resmi</div>
              </div>
            </div>
            <div class="pay-radio"></div>
          </button>

        </div>
        <input type="hidden" name="metode_pembayaran" id="metode_pembayaran" value="Qris">
      </section>

      <!-- Order Items Summary -->
      <section style="margin-bottom: 20px;">
        <span class="section-title">Ringkasan Pesanan ({{ count($cart) }} item)</span>
        <div class="order-summary-card">
          @foreach($cart as $item)
            <div class="summary-item">
              <div class="summary-thumb">
                @if(!empty($item['image']))
                  <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}">
                @else
                  <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; font-size:18px;">☕</div>
                @endif
              </div>
              <div class="summary-info">
                <div class="summary-title-row">
                  <div class="summary-name">{{ $item['name'] }}</div>
                  <span class="summary-qty">x{{ $item['qty'] }}</span>
                </div>
                <div class="summary-price">Rp {{ number_format($item['price'], 0, ',', '.') }}</div>
                @php
                  $itemDetails = [];
                  if (!empty($item['variant'])) $itemDetails[] = $item['variant'];
                  if (!empty($item['sugar_level'])) $itemDetails[] = $item['sugar_level'];
                @endphp
                @if(!empty($itemDetails))
                  <div class="summary-meta">{{ implode(' · ', $itemDetails) }}</div>
                @endif
                @if(!empty($item['notes']))
                  <div class="summary-meta" style="color:#b45309; font-style:italic;">"{{ $item['notes'] }}"</div>
                @endif
              </div>
            </div>
          @endforeach
        </div>
      </section>

      <!-- Kitchen Notes -->
      <section style="margin-bottom: 20px;">
        <span class="section-title">Catatan untuk Dapur / Barista (Opsional)</span>
        <textarea name="catatan" class="textarea-notes" rows="2" placeholder="Contoh: Tolong disajikan bersamaan, jangan terlalu manis..."></textarea>
      </section>

      <!-- Total Price Card -->
      <div class="total-card">
        <span class="total-title">Total Pembayaran</span>
        <strong class="total-num">Rp {{ number_format($total, 0, ',', '.') }}</strong>
      </div>

    </form>
  </main>

  <!-- Sticky Bottom Confirmation Bar -->
  <div class="co-bottom-wrap">
    <div class="co-bottom">
      <button type="submit" form="checkoutForm" class="btn-pay">
        <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
        <span>Konfirmasi & Bayar Sekarang</span>
      </button>
    </div>
  </div>

</div>

<script>
  function selectPayment(element) {
    const options = document.querySelectorAll('.pay-option');
    options.forEach(option => option.classList.remove('active'));
    element.classList.add('active');
    const method = element.dataset.method;
    const methodMap = {
      qris: 'Qris',
      cash: 'Tunai',
      transfer: 'Transfer Bank'
    };
    document.getElementById('metode_pembayaran').value = methodMap[method] || 'Qris';
  }
</script>
</body>
</html>