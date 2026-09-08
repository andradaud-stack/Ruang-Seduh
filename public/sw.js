// Service Worker for Ruang Seduh Web Push Notifications
const SW_VERSION = 'rs-sw-v2';

self.addEventListener('install', function(event) {
  self.skipWaiting();
});

self.addEventListener('activate', function(event) {
  event.waitUntil(self.clients.claim());
});

// 1. Handle incoming Web Push from server (VAPID / FCM)
self.addEventListener('push', function(event) {
  let data = {};
  if (event.data) {
    try {
      data = event.data.json();
    } catch (e) {
      data = {
        title: '☕ Ruang Seduh Coffee',
        body: event.data.text()
      };
    }
  }

  const title = data.title || '☕ Ruang Seduh Coffee';
  const options = {
    body: data.body || 'Ada pembaruan status pesananmu!',
    icon: data.icon || '/assets/images/LOGO_RUANG_SEDUH(coklat).png',
    badge: data.badge || '/assets/images/LOGO_RUANG_SEDUH(coklat).png',
    tag: data.tag || ('rs-order-' + Date.now()),
    renotify: true,
    requireInteraction: true,
    vibrate: [300, 150, 300, 150, 300],
    data: {
      url: data.url || '/customer/order/history'
    }
  };

  event.waitUntil(
    self.registration.showNotification(title, options)
  );
});

// 2. Handle notification click to navigate or focus on the order detail page
self.addEventListener('notificationclick', function(event) {
  event.notification.close();

  const targetUrl = (event.notification.data && event.notification.data.url)
    ? event.notification.data.url
    : '/customer/order/history';

  event.waitUntil(
    clients.matchAll({ type: 'window', includeUncontrolled: true }).then(function(clientList) {
      for (let i = 0; i < clientList.length; i++) {
        const client = clientList[i];
        if (client.url && client.url.includes('/customer/') && 'focus' in client) {
          client.navigate(targetUrl);
          return client.focus();
        }
      }
      if (clients.openWindow) {
        return clients.openWindow(targetUrl);
      }
    })
  );
});
