<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'ip_address',
        'user_agent',
        'device_type',
        'browser',
        'operating_system',
        'country',
        'city',
        'landing_page',
        'referrer_domain',
        'pages_visited',
        'total_time_seconds',
    ];

    /**
     * Get all page visits for this session
     */
    public function pageVisits()
    {
        return $this->hasMany(PageVisit::class, 'session_id', 'session_id');
    }
}