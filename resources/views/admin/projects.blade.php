@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-semibold text-gray-900">Project Management</h1>
    <p class="mt-1 text-sm text-gray-600">Manage your portfolio projects.</p>
</div>

<livewire:admin.project-manager />
@endsection
