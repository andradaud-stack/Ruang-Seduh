<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <title>Daftar — Ruang Seduh</title>
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
      display: flex;
      justify-content: center;
      align-items: center;
      -webkit-font-smoothing: antialiased;
    }

    button, input { font: inherit; }
    button { border: 0; cursor: pointer; }
    a { color: inherit; text-decoration: none; }

    .register-wrap {
      width: min(100%, 480px);
      min-height: 100vh;
      background: var(--cream);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 36px 28px;
      box-shadow: 0 0 50px rgba(36, 23, 15, 0.08);
      position: relative;
    }

    /* Top Brand */
    .top-brand {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 24px;
    }
    .brand-mark {
      width: 42px;
      height: 42px;
      border-radius: 14px;
      background: var(--ink);
      color: #fff;
      display: grid;
      place-items: center;
      font-size: 20px;
      box-shadow: 0 8px 20px rgba(36, 23, 15, 0.12);
    }
    .brand-title {
      font-family: "Playfair Display", serif;
      font-size: 20px;
      font-weight: 700;
      color: var(--ink);
      line-height: 1.1;
    }
    .brand-sub {
      font-size: 8px;
      letter-spacing: 2px;
      color: var(--muted);
      font-weight: 700;
    }

    .form-card {
      background: var(--paper);
      border: 1px solid var(--line);
      border-radius: 26px;
      padding: 28px 24px;
      box-shadow: 0 10px 30px rgba(36, 23, 15, 0.05);
    }

    .card-heading {
      margin-bottom: 20px;
    }
    .card-heading h1 {
      font-family: "Playfair Display", serif;
      font-size: 26px;
      font-weight: 700;
      color: var(--ink);
      margin-bottom: 4px;
    }
    .card-heading p {
      font-size: 13.5px;
      color: var(--muted);
    }

    /* Table Alert */
    .table-badge {
      background: var(--green-bg);
      border: 1px solid #bbf7d0;
      color: var(--green);
      padding: 11px 14px;
      border-radius: 14px;
      font-size: 13px;
      font-weight: 700;
      margin-bottom: 18px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .error-badge {
      background: #fee2e2;
      border: 1px solid #fecaca;
      color: #b91c1c;
      padding: 11px 14px;
      border-radius: 14px;
      font-size: 13px;
      font-weight: 600;
      margin-bottom: 18px;
    }

    .form-group {
      margin-bottom: 16px;
    }
    .form-label {
      display: block;
      font-size: 12px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      color: var(--brown-2);
      margin-bottom: 8px;
    }
    .form-input {
      width: 100%;
      height: 48px;
      padding: 0 16px;
      border-radius: 14px;
      background: #ffffff;
      border: 1px solid var(--line);
      font-size: 14px;
      color: var(--ink);
      outline: none;
      transition: all 0.2s ease;
    }
    .form-input:focus {
      border-color: var(--brown);
      box-shadow: 0 0 0 3px rgba(90, 53, 31, 0.1);
    }
    .form-input::placeholder {
      color: #a89f97;
    }

    .password-field {
      position: relative;
    }
    .password-field input {
      padding-right: 46px;
    }
    .password-toggle {
      position: absolute;
      right: 14px;
      top: 50%;
      transform: translateY(-50%);
      background: transparent;
      padding: 4px;
    }
    .password-toggle img {
      width: 20px;
      height: 20px;
      opacity: 0.6;
      display: block;
    }

    .btn-submit {
      width: 100%;
      height: 52px;
      border-radius: 16px;
      background: var(--brown);
      color: #ffffff;
      font-size: 15px;
      font-weight: 700;
      box-shadow: 0 8px 22px rgba(90, 53, 31, 0.25);
      transition: all 0.2s ease;
      margin-top: 10px;
    }
    .btn-submit:hover {
      background: var(--brown-2);
      transform: translateY(-2px);
    }
    .btn-submit:active {
      transform: scale(0.98);
    }

    .divider {
      display: flex;
      align-items: center;
      margin: 18px 0;
      color: var(--muted);
      font-size: 12px;
      font-weight: 600;
    }
    .divider::before, .divider::after {
      content: "";
      flex: 1;
      border-bottom: 1px solid var(--line);
    }
    .divider span {
      padding: 0 12px;
    }

    .btn-google {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
      width: 100%;
      height: 50px;
      border: 1.5px solid var(--line);
      border-radius: 16px;
      background: #ffffff;
      color: var(--ink);
      font-size: 14px;
      font-weight: 700;
      transition: all 0.2s ease;
      box-shadow: 0 2px 8px rgba(36, 23, 15, 0.04);
    }
    .btn-google:hover {
      border-color: var(--brown);
      transform: translateY(-2px);
      box-shadow: 0 6px 16px rgba(36, 23, 15, 0.08);
    }

    .bottom-hint {
      text-align: center;
      margin-top: 20px;
      font-size: 13.5px;
      color: var(--muted);
    }
    .bottom-hint a {
      color: var(--brown);
      font-weight: 700;
      margin-left: 4px;
    }
    .bottom-hint a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<div class="register-wrap">

  <div>
    <div class="top-brand">
      <div class="brand-mark">☕</div>
      <div>
        <div class="brand-title">Ruang Seduh</div>
        <div class="brand-sub">COFFEE & ARTISAN BREW</div>
      </div>
    </div>

    <div class="form-card">
      <div class="card-heading">
        <h1>Daftar Akun</h1>
        <p>Bergabung dan nikmati pengalaman pesan kopi yang mudah.</p>
      </div>

      @php
        $detectedTable = null;
        $tableParam = request('table') ?? request('table_id');
        if ($tableParam) {
          $detectedTable = \App\Modules\Tables\Models\Tables::where('table_number', $tableParam)
            ->orWhere('table_number', str_pad($tableParam, 2, '0', STR_PAD_LEFT))
            ->orWhere('id', $tableParam)
            ->orWhere('qr_token', $tableParam)
            ->first();
        }
        if (!$detectedTable && ($cookieTbl = request()->cookie('customer_table_id'))) {
          $detectedTable = \App\Modules\Tables\Models\Tables::find($cookieTbl);
        }
        if (!$detectedTable && ($sessTbl = session('customer_table_id'))) {
          $detectedTable = \App\Modules\Tables\Models\Tables::find($sessTbl);
        }
      @endphp

      @if($detectedTable)
        <div class="table-badge">
          <span>📍 Terhubung ke <strong>Meja {{ $detectedTable->table_number }}</strong></span>
        </div>
      @endif

      @if ($errors->any())
        <div class="error-badge">
          <ul style="padding-left: 16px;">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('customer.register.store') }}" method="POST">
        @csrf

        @if($detectedTable)
          <input type="hidden" name="table" value="{{ $detectedTable->table_number }}">
          <input type="hidden" name="table_id" value="{{ $detectedTable->id }}">
        @endif

        <div class="form-group">
          <label class="form-label" for="name">Nama Lengkap</label>
          <input type="text" id="name" name="name" class="form-input" placeholder="Nama lengkap kamu" value="{{ old('name') }}" required autocomplete="name">
        </div>

        <div class="form-group">
          <label class="form-label" for="email">Alamat Email</label>
          <input type="email" id="email" name="email" class="form-input" placeholder="nama@email.com" value="{{ old('email') }}" required autocomplete="email">
        </div>

        <div class="form-group">
          <label class="form-label" for="register-password">Kata Sandi</label>
          <div class="password-field">
            <input type="password" id="register-password" name="password" class="form-input" placeholder="Minimal 8 karakter" required autocomplete="new-password">
            <button type="button" class="password-toggle" data-target="register-password" aria-label="Lihat password">
              <img src="{{ asset('assets/images/toggle/view.png') }}" alt="" aria-hidden="true">
            </button>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label" for="register-password-confirmation">Konfirmasi Kata Sandi</label>
          <div class="password-field">
            <input type="password" id="register-password-confirmation" name="password_confirmation" class="form-input" placeholder="Ulangi kata sandi" required autocomplete="new-password">
            <button type="button" class="password-toggle" data-target="register-password-confirmation" aria-label="Lihat password">
              <img src="{{ asset('assets/images/toggle/view.png') }}" alt="" aria-hidden="true">
            </button>
          </div>
        </div>

        <button type="submit" class="btn-submit">
          Daftar Sekarang
        </button>
      </form>

      <div class="divider">
        <span>atau</span>
      </div>

      <a href="{{ route('auth.google.redirect', $detectedTable ? ['table' => $detectedTable->table_number, 'table_id' => $detectedTable->id] : []) }}" class="btn-google">
        <svg width="18" height="18" viewBox="0 0 24 24">
          <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
          <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
          <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
          <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
        </svg>
        <span>Daftar dengan Google</span>
      </a>

      <div class="bottom-hint">
        Sudah punya akun?
        <a href="{{ route('customer.login', $detectedTable ? ['table' => $detectedTable->table_number, 'table_id' => $detectedTable->id] : []) }}">Masuk di sini</a>
      </div>
    </div>
  </div>

</div>

<script>
  document.querySelectorAll('.password-toggle').forEach(function(button) {
    button.addEventListener('click', function () {
      const target = document.getElementById(this.dataset.target);
      const isPassword = target.type === 'password';
      target.type = isPassword ? 'text' : 'password';
      this.querySelector('img').src = isPassword
        ? "{{ asset('assets/images/toggle/hide.png') }}"
        : "{{ asset('assets/images/toggle/view.png') }}";
      this.setAttribute('aria-label', isPassword ? 'Sembunyikan password' : 'Lihat password');
    });
  });
</script>

</body>
</html>