<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'payment_date',
        'proof_payment',
        'verification_status',
        'notes',
    ];

    protected $casts = [
        'payment_date' => 'date',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getProofPaymentUrlAttribute(): ?string
    {
        if ($this->proof_payment) {
            return asset('storage/payments/' . $this->proof_payment);
        }
        return null;
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->verification_status) {
            'Menunggu'  => 'warning',
            'Disetujui' => 'success',
            'Ditolak'   => 'danger',
            default     => 'secondary',
        };
    }
}
