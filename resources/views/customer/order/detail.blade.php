<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <title>Detail Pesanan #{{ $order->id }} — Ruang Seduh</title>
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

    .od-wrap {
      width: min(100%, 720px);
      margin: 0 auto;
      min-height: 100vh;
      background: var(--cream);
      position: relative;
      padding-bottom: 70px;
      box-shadow: 0 0 50px rgba(36, 23, 15, 0.08);
    }

    /* Header */
    .od-header {
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

    .od-back {
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
    .od-back:hover {
      background: #fffdfa;
      transform: scale(1.05);
    }
    .od-back svg {
      width: 20px;
      height: 20px;
      stroke: currentColor;
      stroke-width: 2.3;
      fill: none;
    }

    .od-header h1 {
      font-family: "Playfair Display", serif;
      font-size: 22px;
      font-weight: 700;
      color: var(--ink);
    }

    .od-body {
      padding: 24px 28px;
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    /* Live Tracker Card */
    .tracker-card {
      background: var(--paper);
      border: 1px solid var(--line);
      border-radius: 24px;
      padding: 26px 22px 28px;
      text-align: center;
      box-shadow: 0 8px 25px rgba(36, 23, 15, 0.05);
    }

    .live-pill {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.06em;
      padding: 5px 12px;
      border-radius: 999px;
      background: #f1e9df;
      color: var(--brown-2);
      margin-bottom: 18px;
    }

    .live-dot {
      width: 7px;
      height: 7px;
      border-radius: 50%;
      background: var(--green);
      animation: pulseDot 2s infinite;
    }
    @keyframes pulseDot {
      0%, 100% { opacity: 1; transform: scale(1); }
      50% { opacity: 0.4; transform: scale(0.85); }
    }

    .tracker-icon-wrap {
      width: 68px;
      height: 68px;
      border-radius: 50%;
      margin: 0 auto 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 32px;
      background: #f3eae0;
      box-shadow: 0 8px 20px rgba(90, 53, 31, 0.12);
      border: 1px solid var(--line);
    }

    .tracker-title {
      font-family: "Playfair Display", serif;
      font-size: 22px;
      font-weight: 700;
      color: var(--ink);
      margin-bottom: 6px;
    }

    .tracker-desc {
      font-size: 13.5px;
      color: var(--muted);
      line-height: 1.55;
      max-width: 360px;
      margin: 0 auto 24px;
    }

    /* Stepper */
    .timeline-bar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: relative;
      padding: 0 14px;
      margin-top: 10px;
    }
    .timeline-line {
      position: absolute;
      top: 15px;
      left: 30px;
      right: 30px;
      height: 3px;
      background: #eee4d8;
      z-index: 1;
    }
    .timeline-line-progress {
      position: absolute;
      top: 15px;
      left: 30px;
      height: 3px;
      background: var(--brown);
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
      width: 30px;
      height: 30px;
      border-radius: 50%;
      background: #ffffff;
      border: 2px solid var(--line);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 11.5px;
      font-weight: 800;
      color: var(--muted);
      transition: all 0.2s ease;
    }
    .timeline-step.completed .step-circle {
      background: var(--brown);
      border-color: var(--brown);
      color: #ffffff;
    }
    .timeline-step.active .step-circle {
      background: #ffffff;
      border-color: var(--brown);
      color: var(--brown);
      box-shadow: 0 0 0 3px rgba(90, 53, 31, 0.18);
    }
    .step-label {
      font-size: 11.5px;
      font-weight: 600;
      color: var(--muted);
    }
    .timeline-step.completed .step-label,
    .timeline-step.active .step-label {
      color: var(--ink);
      font-weight: 700;
    }

    /* Receipt Card */
    .receipt-card {
      background: var(--paper);
      border: 1px solid var(--line);
      border-radius: 24px;
      padding: 22px 24px;
      box-shadow: 0 6px 20px rgba(36, 23, 15, 0.04);
    }

    .receipt-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      padding-bottom: 16px;
      border-bottom: 1px solid var(--line);
      margin-bottom: 16px;
    }
    .receipt-order-id {
      font-family: "Playfair Display", serif;
      font-size: 17px;
      font-weight: 800;
      color: var(--ink);
    }
    .receipt-date {
      font-size: 12px;
      color: var(--muted);
      margin-top: 2px;
    }

    .status-badge {
      font-size: 11.5px;
      font-weight: 700;
      padding: 5px 12px;
      border-radius: 999px;
    }
    .badge-waiting { background: #fef3c7; color: #92400e; }
    .badge-processing { background: #e0f2fe; color: #0369a1; }
    .badge-ready { background: var(--green-bg); color: var(--green); }
    .badge-completed { background: #f1e9df; color: var(--brown); }
    .badge-cancelled { background: #fee2e2; color: #b91c1c; }

    .meta-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
      padding-bottom: 16px;
      border-bottom: 1px solid var(--line);
      margin-bottom: 16px;
    }
    .meta-box {
      background: #f7f1e9;
      border-radius: 14px;
      padding: 12px 14px;
    }
    .meta-box-label {
      font-size: 10.5px;
      color: var(--muted);
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }
    .meta-box-val {
      font-size: 14px;
      font-weight: 700;
      color: var(--ink);
      margin-top: 2px;
    }

    /* Items List */
    .items-list {
      display: flex;
      flex-direction: column;
      gap: 12px;
      padding-bottom: 18px;
      border-bottom: 1px solid var(--line);
      margin-bottom: 16px;
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
      font-size: 14px;
      font-weight: 700;
      color: var(--ink);
    }
    .item-note-text {
      font-size: 12px;
      color: var(--brown-2);
      margin-top: 2px;
      font-style: italic;
    }
    .item-price-col {
      text-align: right;
      font-size: 14px;
      font-weight: 800;
      color: var(--brown);
      font-variant-numeric: tabular-nums;
    }

    /* Order Notes */
    .order-note-box {
      background: #fdf8f2;
      border: 1px dashed #deb887;
      border-radius: 14px;
      padding: 12px 16px;
      margin-bottom: 18px;
    }
    .order-note-title {
      font-size: 11.5px;
      font-weight: 700;
      color: var(--brown-2);
      margin-bottom: 2px;
    }
    .order-note-content {
      font-size: 13px;
      color: var(--ink);
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
      color: var(--muted);
    }
    .breakdown-num {
      font-family: "Playfair Display", serif;
      font-size: 22px;
      font-weight: 800;
      color: var(--ink);
      font-variant-numeric: tabular-nums;
    }

    @media (max-width: 480px) {
      .od-header { padding: 18px 20px 14px; }
      .od-body { padding: 18px 20px; gap: 16px; }
      .tracker-card { padding: 20px 16px; }
      .receipt-card { padding: 18px 16px; }
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
    'menunggu_konfirmasi' => 'Pesananmu sedang diverifikasi oleh staf kasir. Mohon tunggu sebentar ya.',
    'diproses'            => 'Kasir sudah menerima pesananmu dan sedang diracik oleh barista kami.',
    'siap_disajikan'      => 'Pesananmu telah siap disajikan dan segera diantar ke mejamu!',
    'selesai'             => 'Pesanan telah selesai disajikan. Selamat menikmati sajian Ruang Seduh!',
    'dibatalkan'          => 'Pesanan ini telah dibatalkan.',
  ];

  $statusTitles = [
    'menunggu_konfirmasi' => 'Menunggu Konfirmasi',
    'diproses'            => 'Pesanan Sedang Diproses',
    'siap_disajikan'      => 'Pesanan Siap Disajikan',
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
        <span>Live Order Tracker</span>
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
            <span class="step-label">Siap Saji</span>
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
              <div class="item-title">{{ $item->menu_name }} <span style="color:var(--muted); font-weight:600;">&times; {{ $item->qty }}</span></div>
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