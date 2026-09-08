<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>Detail Pesanan #{{ $order->id }} - Ruang Seduh</title>
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
    --amber: #f59e0b;
    --amber-light: #fef3c7;
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

  .od-wrap {
    width: 100%;
    max-width: 480px;
    margin: 0 auto;
    min-height: 100vh;
    background: var(--bg-page);
    position: relative;
    padding-bottom: 60px;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
  }

  /* Header */
  .od-header {
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
  .od-back {
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
  .od-back:hover {
    background: #ffffff;
    border-color: var(--border-hover);
  }
  .od-back svg {
    width: 18px;
    height: 18px;
    stroke: currentColor;
    stroke-width: 2.2;
    fill: none;
  }
  .od-header h1 {
    font-size: 18px;
    font-weight: 800;
    letter-spacing: -0.02em;
    color: var(--text-primary);
  }

  .od-body {
    padding: 18px 20px;
    display: flex;
    flex-direction: column;
    gap: 16px;
  }

  /* Live Tracker Card */
  .tracker-card {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 22px 20px;
    text-align: center;
  }
  .live-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    padding: 4px 10px;
    border-radius: 999px;
    background: #f1f5f9;
    color: #475569;
    margin-bottom: 16px;
  }
  .live-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: var(--success);
    animation: pulseDot 2s infinite;
  }
  @keyframes pulseDot {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.4; transform: scale(0.85); }
  }

  .tracker-icon-wrap {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    margin: 0 auto 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    background: #f8fafc;
    border: 1px solid var(--border);
  }

  .tracker-title {
    font-size: 18px;
    font-weight: 800;
    letter-spacing: -0.01em;
    color: var(--text-primary);
    margin-bottom: 6px;
  }
  .tracker-desc {
    font-size: 13px;
    color: var(--text-secondary);
    line-height: 1.5;
    max-width: 300px;
    margin: 0 auto 20px;
  }

  /* Linear Timeline Stepper */
  .timeline-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: relative;
    padding: 0 10px;
    margin-top: 10px;
  }
  .timeline-line {
    position: absolute;
    top: 14px;
    left: 24px;
    right: 24px;
    height: 2px;
    background: #e2e8f0;
    z-index: 1;
  }
  .timeline-line-progress {
    position: absolute;
    top: 14px;
    left: 24px;
    height: 2px;
    background: var(--brand);
    z-index: 2;
    transition: width 0.4s ease;
  }
  .timeline-step {
    position: relative;
    z-index: 3;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 6px;
  }
  .step-circle {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: #ffffff;
    border: 2px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
    font-weight: 700;
    color: var(--text-muted);
    transition: all 0.2s ease;
  }
  .timeline-step.completed .step-circle {
    background: var(--brand);
    border-color: var(--brand);
    color: #ffffff;
  }
  .timeline-step.active .step-circle {
    background: #ffffff;
    border-color: var(--brand);
    color: var(--brand);
    box-shadow: 0 0 0 3px rgba(15, 23, 42, 0.12);
  }
  .step-label {
    font-size: 11px;
    font-weight: 600;
    color: var(--text-muted);
  }
  .timeline-step.completed .step-label,
  .timeline-step.active .step-label {
    color: var(--text-primary);
    font-weight: 700;
  }

  /* Receipt Card */
  .receipt-card {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 18px 20px;
  }
  .receipt-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding-bottom: 14px;
    border-bottom: 1px solid #f1f5f9;
    margin-bottom: 14px;
  }
  .receipt-order-id {
    font-size: 15px;
    font-weight: 800;
    color: var(--text-primary);
  }
  .receipt-date {
    font-size: 12px;
    color: var(--text-muted);
    margin-top: 2px;
  }
  .status-badge {
    font-size: 11px;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 999px;
  }
  .badge-waiting { background: #fef3c7; color: #b45309; }
  .badge-processing { background: #e0f2fe; color: #0369a1; }
  .badge-ready { background: #ecfdf5; color: #047857; }
  .badge-completed { background: #f1f5f9; color: #334155; }
  .badge-cancelled { background: #fee2e2; color: #b91c1c; }

  .meta-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
    padding-bottom: 14px;
    border-bottom: 1px solid #f1f5f9;
    margin-bottom: 14px;
  }
  .meta-box {
    background: #f8fafc;
    border-radius: 8px;
    padding: 10px 12px;
  }
  .meta-box-label {
    font-size: 11px;
    color: var(--text-muted);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.04em;
  }
  .meta-box-val {
    font-size: 13.5px;
    font-weight: 700;
    color: var(--text-primary);
    margin-top: 2px;
  }

  /* Items Section */
  .items-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
    padding-bottom: 16px;
    border-bottom: 1px solid #f1f5f9;
    margin-bottom: 14px;
  }
  .receipt-item-row {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 12px;
  }
  .item-main-info {
    flex: 1;
  }
  .item-title {
    font-size: 13.5px;
    font-weight: 700;
    color: var(--text-primary);
  }
  .item-note-text {
    font-size: 11.5px;
    color: #b45309;
    margin-top: 2px;
    font-style: italic;
  }
  .item-price-col {
    text-align: right;
    font-size: 13.5px;
    font-weight: 700;
    color: var(--brand);
    font-variant-numeric: tabular-nums;
  }

  /* Catatan Kasir / Dapur */
  .order-note-box {
    background: #fffbeb;
    border: 1px dashed #fcd34d;
    border-radius: var(--radius-md);
    padding: 12px 14px;
    margin-bottom: 16px;
  }
  .order-note-title {
    font-size: 11.5px;
    font-weight: 700;
    color: #92400e;
    margin-bottom: 2px;
  }
  .order-note-content {
    font-size: 12.5px;
    color: #78350f;
  }

  /* Total Breakdown */
  .total-breakdown-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .breakdown-label {
    font-size: 14px;
    font-weight: 600;
    color: var(--text-secondary);
  }
  .breakdown-num {
    font-size: 19px;
    font-weight: 800;
    color: var(--text-primary);
    font-variant-numeric: tabular-nums;
  }
</style>
</head>
<body>

@php
  $statusStage = [
    'menunggu_konfirmasi' => 0,
    'diproses'            => 1,
    'siap_disajikan'      => 2,
    'selesai'             => 3,
    'dibatalkan'          => -1,
  ];

  $statusDescriptions = [
    'menunggu_konfirmasi' => 'Pesananmu sedang diverifikasi oleh kasir. Mohon tunggu sebentar ya.',
    'diproses'            => 'Kasir sudah menerima pesananmu dan sedang disiapkan oleh barista. Terima kasih!',
    'siap_disajikan'      => 'Pesananmu telah siap dan segera diantar ke mejamu.',
    'selesai'             => 'Pesanan telah selesai disajikan. Selamat menikmati!',
    'dibatalkan'          => 'Pesanan ini dibatalkan.',
  ];

  $statusTitles = [
    'menunggu_konfirmasi' => 'Menunggu Konfirmasi',
    'diproses'            => 'Pesanan Diproses',
    'siap_disajikan'      => 'Siap Disajikan',
    'selesai'             => 'Pesanan Selesai',
    'dibatalkan'          => 'Pesanan Dibatalkan',
  ];

  $statusBadgeClasses = [
    'menunggu_konfirmasi' => 'badge-waiting',
    'diproses'            => 'badge-processing',
    'siap_disajikan'      => 'badge-ready',
    'selesai'             => 'badge-completed',
    'dibatalkan'          => 'badge-cancelled',
  ];

  $statusIcons = [
    'menunggu_konfirmasi' => '⏳',
    'diproses'            => '☕',
    'siap_disajikan'      => '🛎️',
    'selesai'             => '✨',
    'dibatalkan'          => '❌',
  ];

  $currentStage = $statusStage[$order->status] ?? -1;
  $progressPct = max(0, min(100, $currentStage * 33.33));
@endphp

<div class="od-wrap">

  <!-- Header -->
  <header class="od-header">
    <a href="{{ route('customer.order.history') }}" class="od-back" aria-label="Kembali ke Riwayat">
      <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"></polyline></svg>
    </a>
    <h1>Detail Pesanan #{{ $order->id }}</h1>
  </header>

  <main class="od-body">

    <!-- Live Status Tracker Card -->
    <div class="tracker-card">
      <div class="live-pill">
        <span class="live-dot"></span>
        <span>Live Status Tracker</span>
      </div>

      <div class="tracker-icon-wrap">
        {{ $statusIcons[$order->status] ?? '☕' }}
      </div>

      <h2 class="tracker-title">{{ $statusTitles[$order->status] ?? 'Memproses' }}</h2>
      <p class="tracker-desc">{{ $statusDescriptions[$order->status] ?? '' }}</p>

      @if($currentStage >= 0)
        <!-- Horizontal Timeline Stepper -->
        <div class="timeline-bar">
          <div class="timeline-line"></div>
          <div class="timeline-line-progress" style="width: {{ $progressPct }}%;"></div>

          <div class="timeline-step {{ $currentStage > 0 ? 'completed' : ($currentStage === 0 ? 'active' : '') }}">
            <div class="step-circle">1</div>
            <span class="step-label">Diterima</span>
          </div>

          <div class="timeline-step {{ $currentStage > 1 ? 'completed' : ($currentStage === 1 ? 'active' : '') }}">
            <div class="step-circle">2</div>
            <span class="step-label">Diproses</span>
          </div>

          <div class="timeline-step {{ $currentStage > 2 ? 'completed' : ($currentStage === 2 ? 'active' : '') }}">
            <div class="step-circle">3</div>
            <span class="step-label">Siap</span>
          </div>

          <div class="timeline-step {{ $currentStage >= 3 ? 'completed' : '' }}">
            <div class="step-circle">4</div>
            <span class="step-label">Selesai</span>
          </div>
        </div>
      @endif
    </div>

    <!-- Digital Receipt Card -->
    <div class="receipt-card">

      <div class="receipt-header">
        <div>
          <div class="receipt-order-id">Pesanan #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</div>
          <div class="receipt-date">{{ $order->created_at->format('d M Y, H:i') }} WIB</div>
        </div>
        <span class="status-badge {{ $statusBadgeClasses[$order->status] ?? 'badge-waiting' }}">
          {{ $statusTitles[$order->status] ?? $order->status }}
        </span>
      </div>

      <div class="meta-grid">
        <div class="meta-box">
          <div class="meta-box-label">Nomor Meja</div>
          <div class="meta-box-val">{{ $order->tabel->table_number ?? '-' }}</div>
        </div>
        <div class="meta-box">
          <div class="meta-box-label">Metode Bayar</div>
          <div class="meta-box-val">{{ $order->metode_pembayaran ?? 'QRIS' }}</div>
        </div>
      </div>

      <!-- Items List -->
      <div class="items-list">
        @foreach($order->orderItems as $item)
          <div class="receipt-item-row">
            <div class="item-main-info">
              <div class="item-title">{{ $item->menu_name }} <span style="color:var(--text-muted); font-weight:600;">&times; {{ $item->qty }}</span></div>
              @if(!empty($item->notes))
                <div class="item-note-text">"{{ $item->notes }}"</div>
              @endif
            </div>
            <div class="item-price-col">
              Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}
            </div>
          </div>
        @endforeach
      </div>

      @if(!empty($order->catatan))
        <div class="order-note-box">
          <div class="order-note-title">Catatan Pesanan:</div>
          <div class="order-note-content">"{{ $order->catatan }}"</div>
        </div>
      @endif

      <!-- Total Price -->
      <div class="total-breakdown-row">
        <span class="breakdown-label">Total Pembayaran</span>
        <strong class="breakdown-num">Rp {{ number_format($order->total, 0, ',', '.') }}</strong>
      </div>

    </div>

  </main>

</div>

<script>
  window.RS_CURRENT_ORDER_ID = {{ $order->id }};
</script>
@include('customer.include.order_notifications')
</body>
</html>