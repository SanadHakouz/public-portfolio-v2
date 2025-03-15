@extends('layouts.app', [
    'title' => 'Projects',
    'description' => 'Projects Showcase.',
    'keywords' => 'Projects',
    'ogImage' => asset('images/home-og.jpg')
])


@section('content')

<x-page-header
    title="Projects"
    background="images/header/bg2.jpg"
    :breadcrumbs="[
        route('home') => 'Home',
        route('projects') => 'Projects',
        route('about-me') => 'About',
        route('contact-me')=> 'Contact'
    ]"
/>

<div class="py-12 bg-gray-100 dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


        <livewire:show-projects />
    </div>
</div>

@endsection
