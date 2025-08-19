<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    public $table = 'projects';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name',
        'category_id',
        'project_description',
        'logo_description',
        'project_file',
        'publish_date',
        'expire_date',
        'user_id',
        'status',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function order()
    {
        return $this->hasOne(Order::class, 'project_id');
    }

    public function subscription()
    {
        return $this->hasOneThrough(
            Subscription::class,
            Order::class,
            'project_id',
            'id',
            'id',
            'subscription_id'
        );
    }

}
