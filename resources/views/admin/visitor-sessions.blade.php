@extends('layouts.admin')

@section('content')
<div class="p-6 bg-white border border-gray-200 rounded-lg">
    <h2 class="text-xl font-medium text-gray-800 mb-6">Visitor Sessions</h2>

    <!-- Overview Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-blue-100 p-5 rounded-lg">
            <h3 class="text-lg font-medium text-gray-800 mb-2">Total Sessions</h3>
            <span class="text-3xl font-bold text-blue-600">{{ \App\Models\VisitorSession::count() }}</span>
        </div>

        <div class="bg-green-100 p-5 rounded-lg">
            <h3 class="text-lg font-medium text-gray-800 mb-2">Today</h3>
            <span class="text-3xl font-bold text-green-600">{{ $visitorsToday }}</span>
        </div>

        <div class="bg-purple-100 p-5 rounded-lg">
            <h3 class="text-lg font-medium text-gray-800 mb-2">This Week</h3>
            <span class="text-3xl font-bold text-purple-600">{{ $visitorsThisWeek }}</span>
        </div>
    </div>

    <!-- Device Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Device Types -->
        <div class="bg-gray-100 p-5 rounded-lg">
            <h3 class="text-lg font-medium text-gray-800 mb-4">Device Types</h3>
            <div class="space-y-2">
                @foreach($deviceStats as $stat)
                <div class="flex justify-between items-center p-3 bg-white rounded border border-gray-200">
                    <span class="font-medium">{{ $stat->device_type ?? 'Unknown' }}</span>
                    <span class="text-gray-600">{{ $stat->count }} visitors</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Browsers -->
        <div class="bg-gray-100 p-5 rounded-lg">
            <h3 class="text-lg font-medium text-gray-800 mb-4">Top Browsers</h3>
            <div class="space-y-2">
                @foreach($browserStats as $stat)
                <div class="flex justify-between items-center p-3 bg-white rounded border border-gray-200">
                    <span class="font-medium">{{ $stat->browser ?? 'Unknown' }}</span>
                    <span class="text-gray-600">{{ $stat->count }} visitors</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Operating Systems -->
        <div class="bg-gray-100 p-5 rounded-lg">
            <h3 class="text-lg font-medium text-gray-800 mb-4">Top Operating Systems</h3>
            <div class="space-y-2">
                @foreach($osStats as $stat)
                <div class="flex justify-between items-center p-3 bg-white rounded border border-gray-200">
                    <span class="font-medium">{{ $stat->operating_system ?? 'Unknown' }}</span>
                    <span class="text-gray-600">{{ $stat->count }} visitors</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Top Landing Pages -->
    <div class="mb-8">
        <div class="bg-gray-100 p-5 rounded-lg">
            <h3 class="text-lg font-medium text-gray-800 mb-4">Top Landing Pages</h3>
            <div class="space-y-2">
                @foreach($landingPages as $page)
                <div class="flex justify-between items-center p-3 bg-white rounded border border-gray-200">
                    <span class="font-medium">{{ $page->landing_page }}</span>
                    <span class="text-gray-600">{{ $page->count }} entries</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Visitor Sessions Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <h3 class="text-lg font-medium text-gray-800 p-4 border-b">Recent Visitor Sessions</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IP Address</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Device</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Browser / OS</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Landing Page</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pages Visited</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Details</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($visitorSessions as $session)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $session->ip_address }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $session->device_type }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $session->browser }} / {{ $session->operating_system }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $session->landing_page }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $session->pages_visited }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $session->created_at->format('M d, Y H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <a href="{{ route('admin.visitor-sessions.show', $session->id) }}" class="text-blue-600 hover:text-blue-900">View Details</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4">
            {{ $visitorSessions->links() }}
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