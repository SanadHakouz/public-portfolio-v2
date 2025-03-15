@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-semibold text-gray-900">Technologies Management</h1>
    <p class="mt-1 text-sm text-gray-600">Manage the technologies that showcase your skills and expertise.</p>
</div>

<livewire:admin.technology-manager />
@endsection
