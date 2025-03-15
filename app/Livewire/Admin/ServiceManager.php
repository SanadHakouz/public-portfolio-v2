<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;

class ServiceManager extends Component
{
    protected $listeners = ['serviceUpdated' => '$refresh'];

    public $editingServiceId = null;
    public $confirmingDelete = null;

    public function editService($id)
    {
        $this->editingServiceId = $id;
    }

    public function createNewService()
    {
        $this->editingServiceId = 'new';
    }

    public function cancelEdit()
    {
        $this->editingServiceId = null;
    }

    public function toggleActive($id)
    {
        $service = Service::find($id);
        $service->active = !$service->active;
        $service->save();
    }

    public function confirmDelete($id)
    {
        $this->confirmingDelete = $id;
    }

    public function cancelDelete()
    {
        $this->confirmingDelete = null;
    }

    public function deleteService()
    {
        $service = Service::find($this->confirmingDelete);

        // Delete the image file if it exists
        if ($service->image && Storage::disk('public')->exists($service->image)) {
            Storage::disk('public')->delete($service->image);
        }

        // Delete the service
        $service->delete();

        $this->confirmingDelete = null;
    }

    public function render()
    {
        return view('livewire.admin.service-manager', [
            'services' => Service::orderBy('order')->get()
        ]);
    }
}
