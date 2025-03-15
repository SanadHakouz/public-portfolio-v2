<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\PageVisit;
use App\Models\VisitorSession;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class TrackVisits
{
    public function handle(Request $request, Closure $next): Response
    {
        // Make sure session is started
        if (!session()->isStarted()) {
            session()->start();
        }

        $response = $next($request);

        // Don't track admin routes, asset requests, or ajax requests
        if (!str_starts_with($request->path(), 'adminox') &&
            !str_starts_with($request->path(), 'livewire') &&
            !$request->is('*.js', '*.css', '*.ico', '*.png', '*.jpg', '*.svg') &&
            !$request->ajax()) {

            // Get real IP address when behind proxy like ngrok
            $ip = $request->header('X-Forwarded-For') ?? $request->ip();
            $sessionId = session()->getId();
            $page = $request->path() === '/' ? 'home' : $request->path();
            $userAgent = $request->userAgent();

            // Session-based tracking key for this specific page
            $pageVisitKey = "visited_page_{$page}";

            // Session-based tracking key for any visit to the site
            $siteVisitKey = "visited_site";

            // PART 1: Track unique visitor sessions (once per site visit)
            if (!session()->has($siteVisitKey)) {
                // First time this session is visiting any page on the site

                // Parse user agent to get device information
                $deviceType = $this->getDeviceType($userAgent);
                $browser = $this->getBrowser($userAgent);
                $os = $this->getOS($userAgent);

                // Get referring domain
                $referrer = $request->header('referer');
                $referrerDomain = $referrer ? parse_url($referrer, PHP_URL_HOST) : null;

                // Create a new visitor session record
                VisitorSession::create([
                    'session_id' => $sessionId,
                    'ip_address' => $ip,
                    'user_agent' => $userAgent,
                    'device_type' => $deviceType,
                    'browser' => $browser,
                    'operating_system' => $os,
                    'landing_page' => $page,
                    'referrer_domain' => $referrerDomain,
                    'pages_visited' => 1, // First page
                ]);

                // Mark this session as having visited the site
                session()->put($siteVisitKey, true);

                Log::info("New visitor session: {$sessionId}");
            }

            // PART 2: Track individual page visits (once per page per session)
            if (!session()->has($pageVisitKey)) {
                // First visit to this specific page in this session

                // Record the page visit
                $visit = PageVisit::create([
                    'ip_address' => $ip,
                    'user_agent' => $userAgent,
                    'page' => $page,
                    'referrer' => $request->header('referer'),
                    'session_id' => $sessionId
                ]);

                // Mark this specific page as visited in this session
                session()->put($pageVisitKey, true);

                // Increment pages_visited counter for this visitor session
                $visitorSession = VisitorSession::where('session_id', $sessionId)->first();
                if ($visitorSession) {
                    $visitorSession->increment('pages_visited');
                }

                Log::info("New page visit recorded with ID: " . $visit->id . " for session: {$sessionId}");
            }
        }

        return $response;
    }

    /**
     * Determine device type from user agent
     */
    private function getDeviceType($userAgent)
    {
        if (preg_match('/(android|iphone|ipad|ipod|blackberry|windows phone)/i', $userAgent)) {
            return 'Mobile';
        } elseif (preg_match('/(tablet|ipad)/i', $userAgent)) {
            return 'Tablet';
        } else {
            return 'Desktop';
        }
    }

    /**
     * Get browser name from user agent
     */
    private function getBrowser($userAgent)
    {
        if (preg_match('/MSIE/i', $userAgent) || preg_match('/Trident/i', $userAgent)) {
            return 'Internet Explorer';
        } elseif (preg_match('/Firefox/i', $userAgent)) {
            return 'Firefox';
        } elseif (preg_match('/Chrome/i', $userAgent)) {
            return 'Chrome';
        } elseif (preg_match('/Safari/i', $userAgent)) {
            return 'Safari';
        } elseif (preg_match('/Opera/i', $userAgent)) {
            return 'Opera';
        } elseif (preg_match('/Edge/i', $userAgent)) {
            return 'Edge';
        } else {
            return 'Unknown';
        }
    }

    /**
     * Get operating system from user agent
     */
    private function getOS($userAgent)
    {
        if (preg_match('/windows/i', $userAgent)) {
            return 'Windows';
        } elseif (preg_match('/mac/i', $userAgent)) {
            return 'MacOS';
        } elseif (preg_match('/linux/i', $userAgent)) {
            return 'Linux';
        } elseif (preg_match('/android/i', $userAgent)) {
            return 'Android';
        } elseif (preg_match('/(iphone|ipad)/i', $userAgent)) {
            return 'iOS';
        } else {
            return 'Unknown';
        }
    }
}
