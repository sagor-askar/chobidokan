<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;
    protected $fillable = ['file_path', 'file_name', 'file_type', 'project_submit_id','project_id','status'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function projectSubmits()
    {
        return $this->belongsTo(ProjectSubmit::class, 'project_submit_id');
    }
}
