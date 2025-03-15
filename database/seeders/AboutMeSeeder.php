<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutMe;

class AboutMeSeeder extends Seeder
{
    public function run(): void
    {
        AboutMe::create([
            'name' => 'PEPE',
            'location' => 'XXX, XXX',
            'profile_image' => 'images/profile.jpg',
            'job_title' => 'Junior Laravel Developer & Cybersecurity Technician',
            'bio' => "xxxxxxxxxxxxxxxxxx",
            'resume_file' => null, // Changed from resume_link
            'certificates' => [
                [
                    'name' => 'Certified Cybersecurity Technician V1',
                    'link' => '#'
                ]
            ],
            'ongoing_courses' => [
                [
                    'name' => 'Scrum Master',
                    'link' => '#'
                ],
                [
                    'name' => 'ITIL-4 Foundation',
                    'link' => '#'
                ]
            ],
            'completed_courses' => [
                [
                    'name' => 'Master Laravel 11 & PHP: From Beginner to Advanced',
                    'link' => '#'
                ],
                [
                    'name' => 'Mastering PHP Laravel 11 Build Dynamic Website From Scratch',
                    'link' => '#'
                ],
                [
                    'name' => 'Full Stack Web Development: Web From Zero with PHP 2022',
                    'link' => '#'
                ]
            ],
            'languages' => [
                [
                    'language' => 'Arabic',
                    'proficiency' => 'Native'
                ],
                [
                    'language' => 'English',
                    'proficiency' => 'Fluent'
                ],
                [
                    'language' => 'Deutsch',
                    'proficiency' => 'B1'
                ]
            ]
        ]);
    }
}
