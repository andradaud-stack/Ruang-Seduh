<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
  <title>Ruang Seduh — Coffee & Artisan Brew</title>
  <link rel="icon" href="{{ asset('assets/images/LOGO_RUANG_SEDUH(putih).png') }}" type="image/png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600;1,700&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

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

    button, input {
      font: inherit;
    }

    button {
      border: 0;
      cursor: pointer;
    }

    a {
      color: inherit;
      text-decoration: none;
    }

    .app-shell {
      width: min(100%, 1180px);
      min-height: 100vh;
      margin: auto;
      background: var(--cream);
      position: relative;
      overflow: hidden;
      padding-bottom: 125px;
      box-shadow: 0 0 50px rgba(36, 23, 15, 0.08);
    }

    /* Topbar */
    .topbar {
      height: 86px;
      padding: 20px 42px 14px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      background: rgba(247, 241, 233, 0.95);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      z-index: 30;
      border-bottom: 1px solid rgba(233, 224, 214, 0.7);
    }

    .brand {
      display: flex;
      align-items: center;
      gap: 13px;
    }

    /* Official Logo Ruang Seduh */
    .brand-mark {
      width: 44px;
      height: 44px;
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: var(--ink);
      box-shadow: 0 8px 20px rgba(36, 23, 15, 0.14);
      flex-shrink: 0;
      padding: 7px;
    }

    .brand-mark img {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }

    .brand-name {
      font-family: "Playfair Display", serif;
      font-size: 23px;
      font-weight: 700;
      line-height: 1.1;
      color: var(--ink);
    }

    .brand-sub {
      color: var(--muted);
      font-size: 9px;
      letter-spacing: 3px;
      margin-top: 2px;
      font-weight: 600;
    }

    .top-actions {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .table-pill-top {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      background: #ffffff;
      padding: 8px 14px;
      border-radius: 999px;
      border: 1px solid var(--line);
      font-size: 12.5px;
      font-weight: 700;
      color: var(--brown);
      box-shadow: 0 4px 14px rgba(36, 23, 15, 0.05);
    }

    .table-pill-top .pulse-dot {
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

    .icon-btn {
      width: 46px;
      height: 46px;
      border-radius: 50%;
      background: #ffffff;
      color: var(--ink);
      box-shadow: 0 6px 20px rgba(36, 23, 15, 0.08);
      font-size: 20px;
      display: grid;
      place-items: center;
      position: relative;
      transition: transform 0.15s ease, background 0.15s ease;
      border: 1px solid var(--line);
    }

    .icon-btn:hover {
      transform: translateY(-2px);
      background: #fffdfa;
      border-color: var(--brown);
    }

    .icon-btn:active {
      transform: scale(0.95);
    }

    /* Hero */
    .hero {
      margin: 12px 42px 25px;
      min-height: 265px;
      border-radius: 34px;
      padding: 42px 44px;
      position: relative;
      overflow: hidden;
      background:
        radial-gradient(circle at 90% 20%, #ead9c4 0 24%, transparent 25%),
        linear-gradient(120deg, #fffaf2 0%, #f3e9dc 100%);
      box-shadow: 0 16px 36px rgba(54, 35, 22, 0.06);
      border: 1px solid rgba(255, 255, 255, 0.6);
    }

    .hero-copy {
      position: relative;
      z-index: 2;
      max-width: 580px;
    }

    .eyebrow, .section-kicker {
      color: var(--brown-2);
      letter-spacing: 3px;
      font-size: 10px;
      font-weight: 700;
      text-transform: uppercase;
    }

    .hero h1 {
      font-family: "Playfair Display", serif;
      font-size: clamp(34px, 4.5vw, 56px);
      line-height: 1.05;
      margin: 15px 0 14px;
      color: var(--ink);
    }

    .hero h1 em {
      color: var(--brown-2);
      font-style: italic;
    }

    .hero p {
      color: #665950;
      font-size: 16px;
      line-height: 1.5;
    }

    .hero-art {
      position: absolute;
      width: 360px;
      height: 260px;
      right: 12px;
      bottom: -18px;
      pointer-events: none;
    }

    .coffee-cup {
      position: absolute;
      width: 205px;
      height: 125px;
      right: 60px;
      bottom: 23px;
      background: #fff;
      border-radius: 45% 45% 48% 48%;
      box-shadow: 0 22px 30px rgba(72, 43, 24, 0.22);
      transform: rotate(-5deg);
    }

    .coffee {
      position: absolute;
      width: 180px;
      height: 53px;
      top: 7px;
      left: 12px;
      background: radial-gradient(circle at 50% 50%, #d79b5f, #6c361b 70%);
      border-radius: 50%;
    }

    .latte-art {
      position: absolute;
      top: 14px;
      left: 80px;
      color: #f2d6af;
      font-size: 30px;
      transform: rotate(-4deg);
      user-select: none;
    }

    .handle {
      position: absolute;
      width: 65px;
      height: 65px;
      border: 16px solid #fff;
      border-left: 0;
      border-radius: 0 50% 50% 0;
      right: -48px;
      top: 30px;
    }

    .steam {
      position: absolute;
      width: 10px;
      height: 70px;
      border-left: 3px solid rgba(111, 80, 55, 0.25);
      border-radius: 50%;
      bottom: 145px;
    }
    .s1 { right: 160px; transform: rotate(10deg); animation: steamMove 3s infinite ease-in-out; }
    .s2 { right: 120px; transform: rotate(-12deg); height: 55px; animation: steamMove 3s 1.5s infinite ease-in-out; }

    @keyframes steamMove {
      0%, 100% { transform: translateY(0) rotate(10deg); opacity: 0.25; }
      50% { transform: translateY(-8px) rotate(6deg); opacity: 0.55; }
    }

    /* Search row */
    .search-row {
      display: flex;
      gap: 12px;
      margin: 0 42px 20px;
    }

    .search-box {
      height: 61px;
      flex: 1;
      display: flex;
      align-items: center;
      gap: 15px;
      background: #fff;
      border: 1px solid #eee5db;
      border-radius: 20px;
      padding: 0 22px;
      box-shadow: 0 10px 30px rgba(54, 35, 22, 0.05);
      transition: border-color 0.2s, box-shadow 0.2s;
    }

    .search-box:focus-within {
      border-color: var(--brown);
      box-shadow: 0 10px 30px rgba(90, 53, 31, 0.1);
    }

    .search-box span {
      font-size: 24px;
      line-height: 0;
      color: var(--muted);
    }

    .search-box input {
      width: 100%;
      border: 0;
      outline: 0;
      background: transparent;
      color: var(--ink);
      font-size: 15px;
    }

    .search-box input::placeholder {
      color: #aaa19a;
    }

    .filter-btn {
      width: 61px;
      height: 61px;
      border-radius: 20px;
      background: var(--brown);
      color: #ffffff;
      font-size: 24px;
      display: grid;
      place-items: center;
      box-shadow: 0 10px 25px rgba(90, 53, 31, 0.2);
      transition: transform 0.15s, background 0.15s;
      flex-shrink: 0;
    }

    .filter-btn:hover {
      background: var(--brown-2);
      transform: translateY(-2px);
    }

    .filter-btn:active {
      transform: scale(0.95);
    }

    /* Categories */
    .categories {
      display: flex;
      gap: 10px;
      padding: 0 42px;
      overflow-x: auto;
      scrollbar-width: none;
    }

    .categories::-webkit-scrollbar {
      display: none;
    }

    .category {
      flex: 0 0 auto;
      padding: 13px 20px;
      border-radius: 999px;
      background: #fff;
      color: #655950;
      border: 1px solid var(--line);
      font-weight: 600;
      font-size: 13.5px;
      white-space: nowrap;
      transition: all 0.2s ease;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .category:hover {
      transform: translateY(-2px);
      border-color: var(--brown-2);
      color: var(--brown-2);
    }

    .category.active {
      background: var(--brown);
      color: #fff;
      border-color: var(--brown);
      box-shadow: 0 8px 18px rgba(90, 53, 31, 0.18);
    }

    /* Menu section */
    .menu-section {
      padding: 35px 42px 0;
    }

    .section-heading {
      display: flex;
      align-items: flex-end;
      justify-content: space-between;
      margin-bottom: 20px;
    }

    .section-heading h2 {
      font-family: "Playfair Display", serif;
      font-size: 30px;
      margin-top: 5px;
      color: var(--ink);
    }

    .item-count {
      color: var(--muted);
      font-size: 14px;
      font-weight: 600;
    }

    /* Menu Grid */
    .menu-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 18px;
    }

    .menu-card {
      background: #fff;
      border-radius: 24px;
      overflow: hidden;
      border: 1px solid #eee5db;
      box-shadow: 0 12px 30px rgba(54, 35, 22, 0.055);
      transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease;
      position: relative;
      display: flex;
      flex-direction: column;
      text-decoration: none;
      color: inherit;
    }

    .menu-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 18px 35px rgba(54, 35, 22, 0.11);
      border-color: #dfd3c5;
    }

    .product-art {
      height: 205px;
      position: relative;
      overflow: hidden;
      background: #d9c1a6;
      display: grid;
      place-items: center;
    }

    .product-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
      transition: transform 0.35s ease;
    }

    .menu-card:hover .product-img {
      transform: scale(1.06);
    }

    .product-art::before {
      content: "";
      position: absolute;
      width: 210px;
      height: 210px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.14);
      top: -90px;
      right: -50px;
    }

    /* Stylized CSS Cup Art */
    .cup-art {
      width: 125px;
      height: 88px;
      border-radius: 22px 22px 43px 43px;
      background: #f8f5ef;
      position: relative;
      box-shadow: 0 18px 24px rgba(52, 28, 15, 0.22);
      transform: translateY(10px);
    }

    .cup-art::before {
      content: "";
      position: absolute;
      width: 102px;
      height: 31px;
      top: 5px;
      left: 12px;
      border-radius: 50%;
      background: var(--drink, #4a2415);
      box-shadow: inset 0 5px 8px rgba(255, 255, 255, 0.22);
    }

    .cup-art::after {
      content: "";
      position: absolute;
      width: 35px;
      height: 39px;
      border: 10px solid #f8f5ef;
      border-left: 0;
      border-radius: 0 50% 50% 0;
      right: -27px;
      top: 21px;
    }

    .art-espresso { background: linear-gradient(135deg, #7b4b2d, #c89a68); --drink: #3b1b0b; }
    .art-americano { background: linear-gradient(135deg, #4d3a2d, #b47d50); --drink: #2b170c; }
    .art-cappuccino { background: linear-gradient(135deg, #bb9876, #e2c9aa); --drink: #d79b5f; }
    .art-mocha { background: linear-gradient(135deg, #80614e, #c9a48b); --drink: #4e2e1e; }
    .art-matcha { background: linear-gradient(135deg, #70855c, #c5d5aa); --drink: #556b2f; }
    .art-chocolate { background: linear-gradient(135deg, #72503f, #b88868); --drink: #402213; }
    .art-tea { background: linear-gradient(135deg, #8d9b78, #d4d9b5); --drink: #85532c; }
    .art-pastry { background: linear-gradient(135deg, #b98754, #efd09f); --drink: #b97a38; }

    .card-body {
      padding: 16px 17px 18px;
      display: flex;
      flex-direction: column;
      flex: 1;
    }

    .card-category {
      color: #998c82;
      letter-spacing: 2px;
      font-size: 9px;
      font-weight: 700;
      text-transform: uppercase;
    }

    .card-name {
      font-size: 17px;
      font-weight: 700;
      margin: 5px 0 4px;
      color: var(--ink);
      line-height: 1.3;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .card-desc {
      color: #8c8179;
      font-size: 12px;
      line-height: 1.4;
      min-height: 34px;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .card-bottom {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 7px;
      margin-top: auto;
      padding-top: 12px;
    }

    .price {
      font-size: 15px;
      font-weight: 800;
      color: var(--ink);
      font-variant-numeric: tabular-nums;
    }

    .stock {
      color: var(--green);
      background: var(--green-bg);
      border-radius: 999px;
      padding: 5px 10px;
      font-size: 10px;
      font-weight: 700;
      white-space: nowrap;
    }

    .stock.out {
      color: #b91c1c;
      background: #fee2e2;
    }

    .best-seller {
      position: absolute;
      left: 12px;
      bottom: 12px;
      padding: 6px 11px;
      background: #d7a65a;
      color: #fff;
      border-radius: 999px;
      font-size: 10px;
      font-weight: 700;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
      z-index: 2;
    }

    /* Bottom Navigation Dock */
    .bottom-nav {
      position: fixed;
      z-index: 35;
      left: 50%;
      transform: translateX(-50%);
      bottom: 18px;
      width: min(calc(100% - 36px), 540px);
      height: 74px;
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      padding: 6px;
      border-radius: 25px;
      background: rgba(255, 253, 249, 0.94);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.85);
      box-shadow: 0 16px 45px rgba(54, 35, 22, 0.17);
    }

    .nav-item {
      background: transparent;
      color: #a29a93;
      border-radius: 19px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 3px;
      position: relative;
      text-decoration: none;
      transition: all 0.15s ease;
      padding: 4px 6px;
    }

    .nav-icon {
      width: 24px;
      height: 24px;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
    }

    .nav-icon svg {
      width: 22px;
      height: 22px;
      stroke: currentColor;
      stroke-width: 2.2;
      fill: none;
      stroke-linecap: round;
      stroke-linejoin: round;
      transition: transform 0.15s ease;
    }

    .nav-item small {
      font-size: 11px;
      font-weight: 700;
      letter-spacing: -0.01em;
      line-height: 1;
    }

    .nav-item.active {
      background: #f2e9df;
      color: var(--brown);
    }

    .nav-item.active .nav-icon svg {
      stroke-width: 2.5;
      transform: translateY(-1px);
    }

    .nav-item b {
      position: absolute;
      top: -4px;
      right: -8px;
      width: 17px;
      height: 17px;
      display: grid;
      place-items: center;
      background: var(--brown);
      color: #fff;
      border-radius: 50%;
      font-size: 9px;
      font-weight: 800;
    }

    /* Toast Notification */
    .toast {
      position: fixed;
      z-index: 50;
      left: 50%;
      bottom: 104px;
      transform: translate(-50%, 20px);
      opacity: 0;
      pointer-events: none;
      padding: 12px 20px;
      border-radius: 999px;
      background: var(--ink);
      color: #fff;
      font-size: 12.5px;
      font-weight: 600;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
      transition: all 0.25s ease;
    }

    .toast.show {
      opacity: 1;
      transform: translate(-50%, 0);
    }

    .empty {
      grid-column: 1 / -1;
      text-align: center;
      padding: 60px 20px;
      color: var(--muted);
      font-size: 14px;
    }

    /* Sort / Filter Modal Sheet */
    .sort-modal-backdrop {
      position: fixed;
      inset: 0;
      background: rgba(36, 23, 15, 0.65);
      backdrop-filter: blur(5px);
      -webkit-backdrop-filter: blur(5px);
      z-index: 100;
      display: none;
      align-items: flex-end;
      justify-content: center;
      opacity: 0;
      transition: opacity 0.2s ease;
    }
    .sort-modal-backdrop.show {
      display: flex;
      opacity: 1;
    }
    .sort-modal-sheet {
      width: 100%;
      max-width: 520px;
      background: var(--paper);
      border-radius: 28px 28px 0 0;
      padding: 26px 24px calc(24px + env(safe-area-inset-bottom));
      box-shadow: 0 -20px 40px rgba(36, 23, 15, 0.2);
      transform: translateY(100%);
      transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1);
      border-top: 1px solid rgba(255, 255, 255, 0.8);
    }
    .sort-modal-backdrop.show .sort-modal-sheet {
      transform: translateY(0);
    }
    .sort-modal-top {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 20px;
    }
    .sort-modal-title {
      font-family: "Playfair Display", serif;
      font-size: 20px;
      font-weight: 700;
      color: var(--ink);
    }
    .sort-modal-desc {
      font-size: 13px;
      color: var(--muted);
      margin-top: 2px;
    }
    .sort-close-btn {
      background: #f1e8dd;
      border: none;
      width: 34px;
      height: 34px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      color: var(--ink);
      cursor: pointer;
      line-height: 1;
    }
    .sort-options-list {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }
    .sort-option-item {
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 14px 18px;
      background: #ffffff;
      border: 1.5px solid var(--line);
      border-radius: 18px;
      cursor: pointer;
      transition: all 0.15s ease;
      text-align: left;
    }
    .sort-option-item:hover {
      border-color: var(--brown);
    }
    .sort-option-item.active {
      background: #fbf5ee;
      border-color: var(--brown);
      box-shadow: 0 4px 14px rgba(90, 53, 31, 0.12);
    }
    .sort-option-left {
      display: flex;
      align-items: center;
      gap: 14px;
    }
    .sort-opt-icon {
      width: 40px;
      height: 40px;
      border-radius: 12px;
      background: #f3eae0;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      flex-shrink: 0;
    }
    .sort-opt-name {
      font-size: 14.5px;
      font-weight: 700;
      color: var(--ink);
    }
    .sort-opt-sub {
      font-size: 11.5px;
      color: var(--muted);
      margin-top: 2px;
    }
    .sort-check {
      font-size: 16px;
      font-weight: 800;
      color: var(--brown);
      display: none;
    }
    .sort-option-item.active .sort-check {
      display: block;
    }

    /* Call Waiter Modal */
    .modal-backdrop {
      position: fixed;
      inset: 0;
      background: rgba(36, 23, 15, 0.65);
      backdrop-filter: blur(5px);
      -webkit-backdrop-filter: blur(5px);
      z-index: 100;
      display: none;
      align-items: flex-end;
      justify-content: center;
      opacity: 0;
      transition: opacity 0.2s ease;
    }
    .modal-backdrop.show {
      display: flex;
      opacity: 1;
    }
    .modal-sheet {
      width: 100%;
      max-width: 520px;
      background: var(--paper);
      border-radius: 28px 28px 0 0;
      padding: 26px 24px calc(24px + env(safe-area-inset-bottom));
      box-shadow: 0 -20px 40px rgba(36, 23, 15, 0.25);
      transform: translateY(100%);
      transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1);
      max-height: 90vh;
      overflow-y: auto;
      border-top: 1px solid rgba(255, 255, 255, 0.8);
    }
    .modal-backdrop.show .modal-sheet {
      transform: translateY(0);
    }
    .modal-top {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 18px;
    }
    .modal-title {
      font-family: "Playfair Display", serif;
      font-size: 20px;
      font-weight: 700;
      color: var(--ink);
    }
    .modal-desc {
      font-size: 13px;
      color: var(--muted);
      margin-top: 2px;
    }
    .modal-close-btn {
      background: #f1e8dd;
      border: none;
      width: 34px;
      height: 34px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      color: var(--ink);
      cursor: pointer;
      line-height: 1;
    }
    .modal-table-badge {
      background: #f4ede4;
      border: 1px solid var(--line);
      color: var(--brown);
      padding: 10px 14px;
      border-radius: 14px;
      font-size: 13px;
      font-weight: 700;
      margin-bottom: 16px;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .service-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 10px;
      margin-bottom: 16px;
    }
    .service-opt {
      border: 1.5px solid var(--line);
      border-radius: 14px;
      padding: 13px 10px;
      text-align: center;
      font-size: 12.5px;
      font-weight: 700;
      color: #655950;
      cursor: pointer;
      transition: all 0.15s ease;
      background: #fff;
      user-select: none;
    }
    .service-opt input { display: none; }
    .service-opt.active {
      background: #fbf5ee;
      border-color: var(--brown);
      color: var(--brown);
      box-shadow: 0 0 0 1px var(--brown);
    }
    .service-notes {
      width: 100%;
      padding: 12px 14px;
      border-radius: 14px;
      border: 1px solid var(--line);
      font-family: inherit;
      font-size: 13px;
      outline: none;
      margin-bottom: 20px;
      background: #fff;
      transition: border-color 0.15s ease;
    }
    .service-notes:focus {
      border-color: var(--brown);
    }
    .btn-submit-action {
      width: 100%;
      border: none;
      background: var(--brown);
      color: #ffffff;
      padding: 14px;
      border-radius: 14px;
      font-family: inherit;
      font-size: 14px;
      font-weight: 700;
      cursor: pointer;
      box-shadow: 0 6px 18px rgba(90, 53, 31, 0.25);
      transition: all 0.15s ease;
    }
    .btn-submit-action:hover {
      background: var(--brown-2);
    }
    .btn-submit-action:disabled {
      opacity: 0.6;
      cursor: not-allowed;
    }

    /* Responsive Queries */
    @media (max-width: 980px) {
      .menu-grid {
        grid-template-columns: repeat(3, 1fr);
      }
    }

    @media (max-width: 720px) {
      .topbar {
        padding: 16px 20px 12px;
      }
      .hero {
        margin: 8px 20px 20px;
        padding: 28px 22px;
        min-height: 245px;
      }
      .hero h1 {
        font-size: 34px;
      }
      .hero p {
        font-size: 14px;
      }
      .hero-art {
        opacity: 0.45;
        right: -80px;
        transform: scale(0.85);
      }
      .search-row {
        margin: 0 20px 16px;
      }
      .categories {
        padding: 0 20px;
      }
      .menu-section {
        padding: 24px 20px 0;
      }
      .menu-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
      }
      .product-art {
        height: 155px;
      }
      .card-body {
        padding: 12px;
      }
      .card-name {
        font-size: 15px;
      }
      .price {
        font-size: 14px;
      }
      .stock {
        font-size: 9px;
      }
    }

    @media (max-width: 430px) {
      .brand-name {
        font-size: 18px;
      }
      .brand-sub {
        font-size: 7px;
        letter-spacing: 2px;
      }
      .icon-btn {
        width: 42px;
        height: 42px;
        font-size: 18px;
      }
      .hero {
        border-radius: 24px;
        padding: 24px 18px;
      }
      .hero h1 {
        font-size: 30px;
      }
      .hero p {
        font-size: 13px;
      }
      .menu-section {
        padding-top: 20px;
      }
      .section-heading h2 {
        font-size: 24px;
      }
      .product-art {
        height: 135px;
      }
      .cup-art {
        transform: scale(0.78) translateY(12px);
      }
      .card-desc {
        display: none;
      }
      .card-bottom {
        margin-top: 8px;
      }
    }
  </style>
</head>
<body>

  @php
    $cart = session('cart', []);
    $cartCount = is_array($cart) ? array_sum(array_column($cart, 'qty')) : 0;
  @endphp

  <main class="app-shell">
    <!-- Topbar -->
    <header class="topbar">
      <div class="brand">
        <!-- Official Logo Ruang Seduh (Putih on Dark Slate) -->
        <div class="brand-mark">
          <img src="{{ asset('assets/images/LOGO_RUANG_SEDUH(putih).png') }}" alt="Logo Ruang Seduh">
        </div>
        <div>
          <div class="brand-name">Ruang Seduh</div>
          <div class="brand-sub">COFFEE & ARTISAN BREW</div>
        </div>
      </div>

      <div class="top-actions">
        @if($activeTable)
          <div class="table-pill-top" title="Terhubung ke Meja {{ $activeTable->table_number }}">
            <span class="pulse-dot"></span>
            <span>Meja {{ $activeTable->table_number }}</span>
          </div>
        @endif

        <!-- Panggil Pelayan Button -->
        <button class="icon-btn" id="btnOpenCallWaiter" aria-label="Panggil Pelayan" title="Panggil Pelayan">
          🛎️
        </button>
      </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
      <div class="hero-copy">
        <span class="eyebrow">GOOD COFFEE • GOOD MOOD</span>
        <h1>Kopi yang bikin<br><em>hari lebih baik.</em></h1>
        <p>Ruang untuk jeda, rasa untuk cerita.</p>
      </div>
      <div class="hero-art" aria-hidden="true">
        <div class="steam s1"></div>
        <div class="steam s2"></div>
        <div class="coffee-cup">
          <div class="coffee"></div>
          <div class="latte-art">♥</div>
          <div class="handle"></div>
        </div>
      </div>
    </section>

    <!-- Search & Filter Row -->
    <div class="search-row">
      <label class="search-box">
        <span>⌕</span>
        <input id="searchInput" type="search" placeholder="Cari menu favorit kamu..." autocomplete="off" />
      </label>
      <button class="filter-btn" id="sortBtn" title="Urutkan Menu" aria-label="Urutkan Menu">☷</button>
    </div>

    <!-- Category Filter Pills -->
    <div class="categories" id="categories">
      <button class="category active" data-category="Semua">☕ Semua</button>
      @foreach($categories as $category)
        @php
          $catLower = strtolower($category->name);
          $icon = '🍽️';
          if (str_contains($catLower, 'coffee') || str_contains($catLower, 'kopi')) {
            $icon = '☕';
          } elseif (str_contains($catLower, 'non') || str_contains($catLower, 'drink') || str_contains($catLower, 'minum')) {
            $icon = '🥤';
          } elseif (str_contains($catLower, 'pastry') || str_contains($catLower, 'roti') || str_contains($catLower, 'bakery')) {
            $icon = '🥐';
          } elseif (str_contains($catLower, 'tea') || str_contains($catLower, 'teh')) {
            $icon = '🍵';
          } elseif (str_contains($catLower, 'food') || str_contains($catLower, 'makan') || str_contains($catLower, 'snack')) {
            $icon = '🍟';
          }
        @endphp
        <button class="category" data-category="{{ $category->name }}">{{ $icon }} {{ $category->name }}</button>
      @endforeach
    </div>

    <!-- Menu Section -->
    <section class="menu-section">
      <div class="section-heading">
        <div>
          <span class="section-kicker">OUR SELECTION</span>
          <h2 id="sectionTitle">Semua Menu</h2>
        </div>
        <span class="item-count" id="itemCount">{{ $menus->count() }} item</span>
      </div>

      <!-- Menu Grid -->
      <div class="menu-grid" id="menuGrid">
        @forelse($menus as $menu)
          @php
            $catName = $menu->kategori->name ?? 'Menu';
            $catLower = strtolower($catName);
            $nameLower = strtolower($menu->name);
            
            // Assign art class for fallback cup
            $artClass = 'art-espresso';
            if (str_contains($nameLower, 'americano') || str_contains($nameLower, 'long black')) {
              $artClass = 'art-americano';
            } elseif (str_contains($nameLower, 'cappuccino') || str_contains($nameLower, 'latte')) {
              $artClass = 'art-cappuccino';
            } elseif (str_contains($nameLower, 'mocha')) {
              $artClass = 'art-mocha';
            } elseif (str_contains($nameLower, 'matcha')) {
              $artClass = 'art-matcha';
            } elseif (str_contains($nameLower, 'choco') || str_contains($nameLower, 'coklat')) {
              $artClass = 'art-chocolate';
            } elseif (str_contains($nameLower, 'tea') || str_contains($nameLower, 'teh')) {
              $artClass = 'art-tea';
            } elseif (str_contains($catLower, 'pastry') || str_contains($catLower, 'croissant')) {
              $artClass = 'art-pastry';
            }
          @endphp

          <a href="{{ route('customer.menu.show', $menu->id) }}" class="menu-card" data-name="{{ $nameLower }}" data-category="{{ $catName }}" data-price="{{ $menu->price }}">
            <div class="product-art {{ $artClass }}">
              @if($menu->image)
                <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="product-img" loading="lazy" decoding="async">
              @else
                <div class="cup-art"></div>
              @endif

              @if($loop->index < 2)
                <span class="best-seller">★ Rekomendasi</span>
              @endif
            </div>

            <div class="card-body">
              <span class="card-category">{{ $catName }}</span>
              <h3 class="card-name">{{ $menu->name }}</h3>
              <p class="card-desc">{{ $menu->description ?? 'Dibuat segar dengan racikan istimewa barista Ruang Seduh.' }}</p>

              <div class="card-bottom">
                <span class="price">{{ $menu->hargaRupiah() }}</span>
                <span class="stock {{ $menu->stock > 0 ? '' : 'out' }}">
                  {{ $menu->stock > 0 ? 'Tersedia ' . $menu->stock : 'Habis' }}
                </span>
              </div>
            </div>
          </a>
        @empty
          <div class="empty">
            Belum ada menu yang tersedia.
          </div>
        @endforelse
      </div>
    </section>

    <!-- Bottom Navigation Dock -->
    <nav class="bottom-nav">
      <a href="{{ route('customer.home') }}" class="nav-item active">
        <span class="nav-icon">
          <svg viewBox="0 0 24 24">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
            <polyline points="9 22 9 12 15 12 15 22"></polyline>
          </svg>
        </span>
        <small>Beranda</small>
      </a>

      <a href="{{ route('customer.order.history') }}" class="nav-item">
        <span class="nav-icon">
          <svg viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="12 6 12 12 16 14"></polyline>
          </svg>
        </span>
        <small>Riwayat</small>
      </a>

      <a href="{{ route('customer.cart.index') }}" class="nav-item cart-nav" id="cartNav">
        <span class="nav-icon">
          <svg viewBox="0 0 24 24">
            <circle cx="9" cy="21" r="1"></circle>
            <circle cx="20" cy="21" r="1"></circle>
            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
          </svg>
          <b id="navBadge" style="{{ $cartCount > 0 ? '' : 'display:none;' }}">{{ $cartCount }}</b>
        </span>
        <small>Keranjang</small>
      </a>

      <a href="{{ route('customer.profile.index') }}" class="nav-item">
        <span class="nav-icon">
          <svg viewBox="0 0 24 24">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
            <circle cx="12" cy="7" r="4"></circle>
          </svg>
        </span>
        <small>Profil</small>
      </a>
    </nav>
  </main>

  <!-- Toast Notification -->
  <div class="toast" id="toast"></div>

  <!-- Modal Urutkan / Filter Menu -->
  <div class="sort-modal-backdrop" id="sortModalOverlay">
    <div class="sort-modal-sheet">
      <div class="sort-modal-top">
        <div>
          <h3 class="sort-modal-title">Urutkan Menu</h3>
          <p class="sort-modal-desc">Pilih urutan tampilan menu sesuai seleramu</p>
        </div>
        <button type="button" class="sort-close-btn" id="btnCloseSortModal">&times;</button>
      </div>

      <div class="sort-options-list">
        <button type="button" class="sort-option-item active" data-sort="default">
          <div class="sort-option-left">
            <div class="sort-opt-icon">✨</div>
            <div>
              <div class="sort-opt-name">Rekomendasi / Default</div>
              <div class="sort-opt-sub">Urutan bawaan menu Ruang Seduh</div>
            </div>
          </div>
          <span class="sort-check">✓</span>
        </button>

        <button type="button" class="sort-option-item" data-sort="price_asc">
          <div class="sort-option-left">
            <div class="sort-opt-icon">↗️</div>
            <div>
              <div class="sort-opt-name">Harga: Termurah ke Tertinggi</div>
              <div class="sort-opt-sub">Mulai dari harga yang paling hemat</div>
            </div>
          </div>
          <span class="sort-check">✓</span>
        </button>

        <button type="button" class="sort-option-item" data-sort="price_desc">
          <div class="sort-option-left">
            <div class="sort-opt-icon">↘️</div>
            <div>
              <div class="sort-opt-name">Harga: Tertinggi ke Termurah</div>
              <div class="sort-opt-sub">Menu istimewa & racikan premium</div>
            </div>
          </div>
          <span class="sort-check">✓</span>
        </button>

        <button type="button" class="sort-option-item" data-sort="name_asc">
          <div class="sort-option-left">
            <div class="sort-opt-icon">🔤</div>
            <div>
              <div class="sort-opt-name">Nama: A ke Z</div>
              <div class="sort-opt-sub">Urutkan berdasarkan abjad menu</div>
            </div>
          </div>
          <span class="sort-check">✓</span>
        </button>
      </div>
    </div>
  </div>

  <!-- Modal Panggil Pelayan -->
  <div class="modal-backdrop" id="callModalOverlay">
    <div class="modal-sheet">
      <div class="modal-top">
        <div>
          <h3 class="modal-title">🛎️ Panggil Pelayan</h3>
          <p class="modal-desc">Butuh bantuan staf? Kami siap melayani mejamu.</p>
        </div>
        <button type="button" class="modal-close-btn" id="btnCloseCallModal">&times;</button>
      </div>

      <form id="callWaiterForm">
        @csrf
        @if($activeTable)
          <input type="hidden" name="table_id" value="{{ $activeTable->id }}">
          <div class="modal-table-badge">
            📍 Meja Terhubung: <strong>Meja {{ $activeTable->table_number }}</strong>
          </div>
        @else
          <div class="modal-table-badge" style="background: #fff1f2; border-color: #fecdd3; color: #9f1239;">
            ⚠️ Kamu belum terhubung ke meja. Silakan scan QR code di mejamu untuk memesan atau memanggil pelayan.
          </div>
        @endif

        <div style="margin-bottom: 14px;">
          <label style="display:block; font-size: 12.5px; font-weight: 700; margin-bottom: 8px; color: var(--ink);">Pilih Kebutuhan:</label>
          <div class="service-grid">
            <label class="service-opt active">
              <input type="radio" name="type" value="panggil_pelayan" checked>
              <span>🙋 Bantuan Pelayan</span>
            </label>
            <label class="service-opt">
              <input type="radio" name="type" value="minta_bill">
              <span>🧾 Minta Bill / Nota</span>
            </label>
            <label class="service-opt">
              <input type="radio" name="type" value="minta_air">
              <span>💧 Air Putih / Es</span>
            </label>
            <label class="service-opt">
              <input type="radio" name="type" value="bersih_meja">
              <span>🧹 Bersihkan Meja</span>
            </label>
          </div>
        </div>

        <div>
          <label style="display:block; font-size: 12.5px; font-weight: 700; margin-bottom: 6px; color: var(--ink);">Catatan Tambahan (Opsional):</label>
          <input type="text" name="notes" class="service-notes" placeholder="Contoh: Minta tissue atau sedotan tambahan..." maxlength="150">
        </div>

        <button type="submit" class="btn-submit-action" id="btnSubmitCall" {{ $activeTable ? '' : 'disabled' }}>
          {{ $activeTable ? 'Kirim Panggilan 🛎️' : 'Scan QR Meja Dulu' }}
        </button>
      </form>

      <div id="callSuccessState" style="display:none; text-align:center; padding: 24px 10px;">
        <div style="font-size: 44px; margin-bottom: 8px;">🏃💨</div>
        <h4 style="font-size: 18px; font-weight: 800; margin-bottom: 4px; color: var(--ink);">Panggilan Terkirim!</h4>
        <p style="font-size: 13px; color: var(--muted); margin-bottom: 20px;">Staf kami sedang menuju ke mejamu. Mohon ditunggu ya!</p>
        <button type="button" class="btn-submit-action" id="btnCloseSuccess">Selesai</button>
      </div>
    </div>
  </div>

  <script>
    (function() {
      const grid = document.getElementById('menuGrid');
      const sectionTitle = document.getElementById('sectionTitle');
      const itemCount = document.getElementById('itemCount');
      const searchInput = document.getElementById('searchInput');
      const toast = document.getElementById('toast');
      const categories = document.getElementById('categories');
      const cards = Array.from(document.querySelectorAll('#menuGrid .menu-card'));

      // Store initial index for default sort order restoration
      cards.forEach((card, idx) => {
        card.dataset.origIndex = idx;
      });

      function showToast(msg) {
        if (!toast) return;
        toast.textContent = msg;
        toast.classList.add('show');
        setTimeout(() => toast.classList.remove('show'), 2500);
      }

      function filterMenus() {
        const activeBtn = categories.querySelector('.category.active');
        const activeCategory = activeBtn ? activeBtn.dataset.category : 'Semua';
        const keyword = searchInput.value.trim().toLowerCase();

        let visibleCount = 0;

        cards.forEach(card => {
          const name = card.dataset.name || '';
          const category = card.dataset.category || '';

          const matchCat = (activeCategory === 'Semua') || (category === activeCategory);
          const matchKey = !keyword || name.includes(keyword);

          if (matchCat && matchKey) {
            card.style.display = '';
            visibleCount++;
          } else {
            card.style.display = 'none';
          }
        });

        sectionTitle.textContent = activeCategory === 'Semua' ? 'Semua Menu' : activeCategory;
        itemCount.textContent = visibleCount + ' item';

        let emptyElem = grid.querySelector('.empty');
        if (visibleCount === 0) {
          if (!emptyElem) {
            emptyElem = document.createElement('div');
            emptyElem.className = 'empty';
            emptyElem.textContent = 'Menu yang kamu cari tidak ditemukan.';
            grid.appendChild(emptyElem);
          }
        } else if (emptyElem && emptyElem.parentNode) {
          emptyElem.remove();
        }
      }

      // Category Pill Click
      categories?.addEventListener('click', function(e) {
        const btn = e.target.closest('.category');
        if (!btn) return;

        categories.querySelectorAll('.category').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        filterMenus();
      });

      // Search Input
      searchInput?.addEventListener('input', filterMenus);

      // Sort / Filter Modal Logic
      const sortBtn = document.getElementById('sortBtn');
      const sortModalOverlay = document.getElementById('sortModalOverlay');
      const btnCloseSortModal = document.getElementById('btnCloseSortModal');
      const sortOptionItems = document.querySelectorAll('.sort-option-item');

      function openSortModal() {
        if (sortModalOverlay) sortModalOverlay.classList.add('show');
      }
      function closeSortModal() {
        if (sortModalOverlay) sortModalOverlay.classList.remove('show');
      }

      sortBtn?.addEventListener('click', openSortModal);
      btnCloseSortModal?.addEventListener('click', closeSortModal);
      sortModalOverlay?.addEventListener('click', function(e) {
        if (e.target === sortModalOverlay) closeSortModal();
      });

      sortOptionItems.forEach(item => {
        item.addEventListener('click', function() {
          const sortMode = this.dataset.sort;

          sortOptionItems.forEach(i => i.classList.remove('active'));
          this.classList.add('active');

          if (sortMode === 'price_asc') {
            cards.sort((a, b) => (parseFloat(a.dataset.price) || 0) - (parseFloat(b.dataset.price) || 0));
            showToast('Urutan: Harga Termurah ↗');
          } else if (sortMode === 'price_desc') {
            cards.sort((a, b) => (parseFloat(b.dataset.price) || 0) - (parseFloat(a.dataset.price) || 0));
            showToast('Urutan: Harga Tertinggi ↘');
          } else if (sortMode === 'name_asc') {
            cards.sort((a, b) => (a.dataset.name || '').localeCompare(b.dataset.name || ''));
            showToast('Urutan: Nama A ke Z 🔤');
          } else {
            cards.sort((a, b) => (parseInt(a.dataset.origIndex) || 0) - (parseInt(b.dataset.origIndex) || 0));
            showToast('Urutan: Rekomendasi / Default ✨');
          }

          cards.forEach(card => grid.appendChild(card));
          filterMenus();
          closeSortModal();
        });
      });

      // Call Waiter Modal
      const btnOpenCall = document.getElementById('btnOpenCallWaiter');
      const modalOverlay = document.getElementById('callModalOverlay');
      const btnCloseModal = document.getElementById('btnCloseCallModal');
      const btnCloseSuccess = document.getElementById('btnCloseSuccess');
      const callForm = document.getElementById('callWaiterForm');
      const callSuccess = document.getElementById('callSuccessState');
      const btnSubmitCall = document.getElementById('btnSubmitCall');

      function openModal() {
        modalOverlay.classList.add('show');
        if (callForm) callForm.style.display = '';
        if (callSuccess) callSuccess.style.display = 'none';
      }

      function closeModal() {
        modalOverlay.classList.remove('show');
      }

      btnOpenCall?.addEventListener('click', openModal);
      btnCloseModal?.addEventListener('click', closeModal);
      btnCloseSuccess?.addEventListener('click', closeModal);
      modalOverlay?.addEventListener('click', function(e) {
        if (e.target === modalOverlay) closeModal();
      });

      const serviceOpts = document.querySelectorAll('.service-opt');
      serviceOpts.forEach(opt => {
        opt.addEventListener('click', () => {
          serviceOpts.forEach(o => o.classList.remove('active'));
          opt.classList.add('active');
        });
      });

      callForm?.addEventListener('submit', function(e) {
        e.preventDefault();
        btnSubmitCall.disabled = true;
        btnSubmitCall.textContent = 'Mengirim...';

        const formData = new FormData(callForm);
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
            callForm.style.display = 'none';
            callSuccess.style.display = 'block';
          } else {
            alert(data.message || 'Gagal mengirim panggilan.');
          }
        })
        .catch(() => {
          btnSubmitCall.disabled = false;
          btnSubmitCall.textContent = 'Kirim Panggilan 🛎️';
          alert('Terjadi kendala koneksi.');
        });
      });
    })();
  </script>

  <!-- Web Push Real-Time Notifications -->
  @include('customer.include.order_notifications')
</body>
</html>