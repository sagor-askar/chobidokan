<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignerPayment extends Model
{
    use HasFactory;
    public $table = 'designer_payments';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'payment_id',
        'project_id',
        'product_id',
        'designer_id',
        'user_id',
        'amount',
        'card_type',
        'bank_txn',
        'created_at',
        'updated_at',
    ];



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function designer()
    {
        return $this->belongsTo(User::class, 'designer_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

}
