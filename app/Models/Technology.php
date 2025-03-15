<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'title',
        'icon',
        'order',
        'is_active',
        'items',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'items' => 'array',
    ];

    public function getItemsArray()
    {
        return $this->items ?? [];
    }
}
