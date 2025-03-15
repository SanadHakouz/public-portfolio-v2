@extends('layouts.app', [
    'title' => 'Homepage ',
    'description' => 'Personal portfolio website showcasing web development projects using Laravel, PHP, and modern frontend technologies..',
    'keywords' => 'home page',
    'ogImage' => asset('images/home-og.jpg')
])

@section('content')
<x-page-header
    title="Home"
    background="images/header/bg2.jpg"
    :breadcrumbs="[
        route('home') => 'Home',
        route('projects') => 'Projects',
        route('about-me') => 'About',
        route('contact-me')=> 'Contact'
    ]"
/>
<!-- services livewire component -->
<livewire:services-section />

<!-- Home Projects Livewire component -->
<livewire:home-projects />

<!--technologies livewire component -->
<livewire:show-technologies />

<!-- about me livewire component -->
<livewire:about-me-section />

<!--contact form, make component later-->
<div class="container mx-auto px-4 py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Get in Touch</h2>

                @if(session('success'))
                    <div class="bg-green-100 dark:bg-green-900/30 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-300 px-4 py-3 rounded relative mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Your Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                               class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        @error('name')
                            <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email Address</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                               class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        @error('email')
                            <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Subject</label>
                        <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required
                               class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        @error('subject')
                            <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Message</label>
                        <textarea name="message" id="message" rows="6" required
                                  class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="w-full bg-blue-600 dark:bg-blue-700 text-white py-2 px-4 rounded-md hover:bg-blue-700 dark:hover:bg-blue-800 transition">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Location</h2>
                <div class="overflow-hidden rounded">
                    <div class="relative">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28850.226261334625!2d51.50755379079395!3d25.32844131808635!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e45c4c7694e3955%3A0x8a2357f7fb6c9b8e!2sWest%20Bay%2C%20Doha!5e0!3m2!1sen!2sqa!4v1741907048350!5m2!1sen!2sqa"
                                width="100%" height="300" style="border:0;"
                                allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                        <div class="absolute inset-0 pointer-events-none bg-transparent dark:bg-gray-900/30"></div>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Contact Info</h2>
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="text-gray-700 dark:text-gray-300">Doha, Qatar</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span class="text-gray-700 dark:text-gray-300">sanadhakouz@ymail.com</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span class="text-gray-700 dark:text-gray-300">+974 7058 8420</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection
