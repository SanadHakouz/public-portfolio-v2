<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VisitorSession;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VisitorSessionsController extends Controller
{
    public function index()
    {
        // Get all visitor sessions, ordered by most recent
        $visitorSessions = VisitorSession::orderBy('created_at', 'desc')
            ->paginate(20);

        // Get device statistics
        $deviceStats = VisitorSession::select('device_type', DB::raw('count(*) as count'))
            ->groupBy('device_type')
            ->get();

        // Get browser statistics
        $browserStats = VisitorSession::select('browser', DB::raw('count(*) as count'))
            ->groupBy('browser')
            ->orderBy('count', 'desc')
            ->limit(5)
            ->get();

        // Get OS statistics
        $osStats = VisitorSession::select('operating_system', DB::raw('count(*) as count'))
            ->groupBy('operating_system')
            ->orderBy('count', 'desc')
            ->limit(5)
            ->get();

        // Get most common landing pages
        $landingPages = VisitorSession::select('landing_page', DB::raw('count(*) as count'))
            ->groupBy('landing_page')
            ->orderBy('count', 'desc')
            ->limit(5)
            ->get();

        // Get total visitors today
        $visitorsToday = VisitorSession::whereDate('created_at', Carbon::today())->count();

        // Get total visitors this week
        $visitorsThisWeek = VisitorSession::whereBetween('created_at', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ])->count();

        // Get visitors by day (last 7 days)
        $dailyVisitors = VisitorSession::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('count(*) as count')
            )
            ->whereDate('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.visitor-sessions', compact(
            'visitorSessions',
            'deviceStats',
            'browserStats',
            'osStats',
            'landingPages',
            'visitorsToday',
            'visitorsThisWeek',
            'dailyVisitors'
        ));
    }

    public function show($id)
    {
        $visitorSession = VisitorSession::findOrFail($id);

        // Get all page visits for this session
        $pageVisits = $visitorSession->pageVisits()
            ->orderBy('created_at')
            ->get();

        return view('admin.visitor-session-detail', compact(
            'visitorSession',
            'pageVisits'
        ));
    }
}