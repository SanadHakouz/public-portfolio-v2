<?php

namespace App\Livewire\Admin;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProjectManager extends Component
{
    use WithFileUploads;

    public $projects = [];
    public $editingProjectId = null;
    public $showForm = false;

    // Form properties
    public $title;
    public $description;
    public $github_link;
    public $documentation_url; // Changed from new_documentation
    public $new_image;
    public $technologies = [];
    public $is_completed = true;
    public $is_active = true;

    // For adding technologies
    public $new_technology = '';

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'github_link' => 'nullable|url|max:255',
        'documentation_url' => 'nullable|url|max:1000', // Changed rule for URL
        'new_image' => 'nullable|image|max:40960',
        'technologies' => 'nullable|array',
        'is_completed' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function mount()
    {
        $this->refreshProjects();
    }

    public function refreshProjects()
    {
        $this->projects = Project::latest()->get()->toArray();
    }

    public function create()
    {
        $this->resetForm();
        $this->showForm = true;
        $this->editingProjectId = null;
    }

    public function edit($id)
    {
        $this->editingProjectId = $id;
        $project = Project::findOrFail($id);

        $this->title = $project->title;
        $this->description = $project->description;
        $this->github_link = $project->github_link;
        $this->documentation_url = $project->documentation_url; // Changed
        $this->technologies = $project->technologies ?? [];
        $this->is_completed = $project->is_completed;
        $this->is_active = $project->is_active;

        $this->showForm = true;
    }

    public function save()
{
    try {
        $this->validate();

        if ($this->editingProjectId) {
            $project = Project::findOrFail($this->editingProjectId);
        } else {
            $project = new Project();
        }

        $project->title = $this->title;
        $project->description = $this->description;
        $project->github_link = $this->github_link;
        $project->documentation_url = $this->documentation_url;
        $project->technologies = $this->technologies;
        $project->is_completed = $this->is_completed;
        $project->is_active = $this->is_active;

        // Handle image upload
        if ($this->new_image) {
            if ($project->image_path) {
                Storage::delete($project->image_path);
            }
            $imagePath = $this->new_image->store('projects', 'public');
            Log::info("Project image stored at: " . $imagePath);
            $project->image_path = $imagePath;
        }

        $project->save();

        $this->refreshProjects();
        $this->resetForm();
        $this->showForm = false;

        session()->flash('message', $this->editingProjectId ? 'Project updated successfully!' : 'Project created successfully!');
    } catch (\Exception $e) {
        // Log the exception
        Log::error("Project save failed: " . $e->getMessage());
        session()->flash('error', 'Failed to save project: ' . $e->getMessage());
    }
}

    public function delete($id)
    {
        $project = Project::findOrFail($id);

        // Delete associated image
        if ($project->image_path) {
            Storage::delete($project->image_path);
        }

        // No longer need to delete documentation file

        $project->delete();
        $this->refreshProjects();
        session()->flash('message', 'Project deleted successfully!');
    }

    public function addTechnology()
    {
        if (empty($this->new_technology)) {
            return;
        }

        if (!is_array($this->technologies)) {
            $this->technologies = [];
        }

        $this->technologies[] = $this->new_technology;
        $this->new_technology = '';
    }

    public function removeTechnology($index)
    {
        if (isset($this->technologies[$index])) {
            unset($this->technologies[$index]);
            $this->technologies = array_values($this->technologies);
        }
    }

    public function toggleStatus($id)
    {
        $project = Project::findOrFail($id);
        $project->is_active = !$project->is_active;
        $project->save();

        $this->refreshProjects();
    }

    public function toggleCompleted($id)
    {
        $project = Project::findOrFail($id);
        $project->is_completed = !$project->is_completed;
        $project->save();

        $this->refreshProjects();
    }

    public function cancel()
    {
        $this->resetForm();
        $this->showForm = false;
    }

    private function resetForm()
    {
        $this->editingProjectId = null;
        $this->title = '';
        $this->description = '';
        $this->github_link = '';
        $this->documentation_url = ''; // Changed
        $this->new_image = null;
        $this->technologies = [];
        $this->is_completed = true;
        $this->is_active = true;
        $this->new_technology = '';
    }

    public function render()
    {
        return view('livewire.admin.project-manager');
    }
}
