@extends('layouts.app', [
    'title' => 'About me | Hakousan ',
    'description' => 'My CV , profile description , certificatoins , courses & technology knowledge.',
    'keywords' => 'Aboutme , techstack , certificates and courses , languages , cv.',
    'ogImage' => asset('images/home-og.jpg')
])


@section('content')

<x-page-header
    title="About Me"
    background="images/header/bg2.jpg"
    :breadcrumbs="[
        route('home') => 'Home',
        route('projects') => 'Projects',
        route('about-me') => 'About',
        route('contact-me')=> 'Contact'
    ]"
/>

<livewire:about-me-section />
<livewire:show-technologies />

@endsection
