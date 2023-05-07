<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTransferDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'transfer_id',
        'from_branch',
        'to_branch',
        'transfer_type',
        'product_id',
        'qty',
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
