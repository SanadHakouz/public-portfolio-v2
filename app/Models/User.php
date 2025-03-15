<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use  HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
    ];
    /**
 * Get the two-factor codes for the user.
 */
public function twoFactorCodes()
{
    return $this->hasMany(TwoFactorCode::class);
}

/**
 * Generate a new two-factor authentication code for the user.
 */
public function generateTwoFactorCode()
{
    // Invalidate any existing codes
    $this->twoFactorCodes()
         ->where('used', false)
         ->where('expires_at', '>', now())
         ->update(['used' => true]);

    // Generate a new code
    $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

    // Save it to the database
    $this->twoFactorCodes()->create([
        'code' => $code,
        'expires_at' => now()->addMinutes(10), // 10 minutes expiration
    ]);

    return $code;
}

/**
 * Determine if the user has two-factor authentication enabled.
 */
public function hasTwoFactorAuthEnabled()
{
    return $this->two_factor_enabled;
}

/**
 * Enable two-factor authentication for the user.
 */
public function enableTwoFactorAuth()
{
    $this->two_factor_enabled = true;
    $this->save();
}

/**
 * Disable two-factor authentication for the user.
 */
public function disableTwoFactorAuth()
{
    $this->two_factor_enabled = false;
    $this->save();
}
}
