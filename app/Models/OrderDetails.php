<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;
    public $table = 'order_details';

    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = ['file_path', 'file_name', 'file_type', 'project_id','order_id','user_id'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function projectSubmits()
    {
        return $this->belongsTo(ProjectSubmit::class, 'project_submit_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
