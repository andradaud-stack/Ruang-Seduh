<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>Detail Pesanan - Ruang Seduh</title>
<style>
  :root{
    --accent: #e07a5f;
    --accent-dim: rgba(224, 122, 95, 0.15);
    --dark: #141414;
    --muted: #8a8580;
    --cream: #f6ece3;
  }
  *{ box-sizing:border-box; margin:0; padding:0; }
  body{
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    background: #111;
  }
  .od-wrap{
    max-width:480px;
    margin:0 auto;
    min-height:100dvh;
    background: var(--cream);
    position:relative;
    overflow-x:hidden;
  }

  .od-header{
    display:flex;
    align-items:center;
    gap:16px;
    padding:44px 20px 28px;
  }
  .od-back{
    width:38px;
    height:38px;
    border-radius:50%;
    background:#ece0d2;
    display:flex;
    align-items:center;
    justify-content:center;
    text-decoration:none;
    color:var(--dark);
    flex-shrink:0;
  }
  .od-back svg{ width:16px; height:16px; stroke:currentColor; stroke-width:2.4; fill:none; }
  .od-header h1{
    color:var(--dark);
    font-size:22px;
    font-weight:800;
  }

  .od-body{
    padding:0 20px 60px;
    display:flex;
    flex-direction:column;
    gap:16px;
  }

  /* Status Tracker Styles */
  .od-status-card{
    background:#ffffff;
    border-radius:20px;
    padding:32px 20px;
    box-shadow:0 4px 14px rgba(0,0,0,.04);
    text-align:center;
  }

  .status-stage{
    display:none;
    flex-direction:column;
    align-items:center;
    animation:fadeIn 0.5s ease;
  }
  .status-stage.active{ display:flex; }

  @keyframes fadeIn{
    from{ opacity:0; transform:translateY(8px); }
    to{ opacity:1; transform:translateY(0); }
  }

  .status-spinner{
    width:56px;
    height:56px;
    border-radius:50%;
    border:4px solid rgba(224,122,95,0.25);
    border-top-color:var(--accent);
    animation:spin 0.9s linear infinite;
    margin-bottom:28px;
  }
  @keyframes spin{ to{ transform:rotate(360deg); } }

  .status-check-icon{
    width:56px;
    height:56px;
    border-radius:50%;
    margin-bottom:28px;
    display:flex;
    align-items:center;
    justify-content:center;
    background:var(--accent-dim);
  }
  .status-check-icon svg{ width:28px; height:28px; }

  .status-title{
    font-size:20px;
    font-weight:800;
    color:var(--dark);
    margin:0 0 10px;
  }

  .status-desc{
    font-size:13.5px;
    line-height:1.5;
    color:var(--muted);
    margin:0 0 22px;
    max-width:230px;
  }

  .status-order-id{
    font-size:13px;
    font-weight:600;
    color:var(--accent);
    background:var(--accent-dim);
    padding:6px 16px;
    border-radius:20px;
    margin-bottom:14px;
    letter-spacing:0.5px;
  }

  .status-badge{
    font-size:12.5px;
    font-weight:600;
    color:#a9b89a;
    background:rgba(122,138,108,0.18);
    padding:7px 16px;
    border-radius:20px;
    display:inline-flex;
    align-items:center;
    gap:6px;
  }
  .status-badge::before{
    content:"";
    width:6px;
    height:6px;
    border-radius:50%;
    background:#a9b89a;
    display:inline-block;
  }

  .status-progress-dots{
    display:flex;
    gap:6px;
    justify-content:center;
    margin-top:28px;
  }
  .status-progress-dots span{
    width:6px;
    height:6px;
    border-radius:50%;
    background:rgba(0,0,0,0.1);
    transition:background 0.3s ease, transform 0.3s ease;
  }
  .status-progress-dots span.on{
    background:var(--accent);
    transform:scale(1.3);
  }

  .od-info-card{
    background:#ffffff;
    border-radius:20px;
    padding:20px;
    box-shadow:0 4px 14px rgba(0,0,0,.04);
  }
  .od-info-row{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:6px 0;
  }
  .od-info-label{
    font-size:14px;
    color:var(--muted);
  }
  .od-info-value{
    font-size:14px;
    font-weight:700;
    color:var(--dark);
  }

  .od-item-card{
    background:#ffffff;
    border-radius:16px;
    padding:16px 20px;
  }
  .od-item-name{
    font-size:15px;
    font-weight:800;
    color:var(--dark);
  }
  .od-item-qty{
    font-size:13px;
    font-weight:600;
    color:var(--muted);
  }
  .od-item-price{
    font-size:13px;
    color:var(--muted);
    margin-top:2px;
  }

  .od-total-card{
    background:#ffffff;
    border-radius:16px;
    padding:18px 20px;
    display:flex;
    align-items:center;
    justify-content:space-between;
  }
  .od-total-label{
    font-size:15px;
    color:var(--muted);
    font-weight:600;
  }
  .od-total-value{
    font-size:19px;
    font-weight:800;
    color:var(--dark);
  }

  @media (min-width:700px){
    .od-wrap{ margin-top:24px; margin-bottom:24px; border-radius:28px; overflow:hidden; box-shadow:0 20px 60px rgba(0,0,0,.4); }
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
    'diproses'            => 'Kasir sudah menerima pesananmu dan sedang menyiapkannya. Terima kasih!',
    'siap_disajikan'      => 'Sudah siap, segera diantar ke meja.',
    'selesai'             => 'Sudah selesai disajikan.',
    'dibatalkan'          => 'Pesanan dibatalkan.',
  ];

  $statusTitles = [
    'menunggu_konfirmasi' => 'Sedang Dikonfirmasi',
    'diproses'            => 'Pesanan Diterima!',
    'siap_disajikan'      => 'Siap Disajikan!',
    'selesai'             => 'Pesanan Selesai!',
    'dibatalkan'          => 'Pesanan Dibatalkan',
  ];

  $statusBadges = [
    'menunggu_konfirmasi' => 'Menunggu Konfirmasi',
    'diproses'            => 'Sedang Diproses',
    'siap_disajikan'      => 'Siap disajikan',
    'selesai'             => 'Selesai',
    'dibatalkan'          => 'Dibatalkan',
  ];

  $currentStage = $statusStage[$order->status] ?? -1;
@endphp

<div class="od-wrap">

  <div class="od-header">
    <a href="{{ route('customer.order.history') }}" class="od-back" aria-label="Kembali">
      <svg viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"/></svg>
    </a>
    <h1>Detail Pesanan</h1>
  </div>

  <div class="od-body">

    <!-- Status Tracker Card -->
    <div class="od-status-card" id="statusCard">
      <!-- Stage 0: Sedang Dikonfirmasi -->
      <div class="status-stage active" data-stage="0">
        <div class="status-spinner"></div>
        <h2 class="status-title">{{ $statusTitles['menunggu_konfirmasi'] }}</h2>
        <p class="status-desc">{{ $statusDescriptions['menunggu_konfirmasi'] }}</p>
        <div class="status-order-id">#{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</div>
        <span class="status-badge">{{ $statusBadges['menunggu_konfirmasi'] }}</span>
      </div>

      <!-- Stage 1: Pesanan Diterima -->
      <div class="status-stage" data-stage="1">
        <div class="status-check-icon">
          <svg viewBox="0 0 24 24" fill="currentColor" style="color:var(--accent);">
            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
          </svg>
        </div>
        <h2 class="status-title">{{ $statusTitles['diproses'] }}</h2>
        <p class="status-desc">{{ $statusDescriptions['diproses'] }}</p>
        <div class="status-order-id">#{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</div>
        <span class="status-badge">{{ $statusBadges['diproses'] }}</span>
      </div>

      <!-- Stage 2: Siap Disajikan -->
      <div class="status-stage" data-stage="2">
        <div class="status-check-icon">
          <svg viewBox="0 0 24 24" fill="currentColor" style="color:var(--accent);">
            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
          </svg>
        </div>
        <h2 class="status-title">{{ $statusTitles['siap_disajikan'] }}</h2>
        <p class="status-desc">{{ $statusDescriptions['siap_disajikan'] }}</p>
        <div class="status-order-id">#{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</div>
        <span class="status-badge">{{ $statusBadges['siap_disajikan'] }}</span>
      </div>

      <!-- Stage 3: Pesanan Selesai -->
      <div class="status-stage" data-stage="3">
        <div class="status-check-icon">
          <svg viewBox="0 0 24 24" fill="currentColor" style="color:var(--accent);">
            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
          </svg>
        </div>
        <h2 class="status-title">{{ $statusTitles['selesai'] }}</h2>
        <p class="status-desc">{{ $statusDescriptions['selesai'] }}</p>
        <div class="status-order-id">#{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</div>
        <span class="status-badge">{{ $statusBadges['selesai'] }}</span>
      </div>

      <div class="status-progress-dots">
        <span data-dot="0" class="on"></span>
        <span data-dot="1"></span>
        <span data-dot="2"></span>
        <span data-dot="3"></span>
      </div>
    </div>

    <!-- Order Information -->
    <div class="od-info-card">
      <div class="od-info-row">
        <span class="od-info-label">Nomor Pesanan</span>
        <span class="od-info-value">#{{ $order->id }}</span>
      </div>
      <div class="od-info-row">
        <span class="od-info-label">Meja</span>
        <span class="od-info-value">{{ $order->tabel->table_number ?? '-' }}</span>
      </div>
      <div class="od-info-row">
        <span class="od-info-label">Tanggal</span>
        <span class="od-info-value">{{ $order->created_at->format('d M Y, H:i') }}</span>
      </div>
    </div>

    <!-- Order Items -->
    @foreach($order->orderItems as $item)
      <div class="od-item-card">
        <div style="display:flex; justify-content:space-between; align-items:flex-start;">
          <div>
            <div class="od-item-name">{{ $item->menu_name }} <span class="od-item-qty">x{{ $item->qty }}</span></div>
            @if(!empty($item->notes))
              <div style="font-size:12px; color:#b45309; margin-top:4px;">{{ $item->notes }}</div>
            @endif
          </div>
          <div class="od-item-price" style="font-weight:700; color:var(--dark);">Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}</div>
        </div>
      </div>
    @endforeach

    @if(!empty($order->catatan))
      <div class="od-info-card" style="background:#fff8f0; border:1px dashed #e8c8a8;">
        <div class="od-info-label" style="color:#8a532d; font-weight:700; margin-bottom:4px;">Catatan Pesanan:</div>
        <div style="font-size:13.5px; color:#5c3a21;">"{{ $order->catatan }}"</div>
      </div>
    @endif

    <!-- Total -->
    <div class="od-total-card">
      <span class="od-total-label">Total</span>
      <span class="od-total-value">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
    </div>

  </div>

</div>

<script>
  (function(){
    const currentStage = {{ $currentStage }};
    const stages = document.querySelectorAll('.status-stage');
    const dots = document.querySelectorAll('[data-dot]');

    function render(){
      stages.forEach(s => {
        s.classList.toggle('active', Number(s.dataset.stage) === currentStage);
      });
      dots.forEach(d => {
        d.classList.toggle('on', Number(d.dataset.dot) <= currentStage);
      });
    }

    // Auto-refresh status every 5 seconds
    setInterval(function(){
      fetch('{{ route("customer.order.status", $order->id) }}')
        .then(r => r.json())
        .then(data => {
          if(data.stage !== currentStage){
            location.reload();
          }
        })
        .catch(e => console.error(e));
    }, 5000);

    render();
  })();
</script>
</body>
</html>