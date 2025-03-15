<?php

namespace App\Livewire;

use App\Models\Technology;
use Livewire\Component;

class ShowTechnologies extends Component
{
    public function render()
    {
        $technologies = Technology::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('livewire.show-technologies', [
            'technologies' => $technologies,
        ]);
    }
}
