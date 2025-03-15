<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class HomeProjects extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    // Listen for pagination events
    protected $listeners = ['paginationChanged'];

    // Store scroll position when pagination changes
    public function paginationChanged()
    {
        $this->dispatch('maintainScroll');
    }

    public function render()
    {
        // Get completed projects
        $completedProjects = Project::where('is_active', true)
            ->where('is_completed', true)
            ->latest()
            ->paginate(3, ['*'], 'completed');

        // Get upcoming projects
        $upcomingProjects = Project::where('is_active', true)
            ->where('is_completed', false)
            ->latest()
            ->paginate(3, ['*'], 'upcoming');

        return view('livewire.home-projects', [
            'completedProjects' => $completedProjects,
            'upcomingProjects' => $upcomingProjects,
        ]);
    }
}
