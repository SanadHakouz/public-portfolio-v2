<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Service;

class ServicesSection extends Component
{
    public function render()
    {
        $services = Service::where('active', true)
            ->orderBy('order')
            ->get();

        return view('livewire.services-section', [
            'services' => $services
        ]);
    }
}
