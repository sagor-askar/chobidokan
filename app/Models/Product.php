<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $table = 'products';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'title', 'category_id','designer_id', 'price','type','tags', 'description',
        'file_path', 'file_name', 'file_type','total_download','status'
    ];

    public function designer()
    {
        return $this->belongsTo(User::class, 'designer_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

//    public function order()
//    {
//        return $this->hasOne(Order::class, 'project_id');
//    }


    public function payment()
    {
        return $this->hasMany(Payment::class,'product_id');
    }
}
