<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => 'Web Development',
                'description' => 'Custom web solutions using modern technologies to create responsive, user-friendly applications',
                'image' => 'images/services/service1.jpg',
                'order' => 1,
                'active' => true,
            ],
            [
                'title' => 'Cybersecurity Technician',
                'description' => 'Protecting your digital assets with comprehensive security assessments, threat mitigation, and ongoing monitoring',
                'image' => 'images/services/service2.jpg',
                'order' => 2,
                'active' => true,
            ],
            [
                'title' => 'Graduation Projects',
                'description' => 'Mentoring and support for academic projects, helping students deliver impressive final year projects',
                'image' => 'images/services/service3.jpg',
                'order' => 3,
                'active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
