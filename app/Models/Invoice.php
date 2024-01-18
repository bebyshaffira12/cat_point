<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoice';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'booking_id',
        'order_id',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status_pembayaran',
        'booking_id',
        'order_id',
    ];

    public function booking(): HasOne {
        return $this->hasOne(Booking::class, 'id', 'booking_id');
    }

    public function order(): HasOne {
        return $this->hasOne(Order::class, 'id', 'order_id');
    }
}
