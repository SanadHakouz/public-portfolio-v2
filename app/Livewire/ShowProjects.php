<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;

class ShowProjects extends Component
{
    public function render()
    {
        // Get completed and upcoming projects separately
        $completedProjects = Project::completed()->get();
        $upcomingProjects = Project::upcoming()->get();

        return view('livewire.show-projects', [
            'completedProjects' => $completedProjects,
            'upcomingProjects' => $upcomingProjects,
        ]);
    }
}
