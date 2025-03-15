<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\AboutMe;

class AboutMeSection extends Component
{
    public function render()
    {
        $aboutMe = AboutMe::first();

        return view('livewire.about-me-section', [
            'aboutMe' => $aboutMe
        ]);
    }
}
