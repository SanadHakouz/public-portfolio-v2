<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;

class ServiceForm extends Component
{
    use WithFileUploads;

    public $serviceId;
    public $title;
    public $description;
    public $order;
    public $active = true;
    public $image;
    public $currentImage;

    public function mount($serviceId)
    {
        if ($serviceId !== 'new') {
            $service = Service::find($serviceId);
            $this->serviceId = $service->id;
            $this->title = $service->title;
            $this->description = $service->description;
            $this->order = $service->order;
            $this->active = $service->active;
            $this->currentImage = $service->image;
        }
    }

    public function save()
    {
        $this->validate([
            'title' => 'nullable',
            'description' => 'required',
            'order' => 'required|integer|min:0',
            'image' => $this->serviceId === 'new' ? 'required|image|max:1024' : 'nullable|image|max:1024',
        ]);

        if ($this->serviceId === 'new') {
            $service = new Service();
        } else {
            $service = Service::find($this->serviceId);
        }

        $service->title = $this->title;
        $service->description = $this->description;
        $service->order = $this->order;
        $service->active = $this->active;

        if ($this->image) {
            // Store the image in the public disk
            $imagePath = $this->image->store('images/services', 'public');

            // Remove old image if it exists and isn't the default
            if ($this->currentImage && $service->id && Storage::disk('public')->exists($this->currentImage)) {
                Storage::disk('public')->delete($this->currentImage);
            }

            $service->image = $imagePath;
        }

        $service->save();

        $this->dispatch('serviceUpdated');
        $this->dispatch('closeForm');
    }

    public function render()
    {
        return view('livewire.admin.service-form');
    }
}
