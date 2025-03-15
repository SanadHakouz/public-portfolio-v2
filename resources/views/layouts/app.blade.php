<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Dynamic title -->
    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    <!-- Dynamic meta tags -->
    <meta name="description" content="{{ $description ?? 'Personal portfolio website showcasing web development projects using Laravel, PHP, and modern frontend technologies.' }}">
    <meta name="keywords" content="{{ $keywords ?? 'web development, Laravel, PHP, portfolio, projects, full-stack developer' }}">
    <meta name="author" content="Sanad Hakooz">

    <!-- Open Graph meta tags for better social media sharing -->
    <meta property="og:title" content="{{ $title ?? config('app.name', 'Laravel') }}">
    <meta property="og:description" content="{{ $description ?? 'Personal portfolio website showcasing web development projects using Laravel, PHP, and modern frontend technologies.' }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ $ogImage ?? asset('images/og-image.jpg') }}">

    <!-- Font Awesome (CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Alpine.js for Dark Mode -->
   <!-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> -->

    <!-- Smooth scrolling CSS -->
    <style>
        html {
            scroll-behavior: smooth;
        }

        @media screen and (prefers-reduced-motion: no-preference) {
            html {
                scroll-behavior: smooth;
            }
        }
    </style>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <!-- Initialize dark mode on page load -->
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('darkMode') === 'true' ||
            (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <!-- Livewire Styles -->
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 h-full">
    <!-- Navbar -->
    @include('components.navbar')

    <div class="min-h-screen flex flex-col pt-16"> <!-- Added pt-16 for navbar height -->
        <!-- Main Content -->
        <main class="flex-grow">
            @yield('content')
        </main>

        <!-- Footer -->
        @include('components.footer')
    </div>

    <!-- Livewire Scripts -->
    @livewireScripts

    <script>
        document.addEventListener('livewire:init', () => {
            // Variables to track scroll position
            let scrollPosition = 0;
            let isPaginating = false;

            // Listen for Livewire navigating events
            Livewire.hook('commit.prepare', ({ component }) => {
                // Only store position if we're not handling a hash scroll
                if (!window.location.hash) {
                    scrollPosition = window.scrollY;
                    isPaginating = true;
                }
            });

            Livewire.hook('morph.updated', ({ el }) => {
                // After Livewire updates the DOM, restore the scroll position
                if (isPaginating) {
                    window.scrollTo(0, scrollPosition);
                    isPaginating = false;
                }
            });

            // Handle pagination links specifically
            document.addEventListener('click', (e) => {
                const paginationLink = e.target.closest('.pagination a');
                if (paginationLink) {
                    // Prevent default behavior
                    e.preventDefault();

                    // Store scroll position
                    scrollPosition = window.scrollY;
                    isPaginating = true;

                    // Get the URL from the link
                    const url = new URL(paginationLink.href);

                    // Extract the page number
                    const pageParam = paginationLink.closest('[aria-label="Pagination Navigation"]') ?
                        url.searchParams.get('page') :
                        (url.searchParams.get('completed') || url.searchParams.get('upcoming'));

                    // Determine which pagination this is
                    const pageName = url.searchParams.has('completed') ? 'completed' :
                                     url.searchParams.has('upcoming') ? 'upcoming' : 'page';

                    // Use Livewire to navigate
                    if (pageParam && pageName) {
                        const component = Livewire.find(e.target.closest('[wire\\:id]').getAttribute('wire:id'));
                        if (component) {
                            if (pageName === 'page') {
                                component.setPage(pageParam);
                            } else {
                                component.setPage(pageParam, pageName);
                            }
                        }
                    }
                }
            });
        });

        // Unified smooth scroll handling
        document.addEventListener('DOMContentLoaded', function() {
            // Process internal navigation links for smooth scrolling
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                // Skip pagination links
                if (!anchor.closest('.pagination')) {
                    anchor.addEventListener('click', function(e) {
                        e.preventDefault();

                        const targetId = this.getAttribute('href');
                        if (targetId === '#') return; // Skip links with just "#"

                        const targetElement = document.querySelector(targetId);
                        if (targetElement) {
                            targetElement.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });

                            // Update URL without page reload
                            history.pushState(null, null, targetId);
                        }
                    });
                }
            });

            // Handle cases where URL has a hash when page loads
            if (window.location.hash) {
                setTimeout(function() {
                    const targetElement = document.querySelector(window.location.hash);
                    if (targetElement) {
                        targetElement.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }, 100);
            }
        });
    </script>

</body>
</html>
