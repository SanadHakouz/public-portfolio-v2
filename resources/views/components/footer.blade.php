<footer class="bg-blue-600 dark:bg-gray-800 text-white mt-auto w-full">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="footer-column">
                <h5 class="font-bold mb-4 text-lg">Web development</h5>
                <ul class="space-y-3">
                    <li><span>Laravel</span></li>
                    <li><span>Breeze & Livewire</span></li>
                    <li><span>E-commerce cash on delivery</span></li>
                    <li><span>Business portfolio</span></li>
                    <li><span>Graduation Projects</span></li>
                </ul>
            </div>
            <div class="footer-column">
                <h5 class="font-bold mb-4 text-lg">Quick Links</h5>
                <ul class="space-y-3">
                    <li><a href="{{ route('home') }}" class="hover:text-gray-300 dark:hover:text-gray-400 transition-colors duration-300">Home</a></li>
                    <li><a href="{{ route('projects') }}" class="hover:text-gray-300 dark:hover:text-gray-400 transition-colors duration-300">Projects</a></li>
                    <li><a href="{{ route('about-me') }}" class="hover:text-gray-300 dark:hover:text-gray-400 transition-colors duration-300">About</a></li>
                    <li><a href="{{ route('contact-me') }}" class="hover:text-gray-300 dark:hover:text-gray-400 transition-colors duration-300">Contact</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h5 class="font-bold mb-4 text-lg">Personal Information</h5>
                <ul class="space-y-3">
                    <li>📍 Based in Doha, Qatar</li>
                    <li>📞 +974 7058 8420</li>
                    <li>✉️ sanadhakouz@ymail.com</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="bg-black bg-opacity-10 dark:bg-black dark:bg-opacity-30 py-3 text-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            © Hakousan. All Rights Reserved.
        </div>
    </div>

    <!-- Back to top button -->
<button id="back-to-top" class="fixed bottom-6 right-6 bg-blue-500 dark:bg-gray-700 text-white rounded-full p-3 shadow-lg opacity-0 invisible transition-all duration-300 hover:bg-blue-600 dark:hover:bg-gray-600 focus:outline-none z-50">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
    </svg>
    <span class="sr-only">Back to top</span>
</button>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const backToTopButton = document.getElementById('back-to-top');

    // Show button when user scrolls down 300px from the top
    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) {
            backToTopButton.classList.remove('opacity-0', 'invisible');
            backToTopButton.classList.add('opacity-100', 'visible');
        } else {
            backToTopButton.classList.add('opacity-0', 'invisible');
            backToTopButton.classList.remove('opacity-100', 'visible');
        }
    });

    // Smooth scroll to top when button is clicked
    backToTopButton.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
});
</script>
</footer>
