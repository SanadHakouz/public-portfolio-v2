<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = [
            [
                'category' => 'Frontend Development',
                'title' => 'Frontend Development',
                'icon' => 'computer',
                'order' => 1,
                'is_active' => true,
                'items' => [
                    ['name' => 'HTML, CSS, Bootstrap, Tailwind CSS', 'is_checked' => true],
                    ['name' => 'JavaScript (Basic)', 'is_checked' => true],
                    ['name' => 'React', 'is_checked' => true],
                ],
            ],
            [
                'category' => 'Backend Development',
                'title' => 'Backend Development',
                'icon' => 'server',
                'order' => 2,
                'is_active' => true,
                'items' => [
                    ['name' => 'PHP, Laravel (Blade, Breeze, Livewire)', 'is_checked' => true],
                    ['name' => 'RESTful APIs', 'is_checked' => true],
                ],
            ],
            [
                'category' => 'Databases',
                'title' => 'Databases',
                'icon' => 'database',
                'order' => 3,
                'is_active' => true,
                'items' => [
                    ['name' => 'MySQL, SQLite', 'is_checked' => true],
                ],
            ],
            [
                'category' => 'Mobile Development',
                'title' => 'Mobile Development',
                'icon' => 'smartphone',
                'order' => 4,
                'is_active' => true,
                'items' => [
                    ['name' => 'Flutter, Dart', 'is_checked' => true],
                ],
            ],
            [
                'category' => 'DevOps & Tools',
                'title' => 'DevOps & Tools',
                'icon' => 'tools',
                'order' => 5,
                'is_active' => true,
                'items' => [
                    ['name' => 'Git, Docker, Postman, Herd', 'is_checked' => true],
                ],
            ],
        ];

        foreach ($technologies as $tech) {
            Technology::create($tech);
        }
    }
}
