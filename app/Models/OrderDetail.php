<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'branch_id',
        'product_type',
        'sph',
        'cyl',
        'axis',
        'addition',
        'product_id',
        'qty',
        'price',
        'tax_percentage',
        'tax_amount',
        'discount_percentage',
        'discount_amount',
        'total',
    ];
}
