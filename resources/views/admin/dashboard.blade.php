@extends('layouts.admin')

@section('content')
<div class="p-6 bg-white border border-gray-200 rounded-lg">
    <h2 class="text-xl font-medium text-gray-800 mb-6">Admin Dashboard</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <!-- Services Card -->
        <div class="bg-blue-600 p-6 text-white rounded-lg">
            <h3 class="text-xl font-medium mb-2">Services</h3>
            <p class="mb-4">Manage your service offerings</p>
            <a href="{{ route('admin.services') }}" class="inline-block bg-white text-blue-600 px-4 py-2 rounded font-medium hover:bg-gray-100 transition">
                Manage Services
            </a>
        </div>

        <!-- Technologies Card -->
        <div class="bg-green-500 p-6 text-white rounded-lg">
            <h3 class="text-xl font-medium mb-2">Technologies</h3>
            <p class="mb-4">Showcase your technical skills and expertise</p>
            <a href="{{ route('admin.technologies') }}" class="inline-block bg-white text-green-600 px-4 py-2 rounded font-medium hover:bg-gray-100 transition">
                Manage Technologies
            </a>
        </div>

        <!-- Projects Card -->
        <div class="bg-red-600 p-6 text-white rounded-lg">
            <h3 class="text-xl font-medium mb-2">Projects</h3>
            <p class="mb-4">Manage your portfolio projects</p>
            <a href="{{ route('admin.projects') }}" class="inline-block bg-white text-red-600 px-4 py-2 rounded font-medium hover:bg-gray-100 transition">
                Manage Projects
            </a>
        </div>

        <!-- About Me Card  -->
        <div class="bg-cyan-100 p-6 rounded-lg">
            <h3 class="text-xl font-medium text-gray-800 mb-2">About Me</h3>
            <p class="mb-4 text-gray-600">Manage your personal information and profile</p>
            <a href="{{ route('admin.about-me') }}" class="inline-block bg-white text-cyan-600 border border-cyan-300 px-4 py-2 rounded font-medium hover:bg-gray-100 transition">
                Edit Details
            </a>
        </div>

        <!-- Messages Card -->
        @php
            $unreadCount = \App\Models\Contact::where('read', false)->count();
            $totalCount = \App\Models\Contact::count();
        @endphp
        <div class="bg-purple-700 p-6 text-white rounded-lg">
            <h3 class="text-xl font-medium mb-2">Messages</h3>
            <p class="mb-2">Manage contact form submissions</p>
            <div class="mb-4">
                <div class="text-sm">{{ $unreadCount }} unread messages</div>
                <div class="text-sm">{{ $totalCount }} total messages</div>
            </div>
            <a href="{{ route('admin.messages.index') }}" class="inline-block bg-white text-purple-700 px-4 py-2 rounded font-medium hover:bg-gray-100 transition">
                View Messages
            </a>
        </div>

        <!-- Analytics Card -->
        <div class="bg-yellow-500 p-6 text-white rounded-lg">
             <h3 class="text-xl font-medium mb-2">Analytics</h3>
             <p class="mb-4">View visitor statistics and project clicks</p>
             <a href="{{ route('admin.analytics') }}" class="inline-block bg-white text-yellow-600 px-4 py-2 rounded font-medium hover:bg-gray-100 transition">
            View Analytics
            </a>
        </div>
    </div>


    <!-- Stats Overview Section -->
    <div class="mt-10">
        <h3 class="text-xl font-medium text-gray-800 mb-6">Quick Stats</h3>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @php
                $aboutMe = \App\Models\AboutMe::first();
                $projectsCount = \App\Models\Project::count();
                $completedProjectsCount = \App\Models\Project::where('is_completed', true)->count();
                $upcomingProjectsCount = \App\Models\Project::where('is_completed', false)->count();
                $servicesCount = \App\Models\Service::count() ?? 0;
                $technologiesCount = \App\Models\Technology::count() ?? 0;
            @endphp

            <div class="bg-gray-100 p-5 rounded-lg text-center">
                <span class="text-3xl font-bold text-blue-600">{{ $servicesCount }}</span>
                <p class="text-gray-600 mt-1">Services</p>
            </div>

            <div class="bg-gray-100 p-5 rounded-lg text-center">
                <span class="text-3xl font-bold text-green-600">{{ $technologiesCount }}</span>
                <p class="text-gray-600 mt-1">Technologies</p>
            </div>

            <div class="bg-gray-100 p-5 rounded-lg text-center">
                <span class="text-3xl font-bold text-red-600">{{ $projectsCount }}</span>
                <p class="text-gray-600 mt-1">Projects</p>
                <div class="flex justify-center text-sm mt-1">
                    <span class="text-green-600 mr-2">{{ $completedProjectsCount }} completed</span>
                    <span class="text-yellow-600">{{ $upcomingProjectsCount }} upcoming</span>
                </div>
            </div>

            <div class="bg-gray-100 p-5 rounded-lg text-center">
                <span class="text-3xl font-bold text-purple-600">{{ $totalCount }}</span>
                <p class="text-gray-600 mt-1">Messages</p>
                @if($unreadCount > 0)
                    <p class="text-sm text-red-500 mt-1">{{ $unreadCount }} unread</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
