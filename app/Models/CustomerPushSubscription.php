<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Pengguna\Models\Pengguna;

class CustomerPushSubscription extends Model
{
    protected $table = 'customer_push_subscriptions';

    protected $fillable = [
        'pengguna_id',
        'endpoint',
        'endpoint_hash',
        'p256dh',
        'auth',
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }
}