<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutMe;

class AboutMeSeeder extends Seeder
{
    public function run(): void
    {
        AboutMe::create([
            'name' => 'Sanad Hakooz',
            'location' => 'Doha, Qatar',
            'profile_image' => 'images/profile.jpg',
            'job_title' => 'Junior Laravel Developer & Cybersecurity Technician',
            'bio' => "My name is Sanad Hakooz, a Jordanian residing in Doha, Qatar. I hold a bachelor's degree in Computer Science from German Jordanian University.\n\nI am a junior Laravel developer with experience in building web applications using Laravel, Breeze, and Livewire, as well as developing RESTful APIs.\n\nAdditionally, I am (almost) a certified cybersecurity technician.\n\n(P.S. If you use JavaScript, we can't be friends. 😜)",
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
