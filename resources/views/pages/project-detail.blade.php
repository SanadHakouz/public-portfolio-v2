@extends('layouts.app', [
    'title' => 'Projects| Hakousan',
    'description' => 'Projects Showcase.',
    'keywords' => 'Projects',
    'ogImage' => asset('images/home-og.jpg')
])


@section('content')
<div class="py-12 bg-gray-100">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            @if($project->image_path)
                <div class="h-64 w-full overflow-hidden">
                    <img src="{{ Storage::url($project->image_path) }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                </div>
            @endif

            <div class="p-6 sm:p-10">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 mb-3 sm:mb-0">{{ $project->title }}</h1>

                    <div class="flex space-x-2">
                        @if($project->github_link)
                            <a href="{{ $project->github_link }}" target="_blank" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path>
                                </svg>
                                View on GitHub
                            </a>
                        @endif

                        @if($project->documentation_path)
                            <a href="{{ Storage::url($project->documentation_path) }}" target="_blank" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                                Documentation
                            </a>
                        @endif
                    </div>
                </div>

                @if($project->technologies && count($project->technologies) > 0)
                    <div class="mb-8">
                        <h2 class="text-lg font-medium text-gray-900 mb-3">Technologies Used</h2>
                        <div class="flex flex-wrap gap-2">
                            @foreach($project->technologies as $tech)
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm rounded-full">{{ $tech }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="prose max-w-none">
                    <h2 class="text-lg font-medium text-gray-900 mb-3">Project Description</h2>
                    <p class="text-gray-700">{{ $project->description }}</p>
                </div>

                <div class="mt-10 pt-10 border-t border-gray-200">
                    <a href="{{ route('projects') }}" class="text-blue-600 hover:text-blue-800">
                        &larr; Back to Projects
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
