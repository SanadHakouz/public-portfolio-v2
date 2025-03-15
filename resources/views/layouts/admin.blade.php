<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel Admin</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire Styles -->
    @livewireStyles

    <style>
        /* Custom Admin styles */
        body.sidebar-open #admin-sidebar {
            transform: translateX(0);
        }

        body.sidebar-closed #admin-sidebar {
            transform: translateX(-100%);
        }

        body.sidebar-open #admin-content {
            margin-left: 16rem;
        }

        body.sidebar-closed #admin-content {
            margin-left: 0;
        }

        @media (max-width: 768px) {
            body.sidebar-open {
                overflow: hidden;
            }
        }
    </style>
</head>
<body class="bg-gray-100 sidebar-closed">
    <!-- Sidebar -->
    @include('components.admin.sidebar')

    <!-- Navbar -->
    @include('components.admin.navbar')

    <!-- Page Content -->
    <div id="admin-content" class="p-6 mt-16 transition-all duration-300">
        @yield('content')
    </div>

    <!-- Livewire Scripts -->
    @livewireScripts

    <script>
        // Initialize sidebar state
        document.addEventListener('DOMContentLoaded', function() {
            // Check for stored sidebar state
            const storedState = localStorage.getItem('sidebarState');
            const body = document.body;
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            // Set initial state based on stored preference or default to closed
            if (storedState === 'open') {
                body.classList.remove('sidebar-closed');
                body.classList.add('sidebar-open');
                overlay.classList.remove('hidden');
            } else {
                body.classList.add('sidebar-closed');
                body.classList.remove('sidebar-open');
                overlay.classList.add('hidden');
            }

            // Set up toggle button
            const toggleButton = document.getElementById('sidebar-toggle');
            toggleButton.addEventListener('click', toggleSidebar);
        });

        function toggleSidebar() {
            const body = document.body;
            const overlay = document.getElementById('sidebar-overlay');

            if (body.classList.contains('sidebar-closed')) {
                // Open sidebar
                body.classList.remove('sidebar-closed');
                body.classList.add('sidebar-open');
                overlay.classList.remove('hidden');
                localStorage.setItem('sidebarState', 'open');
            } else {
                // Close sidebar
                body.classList.add('sidebar-closed');
                body.classList.remove('sidebar-open');
                overlay.classList.add('hidden');
                localStorage.setItem('sidebarState', 'closed');
            }
        }
    </script>
</body>
</html>