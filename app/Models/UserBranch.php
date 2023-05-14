<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBranch extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'branch_id',
    ];

    public function branch(){
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }
}
