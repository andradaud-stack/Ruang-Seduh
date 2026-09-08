<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>Ubah Kata Sandi - Ruang Seduh</title>
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

  .cp-wrap {
    width: 100%;
    max-width: 480px;
    margin: 0 auto;
    min-height: 100vh;
    background: var(--bg-page);
    position: relative;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
  }

  /* Header */
  .cp-header {
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
  .cp-back {
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
  .cp-back:hover {
    background: #ffffff;
    border-color: var(--border-hover);
  }
  .cp-back svg {
    width: 18px;
    height: 18px;
    stroke: currentColor;
    stroke-width: 2.2;
    fill: none;
  }
  .cp-header h1 {
    font-size: 18px;
    font-weight: 800;
    letter-spacing: -0.02em;
    color: var(--text-primary);
  }

  .cp-body {
    padding: 20px;
  }

  .cp-alert {
    background: #ecfdf5;
    border: 1px solid #a7f3d0;
    border-radius: var(--radius-md);
    padding: 12px 16px;
    font-size: 13px;
    font-weight: 600;
    color: #065f46;
    margin-bottom: 16px;
  }

  .form-card {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 24px 20px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
  }

  .form-group {
    margin-bottom: 18px;
  }
  .form-label {
    display: block;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    color: var(--text-secondary);
    margin-bottom: 8px;
  }
  .form-input {
    width: 100%;
    padding: 12px 14px;
    border-radius: var(--radius-md);
    background: #ffffff;
    border: 1px solid var(--border);
    font-family: inherit;
    font-size: 14px;
    color: var(--text-primary);
    outline: none;
    transition: all 0.15s ease;
  }
  .form-input:focus {
    border-color: var(--brand);
    box-shadow: 0 0 0 3px rgba(15, 23, 42, 0.08);
  }
  .form-error {
    color: #dc2626;
    font-size: 12px;
    font-weight: 600;
    margin-top: 6px;
  }

  .btn-submit {
    width: 100%;
    padding: 14px;
    border-radius: var(--radius-md);
    background: var(--brand);
    color: #ffffff;
    border: none;
    font-family: inherit;
    font-size: 14.5px;
    font-weight: 700;
    cursor: pointer;
    box-shadow: 0 4px 14px rgba(15, 23, 42, 0.15);
    transition: all 0.15s ease;
    margin-top: 10px;
  }
  .btn-submit:hover {
    background: var(--brand-hover);
  }
  .btn-submit:active {
    transform: scale(0.98);
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
          <input type="password" id="password" name="password" class="form-input" placeholder="••••••••" required>
          @error('password')
            <div class="form-error">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label" for="password_confirmation">Konfirmasi Kata Sandi Baru</label>
          <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" placeholder="••••••••" required>
        </div>

        <button type="submit" class="btn-submit">Simpan Kata Sandi</button>
      </form>
    </div>
  </main>

</div>
</body>
</html>