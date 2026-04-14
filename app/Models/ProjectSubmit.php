<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectSubmit extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'project_id',
        'visibility',
        'stock',
        'designer_id',
        'submit_date',
    ];

    // Cast boolean fields properly
    protected $casts = [
        'visibility' => 'boolean',
        'stock' => 'boolean',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function uploads()
    {
        return $this->hasMany(Upload::class, 'project_submit_id');
    }

    public function designer()
    {
        return $this->belongsTo(User::class, 'designer_id');
    }
}
