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
        'title', 'category_id','user_id', 'price','type', 'description',
        'file_path', 'file_name', 'file_type','status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

//    public function order()
//    {
//        return $this->hasOne(Order::class, 'project_id');
//    }
}
