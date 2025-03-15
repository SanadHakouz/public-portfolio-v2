<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'order',
        'active'
    ];

      // Add this accessor method to get the correct image URL
      public function getImageUrlAttribute()
      {
          if (substr($this->image, 0, 4) === 'http') {
              return $this->image;
          }

          if (Storage::disk('public')->exists($this->image)) {
              return Storage::url($this->image);
          }

          // Fallback for direct public path images
          if (file_exists(public_path($this->image))) {
              return asset($this->image);
          }

          // Default image if nothing found
          return asset('images/placeholder.jpg');
      }
}
