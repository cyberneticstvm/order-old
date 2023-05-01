<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'payment_mode',
        'amount',
        'status',
        'payment_date',
        'created_by',
        'updated_by'
    ];

    public function order(){
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function pmode(){
        return $this->belongsTo(PaymentMode::class, 'payment_mode', 'id');
    }
}
