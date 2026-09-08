<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <title>Ubah Profil — Ruang Seduh</title>
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

    .ep-wrap {
      width: min(100%, 720px);
      margin: 0 auto;
      min-height: 100vh;
      background: var(--cream);
      position: relative;
      box-shadow: 0 0 50px rgba(36, 23, 15, 0.08);
    }

    /* Header */
    .ep-header {
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

    .ep-back {
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
    .ep-back:hover {
      background: #fffdfa;
      transform: scale(1.05);
    }
    .ep-back svg {
      width: 20px;
      height: 20px;
      stroke: currentColor;
      stroke-width: 2.3;
      fill: none;
    }

    .ep-header h1 {
      font-family: "Playfair Display", serif;
      font-size: 22px;
      font-weight: 700;
      color: var(--ink);
    }

    .ep-body {
      padding: 24px 28px;
    }

    .form-card {
      background: var(--paper);
      border: 1px solid var(--line);
      border-radius: 24px;
      padding: 28px 24px;
      box-shadow: 0 6px 20px rgba(36, 23, 15, 0.04);
    }

    .form-group {
      margin-bottom: 22px;
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
      .ep-header { padding: 18px 20px 14px; }
      .ep-body { padding: 18px 20px; }
      .form-card { padding: 22px 18px; }
    }
  </style>
</head>
<body>

<div class="ep-wrap">

  <header class="ep-header">
    <a href="{{ route('customer.profile.index') }}" class="ep-back" aria-label="Kembali ke Profil">
      <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"></polyline></svg>
    </a>
    <h1>Ubah Profil</h1>
  </header>

  <main class="ep-body">
    <div class="form-card">
      <form action="{{ route('customer.profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
          <label class="form-label" for="name">Nama Lengkap</label>
          <input type="text" id="name" name="name" class="form-input"
                 value="{{ old('name', $user->name ?? '') }}" required>
          @error('name')
            <div class="form-error">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label" for="email">Alamat Email</label>
          <input type="email" id="email" name="email" class="form-input"
                 value="{{ old('email', $user->email ?? '') }}" required>
          @error('email')
            <div class="form-error">{{ $message }}</div>
          @enderror
        </div>

        <button type="submit" class="btn-submit">Simpan Perubahan</button>
      </form>
    </div>
  </main>

</div>

@include('customer.include.order_notifications')
</body>
</html>