<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempPayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'tran_id',
        'user_id',
        'total_amount',
        'product_ids',
        'status'
    ];
}
