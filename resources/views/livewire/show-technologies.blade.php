<div>
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-bold text-center mb-10 text-gray-900 dark:text-white">Technologies I Work With</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($technologies as $technology)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow duration-300">
                    <div class="flex items-center mb-4">
                        @if($technology->icon)
                            <div class="mr-3 text-blue-600 dark:text-blue-400">
                                <!-- You can replace with your own icon system -->
                                <i class="fas fa-{{ $technology->icon }} text-xl"></i>
                            </div>
                        @endif
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white">{{ $technology->title }}</h3>
                    </div>

                    <ul class="space-y-2">
                        @foreach($technology->getItemsArray() as $item)
                            <li class="flex items-start">
                                @if($item['is_checked'])
                                    <svg class="h-5 w-5 text-green-500 dark:text-green-400 mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                @else
                                    <svg class="h-5 w-5 text-gray-400 dark:text-gray-500 mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                    </svg>
                                @endif
                                <span class="text-gray-700 dark:text-gray-300">{{ $item['name'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</div>
