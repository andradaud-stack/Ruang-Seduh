<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <title>Checkout — Ruang Seduh</title>
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

    button, input, textarea { font: inherit; }
    button { border: 0; cursor: pointer; }
    a { color: inherit; text-decoration: none; }

    .co-wrap {
      width: min(100%, 720px);
      margin: 0 auto;
      min-height: 100vh;
      background: var(--cream);
      position: relative;
      padding-bottom: 130px;
      box-shadow: 0 0 50px rgba(36, 23, 15, 0.08);
    }

    /* Header */
    .co-header {
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

    .co-back {
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
    .co-back:hover {
      background: #fffdfa;
      transform: scale(1.05);
    }
    .co-back svg {
      width: 20px;
      height: 20px;
      stroke: currentColor;
      stroke-width: 2.3;
      fill: none;
    }

    .co-header h1 {
      font-family: "Playfair Display", serif;
      font-size: 22px;
      font-weight: 700;
      color: var(--ink);
    }

    .co-body {
      padding: 22px 28px;
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    /* Table Badge Card */
    .table-card {
      background: var(--paper);
      border: 1px solid var(--line);
      border-radius: 18px;
      padding: 16px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 4px 14px rgba(36, 23, 15, 0.04);
    }
    .table-card-label {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 13.5px;
      font-weight: 600;
      color: #655950;
    }
    .table-card-label span.dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: var(--green);
      box-shadow: 0 0 0 3px rgba(57, 119, 91, 0.2);
      animation: pulseGreen 2s infinite;
    }
    @keyframes pulseGreen {
      0%, 100% { opacity: 1; transform: scale(1); }
      50% { opacity: 0.4; transform: scale(0.85); }
    }
    .table-card-val {
      font-family: "Playfair Display", serif;
      font-size: 16px;
      font-weight: 800;
      color: var(--brown);
    }

    /* Section Title */
    .section-title {
      font-size: 12px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      color: var(--brown-2);
      margin-bottom: 10px;
      display: block;
    }

    /* Payment Options */
    .payment-options {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }
    .pay-option {
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 15px 18px;
      background: var(--paper);
      border: 1.5px solid var(--line);
      border-radius: 18px;
      cursor: pointer;
      transition: all 0.2s ease;
      text-align: left;
    }
    .pay-option:hover {
      border-color: var(--brown);
    }
    .pay-option.active {
      border-color: var(--brown);
      background: #fbf5ee;
      box-shadow: 0 4px 14px rgba(90, 53, 31, 0.12);
    }
    .pay-option-left {
      display: flex;
      align-items: center;
      gap: 14px;
    }
    .pay-icon {
      width: 40px;
      height: 40px;
      border-radius: 12px;
      background: #f3eae0;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
    }
    .pay-name {
      font-size: 15px;
      font-weight: 700;
      color: var(--ink);
    }
    .pay-sub {
      font-size: 12px;
      color: var(--muted);
      margin-top: 1px;
    }
    .pay-radio {
      width: 22px;
      height: 22px;
      border-radius: 50%;
      border: 2px solid var(--line);
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s ease;
    }
    .pay-option.active .pay-radio {
      border-color: var(--brown);
    }
    .pay-option.active .pay-radio::after {
      content: "";
      width: 11px;
      height: 11px;
      border-radius: 50%;
      background: var(--brown);
    }

    /* Order Summary */
    .order-summary-card {
      background: var(--paper);
      border: 1px solid var(--line);
      border-radius: 20px;
      padding: 18px 20px;
      box-shadow: 0 4px 16px rgba(36, 23, 15, 0.04);
    }
    .summary-item {
      display: flex;
      gap: 14px;
      align-items: center;
      padding: 12px 0;
      border-bottom: 1px solid var(--line);
    }
    .summary-item:last-child {
      border-bottom: none;
      padding-bottom: 0;
    }
    .summary-item:first-child {
      padding-top: 0;
    }
    .summary-thumb {
      width: 52px;
      height: 52px;
      border-radius: 12px;
      background: #eddccb;
      overflow: hidden;
      flex-shrink: 0;
      display: flex;
      align-items: center;
      justify-content: center;
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
      font-size: 14.5px;
      font-weight: 700;
      color: var(--ink);
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .summary-qty {
      font-size: 13px;
      font-weight: 700;
      color: var(--muted);
    }
    .summary-price {
      font-size: 14px;
      font-weight: 800;
      color: var(--brown);
      margin-top: 2px;
      font-variant-numeric: tabular-nums;
    }
    .summary-meta {
      font-size: 12px;
      color: var(--muted);
      margin-top: 2px;
    }

    /* Notes Textarea */
    .textarea-notes {
      width: 100%;
      padding: 14px 16px;
      border-radius: 18px;
      background: var(--paper);
      border: 1px solid var(--line);
      font-family: inherit;
      font-size: 13.5px;
      color: var(--ink);
      outline: none;
      resize: none;
      transition: all 0.2s ease;
      box-shadow: 0 4px 14px rgba(36, 23, 15, 0.04);
    }
    .textarea-notes:focus {
      border-color: var(--brown);
      box-shadow: 0 0 0 3px rgba(90, 53, 31, 0.1);
    }
    .textarea-notes::placeholder {
      color: #a89f97;
    }

    /* Total Card */
    .total-card {
      background: var(--paper);
      border: 1px solid var(--line);
      border-radius: 18px;
      padding: 18px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 4px 14px rgba(36, 23, 15, 0.04);
    }
    .total-title {
      font-size: 14px;
      font-weight: 600;
      color: #655950;
    }
    .total-num {
      font-family: "Playfair Display", serif;
      font-size: 22px;
      font-weight: 800;
      color: var(--ink);
      font-variant-numeric: tabular-nums;
    }

    /* Sticky Bottom */
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
      width: min(100%, 720px);
      pointer-events: auto;
      background: rgba(255, 253, 249, 0.95);
      backdrop-filter: blur(18px);
      -webkit-backdrop-filter: blur(18px);
      border-top: 1px solid var(--line);
      padding: 16px 28px calc(16px + env(safe-area-inset-bottom));
      box-shadow: 0 -12px 35px rgba(36, 23, 15, 0.08);
    }
    .btn-pay {
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
    .btn-pay:hover {
      background: var(--brown-2);
      transform: translateY(-2px);
    }
    .btn-pay:active {
      transform: scale(0.98);
    }
    .btn-pay svg {
      width: 18px;
      height: 18px;
      stroke: currentColor;
      stroke-width: 2.2;
      fill: none;
    }

    @media (max-width: 480px) {
      .co-header { padding: 18px 20px 14px; }
      .co-body { padding: 18px 20px; gap: 16px; }
      .co-bottom { padding: 14px 20px calc(14px + env(safe-area-inset-bottom)); }
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
    <h1>Checkout & Pembayaran</h1>
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
                <div class="pay-name">QRIS Instant</div>
                <div class="pay-sub">GoPay, OVO, Dana, BCA, Livin, ShopeePay</div>
              </div>
            </div>
            <div class="pay-radio"></div>
          </button>

          <button type="button" class="pay-option" data-method="cash" onclick="selectPayment(this)">
            <div class="pay-option-left">
              <div class="pay-icon">💵</div>
              <div>
                <div class="pay-name">Tunai di Kasir</div>
                <div class="pay-sub">Bayar langsung ke kasir setelah membuat pesanan</div>
              </div>
            </div>
            <div class="pay-radio"></div>
          </button>

          <button type="button" class="pay-option" data-method="transfer" onclick="selectPayment(this)">
            <div class="pay-option-left">
              <div class="pay-icon">🏦</div>
              <div>
                <div class="pay-name">Transfer Bank</div>
                <div class="pay-sub">Virtual account / rekening resmi Ruang Seduh</div>
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
                  <div style="font-size:20px;">☕</div>
                @endif
              </div>
              <div class="summary-info">
                <div class="summary-title-row">
                  <div class="summary-name">{{ $item['name'] }}</div>
                  <span class="summary-qty">&times;{{ $item['qty'] }}</span>
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
                  <div class="summary-meta" style="color:var(--brown-2); font-style:italic;">"{{ $item['notes'] }}"</div>
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
        <span>Konfirmasi & Buat Pesanan</span>
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

@include('customer.include.order_notifications')
</body>
</html>