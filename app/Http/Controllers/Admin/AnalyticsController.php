<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageVisit;
use App\Models\ProjectClick;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function index()
    {
        // Total page visits (each page a user visits counts as one)
        $totalPageVisits = PageVisit::count();

        // Total unique visitors (count of distinct session_ids)
        $totalUniqueVisitors = PageVisit::distinct('session_id')->count('session_id');

        // Page visits today
        $pageVisitsToday = PageVisit::whereDate('created_at', Carbon::today())->count();

        // Unique visitors today
        $uniqueVisitorsToday = PageVisit::whereDate('created_at', Carbon::today())
            ->distinct('session_id')
            ->count('session_id');

        // Page visits this week
        $pageVisitsThisWeek = PageVisit::whereBetween('created_at', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ])
            ->count();

        // Unique visitors this week
        $uniqueVisitorsThisWeek = PageVisit::whereBetween('created_at', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ])
            ->distinct('session_id')
            ->count('session_id');

        // Most visited pages
        $topPages = PageVisit::select('page', DB::raw('count(*) as total_visits'),
                   DB::raw('count(distinct session_id) as unique_visitors'))
            ->groupBy('page')
            ->orderBy('unique_visitors', 'desc')
            ->limit(5)
            ->get();

        // Most clicked projects
        $topProjects = ProjectClick::select('project_id', DB::raw('count(*) as total'))
            ->groupBy('project_id')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->with('project')
            ->get();

        // Get daily stats for the last 7 days for chart
        $dailyStats = PageVisit::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('count(*) as page_visits'),
                DB::raw('count(distinct session_id) as unique_visitors')
            )
            ->whereDate('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Prepare chart data
        $chartLabels = [];
        $pageVisitsData = [];
        $uniqueVisitorsData = [];

        foreach ($dailyStats as $stat) {
            $chartLabels[] = Carbon::parse($stat->date)->format('M d');
            $pageVisitsData[] = $stat->page_visits;
            $uniqueVisitorsData[] = $stat->unique_visitors;
        }

        return view('admin.analytics', compact(
            'totalPageVisits',
            'totalUniqueVisitors',
            'pageVisitsToday',
            'uniqueVisitorsToday',
            'pageVisitsThisWeek',
            'uniqueVisitorsThisWeek',
            'topPages',
            'topProjects',
            'chartLabels',
            'pageVisitsData',
            'uniqueVisitorsData'
        ));
    }
}