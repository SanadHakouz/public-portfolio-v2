<div class="container mx-auto px-4 py-12">
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Left Column - Profile Image and Download CV -->
        <div class="md:w-1/4 flex flex-col items-center">
            <img
            src="{{ Storage::url($aboutMe->profile_image) }}"
            alt="{{ $aboutMe->name }}"
            class="rounded-full w-64 h-64 object-cover mb-6"
            loading="lazy"
            width="256"
            height="256">
            @if($aboutMe->resume_file)
                <a href="{{ Storage::url($aboutMe->resume_file) }}" class="bg-blue-600 dark:bg-blue-700 text-white px-4 py-2 rounded flex items-center justify-center w-full max-w-xs hover:bg-blue-700 dark:hover:bg-blue-800 transition" target="_blank">
                   <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Download CV
                </a>
                <div class="mt-2 text-center text-sm text-gray-500 dark:text-gray-400">
                    @if($aboutMe->last_updated_at)
                        <span>Last updated: {{ $aboutMe->last_updated_at->format('M d, Y') }}</span>
                    @endif
                </div>
            @endif
        </div>

        <!-- Center Column - About Me -->
        <div class="md:w-2/4">
            <h1 class="text-3xl font-bold text-blue-600 dark:text-blue-400 mb-4">{{ $aboutMe->job_title }}</h1>

            <h2 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-white">About Me</h2>

            @foreach(explode("\n", $aboutMe->bio) as $paragraph)
                @if(!empty(trim($paragraph)))
                    <p class="mb-4 text-gray-700 dark:text-gray-300">{{ $paragraph }}</p>
                @endif
            @endforeach
        </div>

        <!-- Right Column - Certifications, Courses, Languages -->
        <div class="md:w-1/4">
            <!-- Certificates -->
            <div class="mb-8">
                <h3 class="flex items-center text-xl font-semibold mb-3 text-gray-900 dark:text-white">
                    <svg class="w-6 h-6 text-blue-500 dark:text-blue-400 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    Certificates
                </h3>
                <ul class="space-y-2">
                    @foreach($aboutMe->certificates as $certificate)
                        <li>
                            <a href="{{ $certificate['link'] }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                                {{ $certificate['name'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Ongoing Courses -->
            <div class="mb-8">
                <h3 class="flex items-center text-xl font-semibold mb-3 text-gray-900 dark:text-white">
                    <svg class="w-6 h-6 text-blue-500 dark:text-blue-400 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 00.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 00.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-.553-.894l-4-2z"></path>
                    </svg>
                    Ongoing Udemy Courses
                </h3>
                <ul class="space-y-2">
                    @foreach($aboutMe->ongoing_courses as $course)
                        <li>
                            <a href="{{ $course['link'] }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                                {{ $course['name'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Completed Courses -->
            <div class="mb-8">
                <h3 class="flex items-center text-xl font-semibold mb-3 text-gray-900 dark:text-white">
                    <svg class="w-6 h-6 text-blue-500 dark:text-blue-400 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    Completed Udemy Courses
                </h3>
                <ul class="space-y-2">
                    @foreach($aboutMe->completed_courses as $course)
                        <li>
                            <a href="{{ $course['link'] }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                                {{ $course['name'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Languages -->
            <div>
                <h3 class="flex items-center text-xl font-semibold mb-3 text-gray-900 dark:text-white">
                    <svg class="w-6 h-6 text-blue-500 dark:text-blue-400 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7 2a1 1 0 011 1v1h3a1 1 0 110 2H9.20l-.8 2H12a1 1 0 110 2H8.2l-.8 2H10a1 1 0 110 2H7.2l-.8 2H8a1 1 0 110 2H3a1 1 0 01-1-1v-1a1 1 0 01.4-.8l7-7a1 1 0 01.6-.2z" clip-rule="evenodd"></path>
                        <path d="M10.667 9.250l-7.584 7.584a1 1 0 01-1.414 0L.335 15.500a1 1 0 010-1.414l7.584-7.584a1 1 0 011.414 0l1.334 1.334a1 1 0 010 1.414z"></path>
                    </svg>
                    Languages
                </h3>
                <ul class="space-y-2">
                    @foreach($aboutMe->languages as $language)
                        <li class="text-gray-700 dark:text-gray-300">
                            <span class="font-medium">{{ $language['language'] }}</span> - {{ $language['proficiency'] }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
