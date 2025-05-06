<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licencing extends Model
{
    use HasFactory;

    public $table = 'licencings';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'title',
        'description',
        'created_at',
        'updated_at',
    ];
}
