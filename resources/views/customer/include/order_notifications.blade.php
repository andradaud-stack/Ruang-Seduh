<!-- Ruang Seduh Real-Time Order Notifications (VAPID Mobile Web Push & In-App Toast) -->
<style>
  /* Permission Prompt Banner */
  .rs-notify-prompt {
    position: fixed;
    top: 16px;
    left: 50%;
    transform: translateX(-50%);
    width: calc(100% - 32px);
    max-width: 440px;
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    color: #ffffff;
    padding: 14px 16px;
    border-radius: 18px;
    box-shadow: 0 14px 40px rgba(0, 0, 0, 0.35);
    border: 1px solid rgba(255, 255, 255, 0.1);
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
    font-size: 26px;
    line-height: 1;
    animation: rsBellShake 2.5s infinite;
  }
  @keyframes rsBellShake {
    0%, 80%, 100% { transform: rotate(0); }
    85% { transform: rotate(14deg); }
    90% { transform: rotate(-14deg); }
    95% { transform: rotate(8deg); }
  }
  .rs-notify-prompt-text {
    flex: 1;
  }
  .rs-notify-prompt-text strong {
    display: block;
    font-size: 13.5px;
    font-weight: 700;
    margin-bottom: 3px;
    color: #f8fafc;
  }
  .rs-notify-prompt-text span {
    font-size: 11.5px;
    color: #cbd5e1;
    line-height: 1.45;
    display: block;
  }
  .rs-notify-prompt-actions {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 8px;
  }
  .rs-notify-btn-dismiss {
    background: transparent;
    border: none;
    color: #94a3b8;
    font-size: 12px;
    font-weight: 600;
    padding: 7px 12px;
    border-radius: 8px;
    cursor: pointer;
  }
  .rs-notify-btn-allow {
    background: #ffffff;
    border: none;
    color: #0f172a;
    font-size: 12px;
    font-weight: 800;
    padding: 7px 16px;
    border-radius: 10px;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: transform 0.15s ease;
  }
  .rs-notify-btn-allow:active {
    transform: scale(0.96);
  }

  /* Floating Enable Bell Button (When banner dismissed but notifications still disabled) */
  .rs-notify-floating-btn {
    position: fixed;
    bottom: 24px;
    right: 20px;
    z-index: 999;
    background: #0f172a;
    color: #ffffff;
    border: 1.5px solid rgba(255, 255, 255, 0.2);
    border-radius: 999px;
    padding: 8px 14px 8px 10px;
    display: none;
    align-items: center;
    gap: 8px;
    font-size: 12px;
    font-weight: 700;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
    cursor: pointer;
    animation: rsBounceIn 0.4s ease;
  }
  .rs-notify-floating-btn span.bell {
    font-size: 16px;
    animation: rsBellShake 3s infinite;
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

  @keyframes rsBounceIn {
    from {
      opacity: 0;
      transform: scale(0.8);
    }
    to {
      opacity: 1;
      transform: scale(1);
    }
  }
</style>

<!-- Banner Prompt Izin Notifikasi HP -->
<div id="rsNotificationPrompt" class="rs-notify-prompt">
  <div class="rs-notify-prompt-content">
    <div class="rs-notify-prompt-icon">🔔</div>
    <div class="rs-notify-prompt-text">
      <strong>Notifikasi HP (Seperti Notif WA / Web)</strong>
      <span>Izinkan notifikasi agar kamu tahu saat pesanan diproses atau siap disajikan, meskipun sedang membuka aplikasi lain atau layar HP dikunci.</span>
    </div>
  </div>
  <div class="rs-notify-prompt-actions">
    <button type="button" class="rs-notify-btn-dismiss" id="btnDismissNotify">Nanti</button>
    <button type="button" class="rs-notify-btn-allow" id="btnAllowNotify">
      <span>🔔 Aktifkan Notifikasi</span>
    </button>
  </div>
</div>

<!-- Floating Bell Button -->
<div id="rsNotifyFloatBtn" class="rs-notify-floating-btn">
  <span class="bell">🔔</span>
  <span>Aktifkan Notif HP</span>
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
  const VAPID_KEY_URL = "{{ route('customer.vapid.key') }}";
  const SUBSCRIBE_URL = "{{ route('customer.push.subscribe') }}";
  const CSRF_TOKEN = "{{ csrf_token() }}";
  const LOGO_URL = "{{ asset('assets/images/LOGO_RUANG_SEDUH(coklat).png') }}";
  const CURRENT_PAGE_ORDER_ID = typeof RS_CURRENT_ORDER_ID !== 'undefined' ? RS_CURRENT_ORDER_ID : null;

  let swRegistration = null;

  // 1. Helper: Convert base64 VAPID public key to Uint8Array
  function urlBase64ToUint8Array(base64String) {
    const padding = '='.repeat((4 - (base64String.length % 4)) % 4);
    const base64 = (base64String + padding)
      .replace(/-/g, '+')
      .replace(/_/g, '/');

    const rawData = window.atob(base64);
    const outputArray = new Uint8Array(rawData.length);

    for (let i = 0; i < rawData.length; ++i) {
      outputArray[i] = rawData.charCodeAt(i);
    }
    return outputArray;
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

  // 3. Trigger Haptic Vibration on Mobile
  function triggerVibrate() {
    if ('vibrate' in navigator) {
      try {
        navigator.vibrate([300, 150, 300, 150, 300]);
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
    toastLink.href = url || '#';
    toastElem.style.display = 'flex';

    if (toastTimer) clearTimeout(toastTimer);
    toastTimer = setTimeout(() => {
      toastElem.style.display = 'none';
    }, 7000);
  }

  // 5. Subscribe to Native Web Push (VAPID)
  async function subscribeToPush(sendTestNotification = false) {
    if (!('serviceWorker' in navigator) || !('PushManager' in window)) {
      console.log('Push messaging is not supported in this browser.');
      return false;
    }

    try {
      const reg = swRegistration || (await navigator.serviceWorker.ready);
      if (!reg) return false;

      // 1. Fetch public VAPID key
      const keyRes = await fetch(VAPID_KEY_URL, { headers: { 'Accept': 'application/json' } });
      const keyData = await keyRes.json();
      const publicKey = keyData.publicKey;

      if (!publicKey) {
        console.warn('VAPID public key not found.');
        return false;
      }

      const convertedKey = urlBase64ToUint8Array(publicKey);

      // 2. Subscribe with PushManager
      let subscription = await reg.pushManager.getSubscription();
      if (!subscription) {
        subscription = await reg.pushManager.subscribe({
          userVisibleOnly: true,
          applicationServerKey: convertedKey
        });
      }

      const subData = subscription.toJSON();

      // 3. Send subscription to server
      const saveRes = await fetch(SUBSCRIBE_URL, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': CSRF_TOKEN,
          'Accept': 'application/json'
        },
        body: JSON.stringify({
          endpoint: subData.endpoint,
          keys: subData.keys,
          test: sendTestNotification
        })
      });

      const resJson = await saveRes.json();
      return resJson.success;
    } catch (err) {
      console.warn('Push subscription error:', err);
      return false;
    }
  }

  // 6. Manage Service Worker & Permission UI
  const promptElem = document.getElementById('rsNotificationPrompt');
  const floatBtn = document.getElementById('rsNotifyFloatBtn');
  const btnAllow = document.getElementById('btnAllowNotify');
  const btnDismiss = document.getElementById('btnDismissNotify');

  function updatePermissionUI() {
    if (!('Notification' in window)) {
      if (promptElem) promptElem.style.display = 'none';
      if (floatBtn) floatBtn.style.display = 'none';
      return;
    }

    if (Notification.permission === 'granted') {
      if (promptElem) promptElem.style.display = 'none';
      if (floatBtn) floatBtn.style.display = 'none';
      // Automatically ensure push subscription is synced with current customer
      subscribeToPush(false);
    } else if (Notification.permission === 'default') {
      const dismissed = sessionStorage.getItem('rs_notify_dismissed');
      if (!dismissed) {
        if (promptElem) promptElem.style.display = 'block';
        if (floatBtn) floatBtn.style.display = 'none';
      } else {
        if (promptElem) promptElem.style.display = 'none';
        if (floatBtn) floatBtn.style.display = 'flex';
      }
    } else {
      // Permission denied
      if (promptElem) promptElem.style.display = 'none';
      if (floatBtn) floatBtn.style.display = 'none';
    }
  }

  async function handleAllowNotifications() {
    if (!('Notification' in window)) {
      alert('Browser perangkat ini tidak mendukung fitur notifikasi.');
      return;
    }

    try {
      const permission = await Notification.requestPermission();
      if (promptElem) promptElem.style.display = 'none';
      if (floatBtn) floatBtn.style.display = 'none';

      if (permission === 'granted') {
        playNotificationChime();
        triggerVibrate();
        showInAppToast('🔄', 'Mengaktifkan Notifikasi...', 'Sedang mendaftarkan HP ke sistem push...', '#');

        const success = await subscribeToPush(true);
        if (success) {
          showInAppToast('✅', 'Notifikasi HP Aktif!', 'Pemberitahuan uji coba baru saja dikirim ke status bar HP kamu.', '#');
        } else {
          showInAppToast('🔔', 'Notifikasi Aktif!', 'Kamu akan menerima notifikasi saat status pesanan berubah.', '#');
        }
      } else if (permission === 'denied') {
        alert('Izin notifikasi diblokir di browsermu. Untuk mengaktifkannya, buka info situs (ikon gembok di sebelah alamat web) lalu izinkan Notifikasi.');
      }
    } catch (e) {
      console.warn('Error requesting notification permission:', e);
    }
  }

  btnAllow?.addEventListener('click', handleAllowNotifications);
  floatBtn?.addEventListener('click', handleAllowNotifications);

  btnDismiss?.addEventListener('click', function() {
    sessionStorage.setItem('rs_notify_dismissed', 'true');
    if (promptElem) promptElem.style.display = 'none';
    if (floatBtn) floatBtn.style.display = 'flex';
  });

  // 7. Register Service Worker on Load
  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/sw.js', { scope: '/' })
      .then(reg => {
        swRegistration = reg;
        updatePermissionUI();
      })
      .catch(err => {
        console.warn('Service worker registration failed:', err);
        updatePermissionUI();
      });
  } else {
    updatePermissionUI();
  }

  // 8. Order Status Checker & Foreground Notification Trigger
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

      data.orders.forEach(order => {
        const storageKey = 'rs_order_status_' + order.id;
        const previousStatus = localStorage.getItem(storageKey);

        if (previousStatus === null) {
          // First time seeing this order in this session
          localStorage.setItem(storageKey, order.status);
        } else if (previousStatus !== order.status) {
          // Status has changed! Save immediately
          localStorage.setItem(storageKey, order.status);

          const detail = STATUS_DETAILS[order.status];
          if (detail) {
            playNotificationChime();
            triggerVibrate();
            showInAppToast(
              detail.icon,
              detail.icon + ' ' + detail.title,
              detail.body(order),
              order.detail_url
            );

            // If user is currently looking at this order's detail page, refresh to update stage
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

  // Polling every 4 seconds when tab is active
  setInterval(checkOrderStatusUpdates, 4000);

  // Check immediately when user brings the tab back to focus / unlocks screen
  document.addEventListener('visibilitychange', function() {
    if (document.visibilityState === 'visible') {
      checkOrderStatusUpdates();
    }
  });
})();
</script>
