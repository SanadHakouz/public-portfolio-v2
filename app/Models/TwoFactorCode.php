<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwoFactorCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'code',
        'expires_at',
        'used',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'used' => 'boolean',
    ];

    /**
     * Find a valid code for the given user
     */
    public static function getValidCode($userId)
    {
        return static::where('user_id', $userId)
                    ->where('used', false)
                    ->where('expires_at', '>', now())
                    ->latest()
                    ->first();
    }

    /**
     * Mark this code as used
     */
    public function markAsUsed()
    {
        $this->used = true;
        $this->save();
    }

    /**
     * Check if the code is expired
     */
    public function isExpired()
    {
        return $this->expires_at->isPast();
    }

    /**
     * Relationship with User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
