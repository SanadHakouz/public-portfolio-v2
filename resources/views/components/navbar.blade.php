<nav class="bg-blue-600 dark:bg-gray-800 text-white shadow-md py-2 relative z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <!-- Logo with link to homepage -->
            <a href="{{ route('home') }}" class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 220 50" class="h-10 w-auto">
                    <!-- Code Symbol in white instead of black -->
                    <g transform="translate(10, 25)" fill="#ffffff">
                        <path d="M0,0 L8,-8 L14,-2 L14,2 L8,8 L0,0" />
                        <path d="M18,-12 L18,12" stroke="#ffffff" stroke-width="6" stroke-linecap="round" />
                        <path d="M36,0 L28,-8 L22,-2 L22,2 L28,8 L36,0" />
                    </g>

                    <!-- Hakousan Text in white -->
                    <text x="60" y="30" font-family="Arial, sans-serif" font-size="20" font-weight="bold" fill="#ffffff">Hakousan</text>
                </svg>
            </a>

            <div class="flex items-center">

                <!-- Mobile menu button -->
                <div class="md:hidden ml-2">
                    <button type="button" class="text-white hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white relative z-50" id="mobile-menu-button" aria-expanded="false" style="background-color: rgba(0,0,0,0.2); padding: 6px; border-radius: 4px;">
                        <span class="sr-only">Open main menu</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex md:items-center md:justify-between md:flex-1 ml-4">
                <!-- Main Navigation -->
                <ul class="flex space-x-4">
                    <li>
                        <a href="{{ route('home') }}" class="px-3 py-2 text-white font-medium hover:text-gray-200 hover:-translate-y-0.5 transition-all duration-200 {{ request()->routeIs('home') ? 'border-b-2 border-white dark:border-gray-300' : '' }}">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('projects') }}" class="px-3 py-2 text-white font-medium hover:text-gray-200 hover:-translate-y-0.5 transition-all duration-200 {{ request()->routeIs('projects') ? 'border-b-2 border-white dark:border-gray-300' : '' }}">
                            Projects
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about-me') }}" class="px-3 py-2 text-white font-medium hover:text-gray-200 hover:-translate-y-0.5 transition-all duration-200 {{ request()->routeIs('about-me') ? 'border-b-2 border-white dark:border-gray-300' : '' }}">
                            About
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact-me') }}" class="px-3 py-2 text-white font-medium hover:text-gray-200 hover:-translate-y-0.5 transition-all duration-200 {{ request()->routeIs('contact-me') ? 'border-b-2 border-white dark:border-gray-300' : '' }}">
                            Contact
                        </a>
                    </li>
                </ul>

                <!-- Social Icons -->
                <ul class="flex items-center space-x-4">
                    <li>
                        <a href="https://www.linkedin.com/in/sanad-hakooz-76500b328/" target="_blank" class="text-white hover:text-gray-200 hover:scale-110 transition-all duration-300">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://github.com/SanadHakouz" target="_blank" class="text-white hover:text-gray-200 hover:scale-110 transition-all duration-300">
                            <i class="fab fa-github text-xl"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/hakoosan" target="_blank" class="text-white hover:text-gray-200 hover:scale-110 transition-all duration-300">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                    </li>
                    <!-- dark button toggle-->
                    <li>
                        @include('components.dark-mode-toggle')
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div class="hidden md:hidden absolute left-0 right-0 top-full bg-blue-600 dark:bg-gray-800 shadow-lg z-40" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="{{ route('home') }}" class="block px-3 py-2 text-white font-medium {{ request()->routeIs('home') ? 'bg-blue-700 dark:bg-gray-700 text-white' : '' }}">
                Home
            </a>
            <a href="{{ route('projects') }}" class="block px-3 py-2 text-white font-medium {{ request()->routeIs('projects') ? 'bg-blue-700 dark:bg-gray-700 text-white' : '' }}">
                Projects
            </a>
            <a href="{{ route('about-me') }}" class="block px-3 py-2 text-white font-medium {{ request()->routeIs('about-me') ? 'bg-blue-700 dark:bg-gray-700 text-white' : '' }}">
                About
            </a>
            <a href="{{ route('contact-me') }}" class="block px-3 py-2 text-white font-medium {{ request()->routeIs('contact-me') ? 'bg-blue-700 dark:bg-gray-700 text-white' : '' }}">
                Contact
            </a>
        </div>
        <div class="px-5 py-3 border-t border-blue-700 dark:border-gray-700">
            <div class="flex space-x-6">
                <a href="https://www.linkedin.com/in/sanad-hakooz-76500b328/" target="_blank" class="text-white">
                    <i class="fab fa-linkedin text-xl"></i>
                </a>
                <a href="https://github.com/SanadHakouz" target="_blank" class="text-white">
                    <i class="fab fa-github text-xl"></i>
                </a>
                <a href="https://www.instagram.com/hakoosan" target="_blank" class="text-white">
                    <i class="fab fa-instagram text-xl"></i>
                </a>
            </div>
            <div>
                @include('components.dark-mode-toggle')
            </div>
        </div>
    </div>

    <script>
        // Mobile menu toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    // Toggle the 'hidden' class
                    mobileMenu.classList.toggle('hidden');

                    // Update aria-expanded attribute
                    const isExpanded = mobileMenu.classList.contains('hidden') ? 'false' : 'true';
                    mobileMenuButton.setAttribute('aria-expanded', isExpanded);
                });
            }
        });
        </script>

</nav>

