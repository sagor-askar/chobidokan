<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    public $table = 'subscriptions';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name',
        'points',
        'price',
        'days',
        'status',
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
    ];
}
