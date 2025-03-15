<div>
    <!-- Completed Projects Section -->
    <div class="py-8">
        <h2 class="text-3xl font-bold text-center mb-10 text-gray-900 dark:text-white">Projects</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($completedProjects as $project)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="h-48 overflow-hidden">
                        @if($project->image_path)
                            <img
                                src="{{ Storage::url($project->image_path) }}"
                                alt="{{ $project->title }}"
                                class="w-full h-full object-cover"
                                loading="lazy"
                                width="400"
                                height="192">
                        @else
                            <div class="w-full h-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2 text-gray-900 dark:text-white">{{ $project->title }}</h3>
                        <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">{{ $project->description }}</p>

                        @if($project->technologies)
                            <div class="mb-4">
                                <p class="text-gray-700 dark:text-gray-300 font-medium">Technologies:</p>
                                <div class="flex flex-wrap gap-2 mt-1">
                                    @foreach($project->technologies as $tech)
                                        <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900/40 text-blue-800 dark:text-blue-300 text-xs rounded">{{ $tech }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="flex flex-wrap gap-2 mt-4">
                            @if($project->github_link)
                                <a href="{{ $project->github_link }}" target="_blank" class="inline-flex items-center px-3 py-1 border border-gray-300 dark:border-gray-600 rounded text-sm font-medium bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200">
                                    <svg class="w-5 h-5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path>
                                    </svg>
                                    GitHub
                                </a>
                            @endif

                            @if($project->documentation_url)
                                <a href="{{ $project->documentation_url }}" target="_blank" class="inline-flex items-center px-3 py-1 border border-blue-300 dark:border-blue-700 rounded text-sm font-medium bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 hover:bg-blue-100 dark:hover:bg-blue-900/50">
                                    <svg class="w-5 h-5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        <line x1="16" y1="13" x2="8" y2="13"></line>
                                        <line x1="16" y1="17" x2="8" y2="17"></line>
                                        <polyline points="10 9 9 9 8 9"></polyline>
                                    </svg>
                                    Docs
                                </a>
                            @endif

                            <a href="{{ route('projects.show', $project->id) }}" class="inline-flex items-center px-3 py-1 border border-blue-500 dark:border-blue-600 rounded text-sm font-medium bg-blue-500 dark:bg-blue-600 text-white hover:bg-blue-600 dark:hover:bg-blue-700">
                                <svg class="w-5 h-5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Upcoming Projects Section (if any) -->
    @if(count($upcomingProjects) > 0)
        <div class="py-8">
            <h2 class="text-3xl font-bold text-center mb-10 text-gray-900 dark:text-white">Upcoming Projects</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($upcomingProjects as $project)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 relative">
                        <div class="h-48 overflow-hidden">
                            @if($project->image_path)
                                <img
                                    src="{{ Storage::url($project->image_path) }}"
                                    alt="{{ $project->title }}"
                                    class="w-full h-full object-cover"
                                    loading="lazy"
                                    width="400"
                                    height="192">
                            @else
                                <div class="w-full h-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <div class="absolute top-4 right-4">
                            <span class="px-3 py-1 bg-yellow-500 dark:bg-yellow-600 text-white text-xs font-bold rounded-full">
                                Coming Soon
                            </span>
                        </div>

                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2 text-gray-900 dark:text-white">{{ $project->title }}</h3>
                            <p class="text-gray-600 dark:text-gray-300 text-sm">{{ $project->description }}</p>

                            @if($project->technologies)
                                <div class="mt-4">
                                    <p class="text-gray-700 dark:text-gray-300 font-medium">Technologies:</p>
                                    <div class="flex flex-wrap gap-2 mt-1">
                                        @foreach($project->technologies as $tech)
                                            <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900/40 text-blue-800 dark:text-blue-300 text-xs rounded">{{ $tech }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
