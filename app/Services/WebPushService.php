<?php

namespace App\Services;

use App\Models\CustomerPushSubscription;
use App\Modules\Orders\Models\Orders;
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;
use Illuminate\Support\Facades\Log;

class WebPushService
{
    protected ?WebPush $webPush = null;

    public function __construct()
    {
        $publicKey  = config('services.webpush.public_key');
        $privateKey = config('services.webpush.private_key');
        $subject    = config('services.webpush.subject');

        if ($publicKey && $privateKey) {
            try {
                $this->webPush = new WebPush([
                    'VAPID' => [
                        'subject'    => $subject,
                        'publicKey'  => $publicKey,
                        'privateKey' => $privateKey,
                    ],
                ]);
                $this->webPush->setReuseVAPIDHeaders(true);
            } catch (\Throwable $e) {
                Log::warning('WebPush init error: ' . $e->getMessage());
            }
        }
    }

    public function sendNotificationToSubscription(CustomerPushSubscription $sub, array $payload): bool
    {
        if (!$this->webPush) {
            return false;
        }

        try {
            $subscription = Subscription::create([
                'endpoint'        => $sub->endpoint,
                'publicKey'       => $sub->p256dh,
                'authToken'       => $sub->auth,
                'contentEncoding' => 'aes128gcm',
            ]);

            $report = $this->webPush->sendOneNotification($subscription, json_encode($payload));

            if ($report->isSuccess()) {
                Log::info("WebPush successfully sent to subscription #{$sub->id}");
                return true;
            }

            Log::warning("WebPush failed to send to subscription #{$sub->id}: " . $report->getReason());

            if ($report->isSubscriptionExpired()) {
                $sub->delete();
            }

            return false;
        } catch (\Throwable $e) {
            Log::warning('WebPush send error: ' . $e->getMessage());
            return false;
        }
    }

    public function sendOrderStatusNotification(Orders $order): int
    {
        $targetUserId = $order->pengguna_id ?? $order->user_id;
        if (!$targetUserId || !$this->webPush) {
            return 0;
        }

        $subscriptions = CustomerPushSubscription::where('pengguna_id', $targetUserId)->get();
        if ($subscriptions->isEmpty()) {
            return 0;
        }

        $orderNumber = str_pad($order->id, 5, '0', STR_PAD_LEFT);
        $tableNumber = $order->tabel ? $order->tabel->table_number : ($order->table_id ?? '-');
        $detailUrl   = route('customer.order.detail', $order->id);

        $titles = [
            'diproses'       => "☕ Pesanan #{$orderNumber} Sedang Disiapkan!",
            'siap_disajikan' => "🍽️ Pesanan #{$orderNumber} Siap Disajikan!",
            'selesai'        => "✨ Pesanan #{$orderNumber} Selesai!",
            'dibatalkan'     => "⚠️ Pesanan #{$orderNumber} Dibatalkan",
        ];

        $bodies = [
            'diproses'       => "Barista kami sedang meracik pesananmu untuk Meja {$tableNumber}. Mohon ditunggu ya!",
            'siap_disajikan' => "Pesananmu untuk Meja {$tableNumber} sudah siap disajikan! Klik untuk melihat detail pesanan.",
            'selesai'        => "Terima kasih telah berkunjung ke Ruang Seduh! Selamat menikmati hidanganmu.",
            'dibatalkan'     => "Pesanan #{$orderNumber} di Meja {$tableNumber} telah dibatalkan oleh staf/kasir.",
        ];

        if (!isset($titles[$order->status])) {
            return 0;
        }

        $payload = [
            'title' => $titles[$order->status],
            'body'  => $bodies[$order->status],
            'icon'  => asset('assets/images/LOGO_RUANG_SEDUH(coklat).png'),
            'badge' => asset('assets/images/LOGO_RUANG_SEDUH(coklat).png'),
            'tag'   => "order-{$order->id}-{$order->status}",
            'url'   => $detailUrl,
        ];

        $sentCount = 0;
        foreach ($subscriptions as $sub) {
            if ($this->sendNotificationToSubscription($sub, $payload)) {
                $sentCount++;
            }
        }

        return $sentCount;
    }
}