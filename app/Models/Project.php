<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'github_link',
        'documentation_url', // Changed from documentation_path
        'image_path',
        'technologies',
        'is_completed',
        'is_active'
    ];

    protected $casts = [
        'technologies' => 'array',
        'is_completed' => 'boolean',
        'is_active' => 'boolean',
    ];

    // Get completed projects (ordered by most recent first)
    public function scopeCompleted($query)
    {
        return $query->where('is_completed', true)
                     ->where('is_active', true)
                     ->latest();
    }

    // Get upcoming projects (ordered by most recent first)
    public function scopeUpcoming($query)
    {
        return $query->where('is_completed', false)
                     ->where('is_active', true)
                     ->latest();
    }

    // Get active projects (both completed and upcoming)
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image_path) {
            return null;
        }

        return Storage::url($this->image_path);
    }

    public function getDocumentationUrlAttribute()
{
    // During migration, handle both old and new fields
    if (isset($this->attributes['documentation_url'])) {
        return $this->attributes['documentation_url'];
    } elseif (isset($this->attributes['documentation_path']) && $this->attributes['documentation_path']) {
        return Storage::url($this->attributes['documentation_path']);
    }

    return null;
}

public function clicks()
{
    return $this->hasMany(ProjectClick::class);
}

}
