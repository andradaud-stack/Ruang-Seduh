<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>Ruang Seduh</title>
<link rel="icon" href="{{ asset('assets/images/LOGO_RUANG_SEDUH(putih).png') }}" type="image/png">
<style>
  :root{
    --bg: #f7f3ee;
    --card-bg: #ffffff;
    --dark: #141414;
    --maroon: #5a1f1f;
    --price: #d1352e;
    --muted: #8a8580;
    --accent: #e07a5f;
  }
  *{box-sizing:border-box; margin:0; padding:0;}
  html, body{
    height:100%;
  }
  body{
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    background:var(--bg);
  }

  .phone{
    width:100%;
    max-width:480px;
    margin:0 auto;
    background:var(--bg);
    position:relative;
    min-height:100dvh;
  }

  .content{
    padding:24px 20px 120px;
  }

  /* Header */
  .header{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    margin-bottom:20px;
  }
  .greet-sub{
    font-size:13px;
    color:var(--muted);
    margin-bottom:2px;
  }
  .greet-name{
    font-size:19px;
    font-weight:700;
    color:var(--dark);
  }
  .logo{
    width: 75px;
    height: auto; 
    object-fit: contain; 
  }

  /* Search */
  .search-bar{
    display:flex;
    align-items:center;
    gap:10px;
    background:#fff;
    border:1px solid #eee2d8;
    border-radius:14px;
    padding:12px 16px;
    margin-bottom:16px;
  }
  .search-bar svg{
    width:18px; height:18px;
    stroke:var(--muted);
    fill:none;
    stroke-width:2;
    flex-shrink:0;
  }
  .search-bar input{
    border:none;
    outline:none;
    background:none;
    font-size:14px;
    width:100%;
    color:var(--dark);
  }
  .search-bar input::placeholder{ color:#b5afa7; }

  /* Category pills */
  .categories{
    display:flex;
    gap:8px;
    overflow-x:auto;
    margin-bottom:22px;
    scrollbar-width:none;
  }
  .categories::-webkit-scrollbar{display:none;}
  .chip{
    flex-shrink:0;
    padding:9px 18px;
    border-radius:999px;
    font-size:13px;
    font-weight:600;
    background:#fff;
    color:var(--maroon);
    border:1px solid #eee2d8;
    cursor:pointer;
    white-space:nowrap;
    transition: all .15s ease;
  }
  .chip.active{
    background:var(--maroon);
    color:#fff;
    border-color:var(--maroon);
  }

  .section-title{
    font-size:17px;
    font-weight:700;
    color:var(--dark);
    margin-bottom:14px;
  }

  /* Menu grid */
  .grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:14px;
  }
  .card{
    display:block;
    background:var(--card-bg);
    border-radius:16px;
    overflow:hidden;
    box-shadow: 0 4px 14px rgba(0,0,0,.05);
    cursor:pointer;
    text-decoration:none;
    color:inherit;
    transition: transform .15s ease;
  }
  .card:hover{ transform: translateY(-3px); }

  .thumb{
    height:110px;
    width:100%;
    position:relative;
    display:flex;
    align-items:center;
    justify-content:center;
    overflow:hidden;
  }
  .thumb svg{ width:100%; height:100%; }

  .card-body{
    padding:10px 12px 14px;
  }
  .card-tag{
    font-size:10px;
    letter-spacing:.03em;
    text-transform:uppercase;
    color:var(--muted);
    margin-bottom:4px;
  }
  .card-name{
    font-size:14px;
    font-weight:700;
    color:var(--dark);
    margin-bottom:4px;
  }
  .card-price{
    font-size:13px;
    font-weight:700;
    color:var(--price);
  }
  .card-stock{
    margin-top:6px;
    font-size:11px;
    font-weight:600;
    color:var(--muted);
  }

  /* Bottom Navbar (floating, fixed to real screen) */
  .navbar-wrap{
    position:fixed;
    left:0;
    right:0;
    bottom:0;
    display:flex;
    justify-content:center;
    padding:0 20px 20px;
    pointer-events:none;
  }
  .navbar{
    width:100%;
    max-width:440px;
    pointer-events:auto;
    display:flex;
    align-items:center;
    justify-content:space-around;
    background:#ffffff;
    border-radius:999px;
    padding:14px 16px;
    box-shadow: 0 10px 30px rgba(0,0,0,.25);
  }
  .nav-item{
    background:none;
    border:none;
    padding:9px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
    transition: background .2s ease, transform .15s ease;
  }
  .nav-item img{
    width:22px;
    height:22px;
    object-fit:contain;
  }
  .nav-item:hover{ transform: translateY(-2px); }
  .nav-item.active{
    background: var(--accent);
    box-shadow: 0 0 0 4px #ffffff, 0 4px 10px rgba(224,122,95,0.5);
  }

  @media (max-width: 340px){
    .content{ padding:20px 14px 120px; }
    .greet-name{ font-size:17px; }
    .logo{ font-size:19px; }
    .grid{ gap:10px; }
    .card-name{ font-size:13px; }
    .nav-item{ padding:7px; }
    .nav-item img{ width:25px; height:25px; }
  }

  @media (min-width: 700px){
    .phone{ max-width:420px; margin-top:24px; margin-bottom:24px; border-radius:28px; box-shadow:0 20px 60px rgba(0,0,0,.25); overflow:hidden; }
    body{ background:#1b1b1b; }
  }

  /* Floating Call Waiter Button */
  .btn-call-waiter{
    position:fixed;
    bottom:88px;
    right:18px;
    z-index:90;
    display:flex;
    align-items:center;
    gap:8px;
    background:linear-gradient(135deg, #5a1f1f 0%, #3d1414 100%);
    color:#fff;
    border:2px solid #e07a5f;
    border-radius:999px;
    padding:10px 16px;
    font-size:13px;
    font-weight:700;
    cursor:pointer;
    box-shadow:0 8px 25px rgba(90,31,31,0.35);
    transition:all .2s ease;
  }
  .btn-call-waiter:hover{
    transform:translateY(-2px);
    box-shadow:0 12px 28px rgba(90,31,31,0.45);
  }
  .btn-call-waiter:active{
    transform:scale(0.96);
  }
  .btn-call-waiter .bell-icon{
    font-size:16px;
    display:inline-block;
    animation:ring 2.5s infinite ease-in-out;
  }
  @keyframes ring{
    0%, 80%, 100%{ transform:rotate(0); }
    85%{ transform:rotate(15deg); }
    90%{ transform:rotate(-15deg); }
    95%{ transform:rotate(8deg); }
  }

  /* Call Waiter Modal Overlay */
  .call-modal-overlay{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,0.6);
    backdrop-filter:blur(4px);
    z-index:150;
    display:none;
    align-items:flex-end;
    justify-content:center;
    opacity:0;
    transition:opacity .25s ease;
  }
  .call-modal-overlay.show{
    display:flex;
    opacity:1;
  }
  .call-modal{
    width:100%;
    max-width:480px;
    background:#ffffff;
    border-radius:28px 28px 0 0;
    padding:24px 22px calc(24px + env(safe-area-inset-bottom));
    box-shadow:0 -10px 40px rgba(0,0,0,0.2);
    transform:translateY(100%);
    transition:transform .25s ease-out;
    max-height:90vh;
    overflow-y:auto;
  }
  .call-modal-overlay.show .call-modal{
    transform:translateY(0);
  }
  .call-modal-header{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    margin-bottom:18px;
  }
  .call-modal-title{
    font-size:18px;
    font-weight:800;
    color:var(--dark);
  }
  .call-modal-subtitle{
    font-size:12.5px;
    color:var(--muted);
    margin-top:3px;
  }
  .call-modal-close{
    background:none;
    border:none;
    font-size:26px;
    color:var(--muted);
    cursor:pointer;
    line-height:1;
    padding:0 4px;
  }
  .table-info-badge{
    background:#fdf5ee;
    border:1px solid #ebd4c1;
    color:#7a3c18;
    padding:10px 14px;
    border-radius:12px;
    font-size:13px;
    margin-bottom:16px;
    display:flex;
    align-items:center;
    gap:8px;
  }
  .table-select{
    width:100%;
    padding:11px 14px;
    border-radius:12px;
    border:1px solid #eee2d8;
    background:#fff;
    font-size:13.5px;
    font-weight:600;
    color:var(--dark);
    outline:none;
    margin-bottom:16px;
  }
  .service-type-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:10px;
    margin-bottom:16px;
  }
  .service-type-option{
    border:1.5px solid #eee2d8;
    border-radius:14px;
    padding:12px 10px;
    text-align:center;
    font-size:12.5px;
    font-weight:700;
    color:var(--dark);
    cursor:pointer;
    transition:all .15s ease;
    display:flex;
    align-items:center;
    justify-content:center;
    user-select:none;
  }
  .service-type-option input{ display:none; }
  .service-type-option.active{
    background:#fcf2eb;
    border-color:var(--accent);
    color:var(--maroon);
  }
  .service-notes-input{
    width:100%;
    padding:11px 14px;
    border-radius:12px;
    border:1px solid #eee2d8;
    font-size:13px;
    outline:none;
    margin-bottom:20px;
    box-sizing:border-box;
  }
  .service-notes-input:focus{ border-color:var(--accent); }
  .btn-submit-call{
    width:100%;
    border:none;
    background:var(--maroon);
    color:#fff;
    padding:15px;
    border-radius:999px;
    font-size:15px;
    font-weight:700;
    cursor:pointer;
    box-shadow:0 6px 18px rgba(90,31,31,0.3);
    transition:all .15s ease;
  }
  .btn-submit-call:hover{ background:#421515; }
  .btn-submit-call:disabled{ opacity:.6; cursor:not-allowed; }
  .call-success-state{
    text-align:center;
    padding:20px 10px;
  }
  .success-icon{ font-size:44px; margin-bottom:12px; }
  .success-title{ font-size:18px; font-weight:800; color:var(--dark); margin-bottom:6px; }
  .success-desc{ font-size:13px; color:var(--muted); line-height:1.5; margin-bottom:20px; }
</style>
</head>
<body>

<div class="phone">
  <div class="content">

    <div class="header">
      <div>
        <div class="greet-sub">Selamat Datang,</div>
        <div class="greet-name">{{ Auth::guard('customer')->user()->name ?? 'Pengunjung' }}</div>
      </div>
      <img
            src="{{ asset('assets/images/LOGO_RUANG_SEDUH(coklat).png') }}"
            class="logo"
            alt="Logo">
    </div>

    <div class="search-bar">
      <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
      <input type="text" id="searchInput" placeholder="Cari menu, misal: Americano">
    </div>

    <div class="categories">
      <div class="chip active" data-category="Semua">Semua</div>
      @foreach($categories as $category)
        <div class="chip" data-category="{{ $category->name }}">{{ $category->name }}</div>
      @endforeach
    </div>

    <div class="section-title" id="sectionTitle">Semua Menu</div>

    <div class="grid" id="menuGrid">
      @forelse($menus as $index => $menu)
        <a href="{{ route('customer.menu.show', $menu->id) }}" class="card" data-name="{{ $menu->name }}" data-category="{{ $menu->kategori->name ?? '' }}">
          <div class="thumb">
            @if($menu->image)
              <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" loading="lazy" decoding="async" style="width:100%;height:100%;object-fit:cover;">
            @else
              {!! $index % 2 === 0
                ? '<svg viewBox="0 0 200 140" preserveAspectRatio="xMidYMid slice"><defs><linearGradient id="g'. $index .'" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#3d2b1f"/><stop offset="1" stop-color="#1a1210"/></linearGradient></defs><rect width="200" height="140" fill="#1a1210"/><ellipse cx="100" cy="70" rx="55" ry="38" fill="url(#g'. $index .')"/><rect x="60" y="60" width="80" height="55" rx="8" fill="#3d2b1f" opacity="0.9"/><ellipse cx="100" cy="60" rx="40" ry="14" fill="#1a1210" opacity="0.85"/></svg>'
                : '<svg viewBox="0 0 200 140" preserveAspectRatio="xMidYMid slice"><defs><radialGradient id="p'. $index .'" cx="50%" cy="40%" r="70%"><stop offset="0" stop-color="#e0a83c"/><stop offset="1" stop-color="#a5501c"/></radialGradient></defs><rect width="200" height="140" fill="#a5501c"/><ellipse cx="100" cy="75" rx="70" ry="42" fill="url(#p'. $index .')"/><path d="M50 80 Q100 40 150 80" stroke="#a5501c" stroke-width="4" fill="none" opacity="0.5"/></svg>'
              !!}
            @endif
          </div>
          <div class="card-body">
            <div class="card-tag">{{ $menu->kategori->name ?? 'Lainnya' }}</div>
            <div class="card-name">{{ $menu->name }}</div>
            <div class="card-price">{{ $menu->hargaRupiah() }}</div>
            <div class="card-stock">Stok: {{ $menu->stock }}</div>
          </div>
        </a>
      @empty
        <div style="grid-column:1/-1; text-align:center; color:var(--muted); padding:30px 0; font-size:13px;">Menu tidak tersedia</div>
      @endforelse
    </div>

  </div>

  <div class="navbar-wrap">
  <nav class="navbar" id="navbar">
    <a href="{{ route('customer.profile.index') }}" class="nav-item" data-name="profile" aria-label="Profil">
      <img src="{{ asset('assets/images/navbar/profile.png') }}" alt="" aria-hidden="true">
    </a>
    <a href="{{ route('customer.order.history') }}" class="nav-item" data-name="history" aria-label="Riwayat">
      <img src="{{ asset('assets/images/navbar/history.png') }}" alt="" aria-hidden="true">
    </a>
    <a href="{{ route('customer.home') }}" class="nav-item active" data-name="home" aria-label="Beranda">
      <img src="{{ asset('assets/images/navbar/home.png') }}" alt="" aria-hidden="true">
    </a>
    <a href="{{ route('customer.cart.index') }}" class="nav-item" data-name="cart" aria-label="Keranjang">
      <img src="{{ asset('assets/images/navbar/cart.png') }}" alt="" aria-hidden="true">
    </a>
  </nav>
  </div>

  <!-- Floating Call Waiter Button -->
  <button type="button" class="btn-call-waiter" id="btnOpenCallWaiter" aria-label="Panggil Pelayan">
    <span class="bell-icon">🛎️</span>
    <span class="btn-call-text">{{ $activeTable ? 'Meja ' . $activeTable->table_number : 'Panggil Pelayan' }}</span>
  </button>
</div>

<!-- Modal Panggil Pelayan -->
<div class="call-modal-overlay" id="callModalOverlay">
  <div class="call-modal">
    <div class="call-modal-header">
      <div>
        <div class="call-modal-title">🛎️ Panggil Pelayan</div>
        <div class="call-modal-subtitle">Butuh bantuan di mejamu? Staf kami siap melayani.</div>
      </div>
      <button type="button" class="call-modal-close" id="btnCloseCallModal">&times;</button>
    </div>

    <form id="callWaiterForm">
      @csrf
      @if($activeTable)
        <input type="hidden" name="table_id" value="{{ $activeTable->id }}">
        <div class="table-info-badge">
          📍 Meja Aktif: <strong>Meja {{ $activeTable->table_number }}</strong>
        </div>
      @else
        <div style="margin-bottom:14px;">
          <label style="display:block; font-size:12.5px; font-weight:700; color:var(--dark); margin-bottom:6px;">Pilih Nomor Mejamu:</label>
          <select name="table_id" class="table-select" required>
            <option value="">-- Pilih Nomor Meja --</option>
            @foreach($tables as $t)
              <option value="{{ $t->id }}">Meja {{ $t->table_number }}</option>
            @endforeach
          </select>
        </div>
      @endif

      <div style="margin-bottom:14px;">
        <label style="display:block; font-size:12.5px; font-weight:700; color:var(--dark); margin-bottom:8px;">Pilih Kebutuhan:</label>
        <div class="service-type-grid" id="serviceTypeGrid">
          <label class="service-type-option active">
            <input type="radio" name="type" value="panggil_pelayan" checked>
            <span>🙋 Panggil Pelayan</span>
          </label>
          <label class="service-type-option">
            <input type="radio" name="type" value="minta_bill">
            <span>🧾 Minta Bill / Nota</span>
          </label>
          <label class="service-type-option">
            <input type="radio" name="type" value="minta_air">
            <span>💧 Air Putih / Es</span>
          </label>
          <label class="service-type-option">
            <input type="radio" name="type" value="bersih_meja">
            <span>🧹 Bersihkan Meja</span>
          </label>
        </div>
      </div>

      <div>
        <label style="display:block; font-size:12.5px; font-weight:700; color:var(--dark); margin-bottom:6px;">Catatan Tambahan (Opsional):</label>
        <input type="text" name="notes" class="service-notes-input" placeholder="Contoh: Minta tissue atau sendok tambahan..." maxlength="150">
      </div>

      <button type="submit" class="btn-submit-call" id="btnSubmitCall">
        Kirim Panggilan 🛎️
      </button>
    </form>

    <div class="call-success-state" id="callSuccessState" style="display:none;">
      <div class="success-icon">🏃💨</div>
      <div class="success-title">Panggilan Berhasil Dikirim!</div>
      <div class="success-desc">Pelayan kami sedang menuju ke mejamu. Mohon ditunggu sebentar ya kak!</div>
      <button type="button" class="btn-submit-call" style="background:#3d1414;" id="btnCloseSuccess">Selesai</button>
    </div>
  </div>
</div>

<script>
  const grid = document.getElementById('menuGrid');
  const sectionTitle = document.getElementById('sectionTitle');
  const searchInput = document.getElementById('searchInput');
  const cards = Array.from(document.querySelectorAll('#menuGrid .card'));

  function renderMenu(){
    const activeChip = document.querySelector('.chip.active');
    const category = activeChip ? activeChip.dataset.category : 'Semua';
    const keyword = searchInput.value.trim().toLowerCase();

    let visible = 0;
    cards.forEach(card=>{
      const name = card.dataset.name || '';
      const cat = card.dataset.category || '';

      const matchCategory = category === 'Semua' || cat === category;
      const matchKeyword = name.toLowerCase().includes(keyword);

      if (matchCategory && matchKeyword){
        card.style.display = '';
        visible++;
      } else {
        card.style.display = 'none';
      }
    });

    sectionTitle.textContent = category === 'Semua' ? 'Semua Menu' : category;

    let empty = grid.querySelector('.grid-empty');
    if (visible === 0){
      if (!empty){
        empty = document.createElement('div');
        empty.className = 'grid-empty';
        empty.style.cssText = 'grid-column:1/-1; text-align:center; color:var(--muted); padding:30px 0; font-size:13px;';
        empty.textContent = 'Menu tidak ditemukan';
        grid.appendChild(empty);
      }
    } else if (empty){
      empty.remove();
    }
  }

  renderMenu();

  // ---- Navbar interaction ----
  const items = document.querySelectorAll('.nav-item');
  items.forEach(item=>{
    item.addEventListener('click', ()=>{
      items.forEach(i=>i.classList.remove('active'));
      item.classList.add('active');
    });
  });

  // ---- Category chip interaction ----
  const chips = document.querySelectorAll('.chip');
  chips.forEach(chip=>{
    chip.addEventListener('click', ()=>{
      chips.forEach(c=>c.classList.remove('active'));
      chip.classList.add('active');
      renderMenu();
    });
  });

  // ---- Search interaction ----
  searchInput.addEventListener('input', renderMenu);

  // ---- Call Waiter Interaction ----
  const btnOpenCallWaiter = document.getElementById('btnOpenCallWaiter');
  const callModalOverlay = document.getElementById('callModalOverlay');
  const btnCloseCallModal = document.getElementById('btnCloseCallModal');
  const btnCloseSuccess = document.getElementById('btnCloseSuccess');
  const callWaiterForm = document.getElementById('callWaiterForm');
  const callSuccessState = document.getElementById('callSuccessState');
  const btnSubmitCall = document.getElementById('btnSubmitCall');

  function openCallModal(){
    callModalOverlay.classList.add('show');
    callWaiterForm.style.display = '';
    callSuccessState.style.display = 'none';
  }
  function closeCallModal(){
    callModalOverlay.classList.remove('show');
  }

  btnOpenCallWaiter?.addEventListener('click', openCallModal);
  btnCloseCallModal?.addEventListener('click', closeCallModal);
  btnCloseSuccess?.addEventListener('click', closeCallModal);
  callModalOverlay?.addEventListener('click', (e)=>{
    if (e.target === callModalOverlay) closeCallModal();
  });

  // Type selection highlight
  const typeOptions = document.querySelectorAll('.service-type-option');
  typeOptions.forEach(opt => {
    opt.addEventListener('click', () => {
      typeOptions.forEach(o => o.classList.remove('active'));
      opt.classList.add('active');
    });
  });

  // Submit Call
  callWaiterForm?.addEventListener('submit', function(e){
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
        if (data.data && data.data.table_id) {
          const btnText = document.querySelector('.btn-call-text');
          if (btnText && !btnText.textContent.includes('Meja')) {
            btnText.textContent = 'Meja Dipilih';
          }
        }
      } else {
        alert(data.message || 'Gagal mengirim panggilan. Silakan coba lagi.');
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