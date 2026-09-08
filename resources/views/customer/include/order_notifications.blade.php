<!-- Ruang Seduh Real-Time Order Notifications (System Web Push & In-App Toast) -->
<style>
  /* Permission Prompt Banner */
  .rs-notify-prompt {
    position: fixed;
    top: 16px;
    left: 50%;
    transform: translateX(-50%);
    width: calc(100% - 32px);
    max-width: 440px;
    background: #0f172a;
    color: #ffffff;
    padding: 14px 16px;
    border-radius: 18px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
    z-index: 9999;
    display: none;
    animation: rsSlideDown 0.35s cubic-bezier(0.16, 1, 0.3, 1);
  }
  .rs-notify-prompt-content {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 12px;
  }
  .rs-notify-prompt-icon {
    font-size: 24px;
    line-height: 1;
  }
  .rs-notify-prompt-text {
    flex: 1;
  }
  .rs-notify-prompt-text strong {
    display: block;
    font-size: 13.5px;
    font-weight: 700;
    margin-bottom: 2px;
    color: #f8fafc;
  }
  .rs-notify-prompt-text span {
    font-size: 11.5px;
    color: #94a3b8;
    line-height: 1.4;
    display: block;
  }
  .rs-notify-prompt-actions {
    display: flex;
    justify-content: flex-end;
    gap: 8px;
  }
  .rs-notify-btn-dismiss {
    background: transparent;
    border: none;
    color: #94a3b8;
    font-size: 12px;
    font-weight: 600;
    padding: 6px 12px;
    border-radius: 8px;
    cursor: pointer;
  }
  .rs-notify-btn-allow {
    background: #ffffff;
    border: none;
    color: #0f172a;
    font-size: 12px;
    font-weight: 700;
    padding: 6px 14px;
    border-radius: 8px;
    cursor: pointer;
  }

  /* In-App Toast Notification */
  .rs-in-app-toast {
    position: fixed;
    top: 16px;
    left: 50%;
    transform: translateX(-50%);
    width: calc(100% - 32px);
    max-width: 440px;
    background: #ffffff;
    border: 1.5px solid #0f172a;
    border-radius: 18px;
    padding: 12px 14px;
    box-shadow: 0 12px 36px rgba(15, 23, 42, 0.2);
    z-index: 10000;
    display: none;
    align-items: center;
    gap: 12px;
    animation: rsSlideDown 0.35s cubic-bezier(0.16, 1, 0.3, 1);
  }
  .rs-toast-icon {
    font-size: 26px;
    flex-shrink: 0;
  }
  .rs-toast-body {
    flex: 1;
    min-width: 0;
  }
  .rs-toast-title {
    font-size: 13px;
    font-weight: 800;
    color: #0f172a;
    line-height: 1.3;
  }
  .rs-toast-desc {
    font-size: 11.5px;
    color: #64748b;
    margin-top: 2px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  .rs-toast-action {
    background: #0f172a;
    color: #ffffff;
    text-decoration: none;
    font-size: 11.5px;
    font-weight: 700;
    padding: 6px 12px;
    border-radius: 999px;
    flex-shrink: 0;
    display: inline-block;
  }

  @keyframes rsSlideDown {
    from {
      opacity: 0;
      transform: translate(-50%, -24px);
    }
    to {
      opacity: 1;
      transform: translate(-50%, 0);
    }
  }
</style>

<!-- Banner Prompt Izin Notifikasi -->
<div id="rsNotificationPrompt" class="rs-notify-prompt">
  <div class="rs-notify-prompt-content">
    <div class="rs-notify-prompt-icon">🔔</div>
    <div class="rs-notify-prompt-text">
      <strong>Notifikasi Pesanan HP</strong>
      <span>Izinkan notifikasi agar kamu tahu saat pesananmu siap saji, meski sedang buka aplikasi lain atau layar HP dikunci.</span>
    </div>
  </div>
  <div class="rs-notify-prompt-actions">
    <button type="button" class="rs-notify-btn-dismiss" id="btnDismissNotify">Nanti</button>
    <button type="button" class="rs-notify-btn-allow" id="btnAllowNotify">Aktifkan Notifikasi</button>
  </div>
</div>

<!-- In-App Toast Dropdown -->
<div id="rsInAppToast" class="rs-in-app-toast">
  <div class="rs-toast-icon" id="rsToastIcon">🍽️</div>
  <div class="rs-toast-body">
    <div class="rs-toast-title" id="rsToastTitle">Pesanan Siap Disajikan!</div>
    <div class="rs-toast-desc" id="rsToastDesc">Pesanan di Mejamu sudah siap.</div>
  </div>
  <a href="#" class="rs-toast-action" id="rsToastLink">Lihat</a>
</div>

<script>
(function() {
  const CHECK_URL = "{{ route('customer.orders.active-status') }}";
  const LOGO_URL = "{{ asset('assets/images/LOGO_RUANG_SEDUH(coklat).png') }}";
  const CURRENT_PAGE_ORDER_ID = typeof RS_CURRENT_ORDER_ID !== 'undefined' ? RS_CURRENT_ORDER_ID : null;

  let swRegistration = null;

  // 1. Register Service Worker for background system notifications
  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/sw.js')
      .then(reg => {
        swRegistration = reg;
      })
      .catch(err => {
        console.warn('Service worker registration failed:', err);
      });
  }

  // 2. Pleasant Web Audio Chime Sound (Ding-Dong)
  function playNotificationChime() {
    try {
      const AudioCtx = window.AudioContext || window.webkitAudioContext;
      if (!AudioCtx) return;
      const ctx = new AudioCtx();
      const now = ctx.currentTime;

      // Note 1 (E5 = 659.25Hz)
      const osc1 = ctx.createOscillator();
      const gain1 = ctx.createGain();
      osc1.type = 'sine';
      osc1.frequency.setValueAtTime(659.25, now);
      gain1.gain.setValueAtTime(0.2, now);
      gain1.gain.exponentialRampToValueAtTime(0.001, now + 0.35);
      osc1.connect(gain1);
      gain1.connect(ctx.destination);
      osc1.start(now);
      osc1.stop(now + 0.35);

      // Note 2 (G#5 = 830.61Hz)
      const osc2 = ctx.createOscillator();
      const gain2 = ctx.createGain();
      osc2.type = 'sine';
      osc2.frequency.setValueAtTime(830.61, now + 0.16);
      gain2.gain.setValueAtTime(0.22, now + 0.16);
      gain2.gain.exponentialRampToValueAtTime(0.001, now + 0.65);
      osc2.connect(gain2);
      gain2.connect(ctx.destination);
      osc2.start(now + 0.16);
      osc2.stop(now + 0.65);
    } catch (e) {}
  }

  // 3. Trigger Haptic Vibration on Phones
  function triggerVibrate() {
    if ('vibrate' in navigator) {
      try {
        navigator.vibrate([250, 100, 250, 100, 250]);
      } catch (e) {}
    }
  }

  // 4. Show In-App Toast
  const toastElem = document.getElementById('rsInAppToast');
  const toastIcon = document.getElementById('rsToastIcon');
  const toastTitle = document.getElementById('rsToastTitle');
  const toastDesc = document.getElementById('rsToastDesc');
  const toastLink = document.getElementById('rsToastLink');
  let toastTimer = null;

  function showInAppToast(icon, title, desc, url) {
    if (!toastElem) return;
    toastIcon.textContent = icon;
    toastTitle.textContent = title;
    toastDesc.textContent = desc;
    toastLink.href = url;
    toastElem.style.display = 'flex';

    if (toastTimer) clearTimeout(toastTimer);
    toastTimer = setTimeout(() => {
      toastElem.style.display = 'none';
    }, 7000);
  }

  // 5. Trigger System Notification (Works even when user is outside web / tab minimized)
  function showSystemNotification(icon, title, body, targetUrl, orderId, status) {
    playNotificationChime();
    triggerVibrate();
    showInAppToast(icon, title, body, targetUrl);

    if (!('Notification' in window)) return;

    if (Notification.permission === 'granted') {
      const options = {
        body: body,
        icon: LOGO_URL,
        badge: LOGO_URL,
        vibrate: [250, 100, 250, 100, 250],
        tag: 'rs-order-' + orderId + '-' + status,
        renotify: true,
        data: { url: targetUrl }
      };

      if (swRegistration && swRegistration.showNotification) {
        swRegistration.showNotification(title, options);
      } else {
        try {
          const notif = new Notification(title, options);
          notif.onclick = function() {
            window.focus();
            window.location.href = targetUrl;
          };
        } catch (e) {
          console.warn('Standard Notification creation error:', e);
        }
      }
    }
  }

  // 6. Manage Notification Permission Prompt
  const promptElem = document.getElementById('rsNotificationPrompt');
  const btnAllow = document.getElementById('btnAllowNotify');
  const btnDismiss = document.getElementById('btnDismissNotify');

  function checkPermissionPrompt(hasActiveOrders) {
    if (!('Notification' in window)) return;
    const dismissed = sessionStorage.getItem('rs_notify_dismissed');

    if (Notification.permission === 'default' && !dismissed && hasActiveOrders) {
      if (promptElem) promptElem.style.display = 'block';
    } else {
      if (promptElem) promptElem.style.display = 'none';
    }
  }

  btnAllow?.addEventListener('click', function() {
    if ('Notification' in window) {
      Notification.requestPermission().then(permission => {
        if (promptElem) promptElem.style.display = 'none';
        if (permission === 'granted') {
          playNotificationChime();
          showSystemNotification(
            '🔔',
            'Notifikasi Aktif!',
            'Kamu akan menerima pemberitahuan langsung di HP saat pesanan disiapkan dan siap disajikan.',
            window.location.href,
            'welcome',
            'init'
          );
        }
      });
    }
  });

  btnDismiss?.addEventListener('click', function() {
    sessionStorage.setItem('rs_notify_dismissed', 'true');
    if (promptElem) promptElem.style.display = 'none';
  });

  // 7. Order Status Checker & Notification Trigger
  const STATUS_DETAILS = {
    'diproses': {
      icon: '☕',
      title: 'Pesanan Sedang Disiapkan!',
      body: (ord) => `Barista sedang menyiapkan Pesanan #${ord.order_number} untuk Meja ${ord.table_number}.`
    },
    'siap_disajikan': {
      icon: '🍽️',
      title: 'Pesanan Siap Disajikan!',
      body: (ord) => `Pesanan #${ord.order_number} untuk Meja ${ord.table_number} sudah siap disajikan! Klik untuk melihat.`
    },
    'selesai': {
      icon: '✨',
      title: 'Pesanan Selesai!',
      body: (ord) => `Pesanan #${ord.order_number} telah selesai. Terima kasih telah berkunjung ke Ruang Seduh!`
    },
    'dibatalkan': {
      icon: '⚠️',
      title: 'Pesanan Dibatalkan',
      body: (ord) => `Pesanan #${ord.order_number} di Meja ${ord.table_number} dibatalkan oleh kasir/staf.`
    }
  };

  function checkOrderStatusUpdates() {
    fetch(CHECK_URL, {
      headers: {
        'Accept': 'application/json'
      }
    })
    .then(res => {
      if (!res.ok) throw new Error('HTTP ' + res.status);
      return res.json();
    })
    .then(data => {
      if (!data.success || !Array.isArray(data.orders)) return;

      const activeOrders = data.orders.filter(o => ['menunggu_konfirmasi', 'diproses', 'siap_disajikan'].includes(o.status));
      checkPermissionPrompt(activeOrders.length > 0 || CURRENT_PAGE_ORDER_ID !== null);

      data.orders.forEach(order => {
        const storageKey = 'rs_order_status_' + order.id;
        const previousStatus = localStorage.getItem(storageKey);

        if (previousStatus === null) {
          // First time seeing this order in this browser session - seed without triggering alert
          localStorage.setItem(storageKey, order.status);
        } else if (previousStatus !== order.status) {
          // Status has changed! Save immediately
          localStorage.setItem(storageKey, order.status);

          const detail = STATUS_DETAILS[order.status];
          if (detail) {
            const bodyText = detail.body(order);
            showSystemNotification(
              detail.icon,
              detail.icon + ' ' + detail.title,
              bodyText,
              order.detail_url,
              order.id,
              order.status
            );

            // If user is currently looking at this order's detail page, refresh/update stage
            if (CURRENT_PAGE_ORDER_ID && CURRENT_PAGE_ORDER_ID == order.id) {
              setTimeout(() => {
                window.location.reload();
              }, 1200);
            }
          }
        }
      });
    })
    .catch(err => {
      // Silent catch network hiccup
    });
  }

  // Initial check on load
  checkOrderStatusUpdates();

  // Background polling every 4 seconds
  setInterval(checkOrderStatusUpdates, 4000);

  // Check immediately when user brings the tab back to focus / unlocks screen
  document.addEventListener('visibilitychange', function() {
    if (document.visibilityState === 'visible') {
      checkOrderStatusUpdates();
    }
  });
})();
</script>
