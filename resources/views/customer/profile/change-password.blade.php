<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <title>Ubah Kata Sandi — Ruang Seduh</title>
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
    a { color: inherit; text-decoration: none; }

    .cp-wrap {
      width: min(100%, 720px);
      margin: 0 auto;
      min-height: 100vh;
      background: var(--cream);
      position: relative;
      box-shadow: 0 0 50px rgba(36, 23, 15, 0.08);
    }

    /* Header */
    .cp-header {
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

    .cp-back {
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
    .cp-back:hover {
      background: #fffdfa;
      transform: scale(1.05);
    }
    .cp-back svg {
      width: 20px;
      height: 20px;
      stroke: currentColor;
      stroke-width: 2.3;
      fill: none;
    }

    .cp-header h1 {
      font-family: "Playfair Display", serif;
      font-size: 22px;
      font-weight: 700;
      color: var(--ink);
    }

    .cp-body {
      padding: 24px 28px;
    }

    .cp-alert {
      background: var(--green-bg);
      border: 1px solid #bbf7d0;
      border-radius: 16px;
      padding: 13px 18px;
      font-size: 13px;
      font-weight: 600;
      color: var(--green);
      margin-bottom: 18px;
    }

    .form-card {
      background: var(--paper);
      border: 1px solid var(--line);
      border-radius: 24px;
      padding: 28px 24px;
      box-shadow: 0 6px 20px rgba(36, 23, 15, 0.04);
    }

    .form-group {
      margin-bottom: 20px;
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
      padding: 14px 16px;
      border-radius: 16px;
      background: #ffffff;
      border: 1px solid var(--line);
      font-family: inherit;
      font-size: 14px;
      color: var(--ink);
      outline: none;
      transition: all 0.2s ease;
    }
    .form-input:focus {
      border-color: var(--brown);
      box-shadow: 0 0 0 3px rgba(90, 53, 31, 0.1);
    }
    .form-error {
      color: #be123c;
      font-size: 12px;
      font-weight: 600;
      margin-top: 6px;
    }

    .btn-submit {
      width: 100%;
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
      margin-top: 10px;
    }
    .btn-submit:hover {
      background: var(--brown-2);
      transform: translateY(-2px);
    }
    .btn-submit:active {
      transform: scale(0.98);
    }

    @media (max-width: 480px) {
      .cp-header { padding: 18px 20px 14px; }
      .cp-body { padding: 18px 20px; }
      .form-card { padding: 22px 18px; }
    }
  </style>
</head>
<body>

<div class="cp-wrap">

  <header class="cp-header">
    <a href="{{ route('customer.profile.index') }}" class="cp-back" aria-label="Kembali ke Profil">
      <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"></polyline></svg>
    </a>
    <h1>Ubah Kata Sandi</h1>
  </header>

  <main class="cp-body">
    @if(session('message_success'))
      <div class="cp-alert">{{ session('message_success') }}</div>
    @endif

    <div class="form-card">
      <form action="{{ route('customer.password.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
          <label class="form-label" for="current_password">Kata Sandi Lama</label>
          <input type="password" id="current_password" name="current_password" class="form-input" placeholder="••••••••" required>
          @error('current_password')
            <div class="form-error">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label" for="password">Kata Sandi Baru</label>
          <input type="password" id="password" name="password" class="form-input" placeholder="Minimal 8 karakter" required>
          @error('password')
            <div class="form-error">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label" for="password_confirmation">Konfirmasi Kata Sandi Baru</label>
          <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" placeholder="Ulangi kata sandi baru" required>
        </div>

        <button type="submit" class="btn-submit">Simpan Kata Sandi</button>
      </form>
    </div>
  </main>

</div>

@include('customer.include.order_notifications')
</body>
</html>