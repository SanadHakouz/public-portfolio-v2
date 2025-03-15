<div class="py-12 bg-gray-50 dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">My Services</h2>
            <p class="text-lg text-gray-600 dark:text-gray-400">Expertise to help you succeed</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($services as $service)
            <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md">
                <div class="p-4 bg-blue-50 dark:bg-blue-900/30">
                    <img
                    src="{{ $service->imageUrl }}"
                    alt="{{ $service->title }}"
                    class="w-40 h-40 mx-auto object-contain"
                    loading="lazy"
                    width="160"
                    height="160">
                    <h3 class="text-xl font-semibold text-center text-blue-600 dark:text-blue-400 mt-2">{{ $service->title }}</h3>
                </div>
                <div class="px-6 py-4">
                    <p class="text-gray-700 dark:text-gray-300">{{ $service->description }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
