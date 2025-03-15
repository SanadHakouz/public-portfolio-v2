<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Personal Portfolio',
                'description' => 'Backend Technologies: PHP - The primary backend programming language Laravel 12 - PHP framework...',
                'github_link' => 'https://github.com/',
                'documentation_url' => null,
                'image_path' => 'projects/portfolio.png',
                'technologies' => ['PHP', 'Laravel', 'MySQL', 'Tailwind CSS', 'Livewire'],
                'is_completed' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Job-board',
                'description' => 'Backend: PHP 8.3 Laravel 11 Framework CRUD Authentication & Authorization Frontend: Blade...',
                'github_link' => 'https://github.com/',
                'documentation_url' => null,
                'image_path' => 'projects/job-board.png',
                'technologies' => ['PHP', 'Laravel', 'MySQL', 'Blade', 'Alpine.js'],
                'is_completed' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Laravel Site',
                'description' => 'Backend Technologies: PHP - The primary backend programming language Laravel 11 - PHP framework...',
                'github_link' => 'https://github.com/',
                'documentation_url' => null,
                'image_path' => 'projects/laravel-site.png',
                'technologies' => ['PHP', 'Laravel', 'MySQL', 'Tailwind CSS'],
                'is_completed' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Dynamic Business Portfolio with Laravel Livewire',
                'description' => 'Project Description: The Dynamic Business Portfolio is a web-based platform built with Laravel 12...',
                'github_link' => null,
                'documentation_url' => null,
                'image_path' => 'projects/dynamic-portfolio.png',
                'technologies' => ['PHP', 'Laravel', 'Livewire', 'MySQL', 'Tailwind CSS', 'Alpine.js'],
                'is_completed' => false,
                'is_active' => true,
            ],
            [
                'title' => 'University Student Management System (API-Based)',
                'description' => 'University Student Management System (API-Based) Project Description: The University Student Management System...',
                'github_link' => null,
                'documentation_url' => null,
                'image_path' => 'projects/university-system.png',
                'technologies' => ['PHP', 'Laravel', 'API', 'MySQL', 'React', 'Tailwind CSS'],
                'is_completed' => false,
                'is_active' => true,
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
