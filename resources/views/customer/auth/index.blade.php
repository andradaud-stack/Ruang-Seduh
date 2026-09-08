<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <title>Ruang Seduh — Coffee & Artisan Brew</title>
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

    .welcome-wrap {
      width: min(100%, 480px);
      min-height: 100vh;
      background: var(--cream);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 40px 32px 36px;
      box-shadow: 0 0 50px rgba(36, 23, 15, 0.08);
      position: relative;
      overflow: hidden;
    }

    /* Top Brand */
    .top-brand {
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .brand-mark {
      width: 44px;
      height: 44px;
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
      font-size: 8.5px;
      letter-spacing: 2.5px;
      color: var(--muted);
      font-weight: 700;
    }

    /* Hero Art Area */
    .art-area {
      position: relative;
      height: 260px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 20px 0;
    }
    .hero-glow {
      position: absolute;
      width: 260px;
      height: 260px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(215, 155, 95, 0.25) 0%, rgba(247, 241, 233, 0) 70%);
    }

    .coffee-cup {
      position: relative;
      width: 170px;
      height: 110px;
      background: #fff;
      border-radius: 45% 45% 48% 48%;
      box-shadow: 0 20px 35px rgba(72, 43, 24, 0.2);
      transform: rotate(-4deg);
    }
    .coffee {
      position: absolute;
      width: 150px;
      height: 48px;
      top: 6px;
      left: 10px;
      background: radial-gradient(circle at 50% 50%, #d79b5f, #6c361b 70%);
      border-radius: 50%;
    }
    .latte-art {
      position: absolute;
      top: 12px;
      left: 64px;
      color: #f2d6af;
      font-size: 26px;
      transform: rotate(-4deg);
      user-select: none;
    }
    .handle {
      position: absolute;
      width: 55px;
      height: 55px;
      border: 14px solid #fff;
      border-left: 0;
      border-radius: 0 50% 50% 0;
      right: -40px;
      top: 26px;
    }
    .steam {
      position: absolute;
      width: 8px;
      height: 60px;
      border-left: 3px solid rgba(111, 80, 55, 0.28);
      border-radius: 50%;
      top: -30px;
    }
    .s1 { left: 55px; transform: rotate(10deg); animation: steamMove 3s infinite ease-in-out; }
    .s2 { left: 95px; transform: rotate(-12deg); height: 45px; animation: steamMove 3s 1.5s infinite ease-in-out; }

    @keyframes steamMove {
      0%, 100% { transform: translateY(0) rotate(10deg); opacity: 0.25; }
      50% { transform: translateY(-8px) rotate(6deg); opacity: 0.55; }
    }

    /* Content */
    .content-area {
      position: relative;
      z-index: 2;
    }
    .eyebrow {
      color: var(--brown-2);
      letter-spacing: 3px;
      font-size: 10px;
      font-weight: 700;
      text-transform: uppercase;
      display: block;
      margin-bottom: 8px;
    }
    h1 {
      font-family: "Playfair Display", serif;
      font-size: 34px;
      line-height: 1.15;
      color: var(--ink);
      margin-bottom: 12px;
    }
    h1 em {
      color: var(--brown-2);
      font-style: italic;
    }
    p {
      font-size: 14.5px;
      color: #655950;
      line-height: 1.55;
      margin-bottom: 28px;
    }

    /* Action Buttons */
    .actions {
      display: flex;
      flex-direction: column;
      gap: 12px;
    }
    .btn-main {
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 16px;
      border-radius: 16px;
      background: var(--brown);
      color: #ffffff;
      font-size: 15px;
      font-weight: 700;
      text-decoration: none;
      box-shadow: 0 8px 24px rgba(90, 53, 31, 0.25);
      transition: all 0.2s ease;
    }
    .btn-main:hover {
      background: var(--brown-2);
      transform: translateY(-2px);
    }
    .btn-outline {
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 15px;
      border-radius: 16px;
      background: var(--paper);
      color: var(--ink);
      border: 1.5px solid var(--line);
      font-size: 15px;
      font-weight: 700;
      text-decoration: none;
      box-shadow: 0 4px 14px rgba(36, 23, 15, 0.04);
      transition: all 0.2s ease;
    }
    .btn-outline:hover {
      border-color: var(--brown);
      color: var(--brown);
      transform: translateY(-2px);
    }
  </style>
</head>
<body>

<div class="welcome-wrap">

  <div class="top-brand">
    <div class="brand-mark">☕</div>
    <div>
      <div class="brand-title">Ruang Seduh</div>
      <div class="brand-sub">COFFEE & ARTISAN BREW</div>
    </div>
  </div>

  <div class="art-area" aria-hidden="true">
    <div class="hero-glow"></div>
    <div class="coffee-cup">
      <div class="steam s1"></div>
      <div class="steam s2"></div>
      <div class="coffee"></div>
      <div class="latte-art">♥</div>
      <div class="handle"></div>
    </div>
  </div>

  <div class="content-area">
    <span class="eyebrow">GOOD COFFEE • GOOD MOOD</span>
    <h1>Tempat Singgah<br><em>Sebelum Melangkah</em></h1>
    <p>Nikmati seduhan kopi pilihan, hidangan hangat, dan ruang jeda terbaik untuk setiap ceritamu.</p>

    <div class="actions">
      <a href="{{ route('customer.login') }}" class="btn-main">
        Masuk ke Akun
      </a>
      <a href="{{ route('customer.register') }}" class="btn-outline">
        Daftar Akun Baru
      </a>
    </div>
  </div>

</div>

</body>
</html>