<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionDownloadProduct extends Model
{
    use HasFactory;
    public $table = 'subscription_download_products';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'subscription_purchase_id',
        'product_id',
        'created_at',
        'updated_at',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
