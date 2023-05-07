<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTransfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'invoice',
        'order_date',
        'delivery_date',
        'transfer_date',
        'transfer_type',
        'notes',
        'created_by',
        'updated_by',
    ];

    protected $casts = ['order_date' => 'date', 'delivery_date' => 'date', 'transfer_date' => 'date'];

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function details(){
        return $this->hasMany(StockTransferDetail::class, 'transfer_id', 'id');
    }
}
