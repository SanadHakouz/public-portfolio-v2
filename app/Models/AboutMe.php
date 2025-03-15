<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AboutMe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'profile_image',
        'job_title',
        'bio',
        'resume_file',
        'certificates',
        'ongoing_courses',
        'completed_courses',
        'languages',
        'last_updated_at',
    ];

    protected $casts = [
        'certificates' => 'array',
        'ongoing_courses' => 'array',
        'completed_courses' => 'array',
        'languages' => 'array',
        'last_updated_at' => 'date',
    ];
    // In app/Models/AboutMe.php
public function getProfileImageUrlAttribute()
{
    if (!$this->profile_image) {
        return null;
    }

    return Storage::url($this->profile_image);
}
}
