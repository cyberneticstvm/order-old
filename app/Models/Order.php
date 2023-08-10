<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [        
        'order_number',
        'medical_record_id',
        'doctor_id',
        'branch_id',
        'patient_id',
        'patient_name',
        'age',
        'gender',
        'address',
        'mobile',
        'order_date',
        'gstin',
        're_pd',
        're_fh',
        're_prism',
        'le_pd', 
        'le_fh', 
        'le_prism', 
        'vd', 
        'ipd', 
        'npd', 
        'dbl', 
        'ed', 
        'size_a', 
        'size_b', 
        'pa', 
        'wa',
        'expected_delivery_date',
        'product_advisor',
        'order_total',
        'discount',
        'total_after_discount',
        'tax_amount',
        'net_total',
        'advance',
        'balance',
        'advance_received_at',
        'balance_received_at',
        'advance_payment_type',
        'balance_payment_type',
        'order_status',
        'notes',
        'created_by',
        'updated_by',
    ];

    protected $casts = ['order_date' => 'date', 'expected_delivery_date' => 'date'];

    public function orderdetails(){
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }

    public function branch(){
        return $this->hasOne(Branch::class, 'id', 'branch_id');
    }

    public function payments(){
        return $this->hasMany(OrderPayment::class, 'order_id', 'id');
    }
}
