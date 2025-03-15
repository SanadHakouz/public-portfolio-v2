@extends('layouts.admin')

@section('content')
<div class="p-6 bg-white border border-gray-200 rounded-lg">
    <h2 class="text-xl font-medium text-gray-800 mb-6">Analytics Dashboard</h2>

    <!-- Overview Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-blue-100 p-5 rounded-lg">
            <h3 class="text-lg font-medium text-gray-800 mb-2">Page Visits</h3>
            <span class="text-3xl font-bold text-blue-600">{{ $totalPageVisits }}</span>
            <p class="text-sm text-gray-600 mt-1">Total page views</p>
        </div>

        <div class="bg-indigo-100 p-5 rounded-lg">
            <h3 class="text-lg font-medium text-gray-800 mb-2">Unique Visitors</h3>
            <span class="text-3xl font-bold text-indigo-600">{{ $totalUniqueVisitors }}</span>
            <p class="text-sm text-gray-600 mt-1">Based on sessions</p>
        </div>

        <div class="bg-green-100 p-5 rounded-lg">
            <h3 class="text-lg font-medium text-gray-800 mb-2">Today</h3>
            <div>
                <span class="text-2xl font-bold text-green-600">{{ $uniqueVisitorsToday }}</span>
                <span class="text-sm text-gray-600"> visitors</span>
            </div>
            <div class="mt-1">
                <span class="text-xl font-bold text-green-600">{{ $pageVisitsToday }}</span>
                <span class="text-sm text-gray-600"> page views</span>
            </div>
        </div>

        <div class="bg-purple-100 p-5 rounded-lg">
            <h3 class="text-lg font-medium text-gray-800 mb-2">This Week</h3>
            <div>
                <span class="text-2xl font-bold text-purple-600">{{ $uniqueVisitorsThisWeek }}</span>
                <span class="text-sm text-gray-600"> visitors</span>
            </div>
            <div class="mt-1">
                <span class="text-xl font-bold text-purple-600">{{ $pageVisitsThisWeek }}</span>
                <span class="text-sm text-gray-600"> page views</span>
            </div>
        </div>
    </div>

    <!-- Traffic Chart -->
    <div class="mb-8">
        <div class="bg-gray-100 p-5 rounded-lg">
            <h3 class="text-lg font-medium text-gray-800 mb-4">Traffic (Last 7 Days)</h3>
            <div class="w-full h-64">
                <canvas id="trafficChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Top Pages and Projects -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Top Pages -->
        <div class="bg-gray-100 p-5 rounded-lg">
            <h3 class="text-lg font-medium text-gray-800 mb-4">Most Visited Pages</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="text-left text-gray-600 border-b border-gray-300">
                            <th class="pb-2">Page</th>
                            <th class="pb-2">Visitors</th>
                            <th class="pb-2">Views</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($topPages as $page)
                        <tr class="border-b border-gray-200">
                            <td class="py-2 font-medium">{{ $page->page }}</td>
                            <td class="py-2">{{ $page->unique_visitors }}</td>
                            <td class="py-2">{{ $page->total_visits }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Top Projects -->
        <div class="bg-gray-100 p-5 rounded-lg">
            <h3 class="text-lg font-medium text-gray-800 mb-4">Most Clicked Projects</h3>
            <div class="space-y-2">
                @foreach($topProjects as $projectClick)
                <div class="flex justify-between items-center p-3 bg-white rounded border border-gray-200">
                    <span class="font-medium">{{ $projectClick->project->title }}</span>
                    <span class="text-gray-600">{{ $projectClick->total }} clicks</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Add a link to the dashboard -->
    <div class="mt-6">
        <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800">
            ← Back to Dashboard
        </a>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('trafficChart').getContext('2d');

        // Prepare chart data from PHP variables
        const labels = {!! json_encode($chartLabels ?? []) !!};
        const pageVisitsData = {!! json_encode($pageVisitsData ?? []) !!};
        const uniqueVisitorsData = {!! json_encode($uniqueVisitorsData ?? []) !!};

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Page Visits',
                        data: pageVisitsData,
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true
                    },
                    {
                        label: 'Unique Visitors',
                        data: uniqueVisitorsData,
                        borderColor: 'rgb(139, 92, 246)',
                        backgroundColor: 'rgba(139, 92, 246, 0.1)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    });
</script>
@endpush