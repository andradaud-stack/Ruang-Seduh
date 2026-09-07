<?php

namespace App\Models;

use App\Modules\Pengguna\Models\Pengguna;
use App\Modules\Tables\Models\Tables;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceCall extends Model
{
    use SoftDeletes;

    protected $table = 'service_calls';

    protected $fillable = [
        'table_id',
        'pengguna_id',
        'type',
        'notes',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function table()
    {
        return $this->belongsTo(Tables::class, 'table_id');
    }

    public function tabel()
    {
        return $this->belongsTo(Tables::class, 'table_id');
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }

    public function getTypeLabelAttribute(): string
    {
        return match ($this->type) {
            'minta_bill' => 'Minta Bill / Pembayaran',
            'minta_air' => 'Minta Air Putih / Es',
            'bersih_meja' => 'Bersihkan Meja',
            'lainnya' => 'Bantuan Khusus',
            default => 'Panggil Pelayan',
        };
    }
}
