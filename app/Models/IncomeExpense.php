<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeExpense extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'head',
        'amount',
        'description',
        'date',
        'created_by',
        'updated_by',
    ];

    public function iehead(){
        return $this->belongsTo(IncomeExpenseHead::class, 'head', 'id');
    }

    protected $casts = ['date' => 'date'];
}
