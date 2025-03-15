<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectClick extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'ip_address',
        'user_agent',
        'referrer'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
