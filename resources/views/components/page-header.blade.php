<div class="relative py-16 mb-12 bg-cover bg-center text-center min-h-[300px]"
     style="background-image: url('/images/header/bg2.jpg');">

    <div class="container mx-auto px-4 py-8 relative z-10">
        <h1 class="text-4xl md:text-5xl text-white mb-8 font-bold drop-shadow-lg">{{ $title }}</h1>

        <nav aria-label="breadcrumb" class="relative mt-5">
            <ol class="flex flex-wrap justify-center items-center">
                @php
                    $currentRouteName = Route::currentRouteName();
                @endphp

                @foreach($breadcrumbs as $link => $text)
                    <li class="flex items-center">
                        @if(!$loop->first)
                            <span class="mx-2 md:mx-4 text-gray-400 text-lg md:text-2xl font-light text-shadow-white">/</span>
                        @endif

                        <a href="{{ url($link) }}"
                           class="text-{{ $text === $title ? 'white font-medium' : 'gray-300' }} hover:text-white transition-colors duration-200 text-base md:text-2xl text-shadow-white">
                            {{ $text }}
                        </a>
                    </li>
                @endforeach
            </ol>
        </nav>
    </div>
</div>
