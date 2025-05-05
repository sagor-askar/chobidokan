<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    public $table = 'settings';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name',
        'site_title',
        'email',
        'phone',
        'address',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'logo',
        'created_at',
        'updated_at',
    ];
}
