<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package_id',
        'quantity',
        'order_date',
        'delivery_date',
        'delivery_address',
        'total_price',
        'payment_method',
        'order_status',
        'notes',
    ];

    protected $casts = [
        'order_date' => 'date',
        'delivery_date' => 'date',
        'total_price' => 'decimal:2',
    ];

    const STATUSES = [
        'Menunggu Pembayaran',
        'Menunggu Verifikasi',
        'Diproses',
        'Dikirim',
        'Selesai',
        'Dibatalkan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function getFormattedTotalPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->total_price, 0, ',', '.');
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->order_status) {
            'Menunggu Pembayaran' => 'warning',
            'Menunggu Verifikasi' => 'info',
            'Diproses'           => 'primary',
            'Dikirim'            => 'secondary',
            'Selesai'            => 'success',
            'Dibatalkan'         => 'danger',
            default              => 'secondary',
        };
    }

    public function canBeCancelled(): bool
    {
        return $this->order_status === 'Menunggu Pembayaran';
    }
}
