<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPurchase extends Model
{
    use HasFactory;
    public $table = 'subscription_purchases';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'payment_id',
        'subscription_id',
        'user_id',
        'total_image',
        'total_purchase',
        'expire_date',
        'status',
        'created_at',
        'updated_at',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'subscription_id');
    }
    public function payment()
    {
        return $this->hasMany(Payment::class, 'payment_id');
    }

}
