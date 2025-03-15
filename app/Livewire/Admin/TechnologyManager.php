<?php

namespace App\Livewire\Admin;

use App\Models\Technology;
use Livewire\Component;
use Livewire\WithFileUploads;

class TechnologyManager extends Component
{
    use WithFileUploads;

    public $technologies = [];
    public $editingTechnologyId = null;
    public $showForm = false;

    // Form properties
    public $category;
    public $title;
    public $icon;
    public $order;
    public $is_active = true;
    public $items = [];

    // For adding/editing items
    public $newItemName = '';
    public $newItemChecked = true;

    protected $rules = [
        'category' => 'required|string|max:255',
        'title' => 'required|string|max:255',
        'icon' => 'nullable|string|max:255',
        'order' => 'required|integer|min:0',
        'is_active' => 'boolean',
        'items' => 'array',
    ];

    public function mount()
    {
        $this->refreshTechnologies();
    }

    public function refreshTechnologies()
    {
        $this->technologies = Technology::orderBy('order')->get()->toArray();
    }

    public function create()
    {
        $this->resetForm();
        $this->showForm = true;
        $this->editingTechnologyId = null;
    }

    public function edit($id)
    {
        $this->editingTechnologyId = $id;
        $technology = Technology::findOrFail($id);

        $this->category = $technology->category;
        $this->title = $technology->title;
        $this->icon = $technology->icon;
        $this->order = $technology->order;
        $this->is_active = $technology->is_active;
        $this->items = $technology->getItemsArray();

        $this->showForm = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->editingTechnologyId) {
            $technology = Technology::findOrFail($this->editingTechnologyId);
        } else {
            $technology = new Technology();
        }

        $technology->category = $this->category;
        $technology->title = $this->title;
        $technology->icon = $this->icon;
        $technology->order = $this->order;
        $technology->is_active = $this->is_active;
        $technology->items = $this->items;

        $technology->save();

        $this->refreshTechnologies();
        $this->resetForm();
        $this->showForm = false;

        session()->flash('message', $this->editingTechnologyId ? 'Technology updated successfully!' : 'Technology created successfully!');
    }

    public function delete($id)
    {
        Technology::findOrFail($id)->delete();
        $this->refreshTechnologies();
        session()->flash('message', 'Technology deleted successfully!');
    }

    public function addItem()
    {
        if (empty($this->newItemName)) {
            return;
        }

        $this->items[] = [
            'name' => $this->newItemName,
            'is_checked' => $this->newItemChecked,
        ];

        $this->newItemName = '';
        $this->newItemChecked = true;
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }

    public function toggleActiveStatus($id)
    {
        $technology = Technology::findOrFail($id);
        $technology->is_active = !$technology->is_active;
        $technology->save();

        $this->refreshTechnologies();
    }

    public function moveUp($id)
    {
        $technology = Technology::findOrFail($id);
        $prevTech = Technology::where('order', '<', $technology->order)
            ->orderBy('order', 'desc')
            ->first();

        if ($prevTech) {
            $currentOrder = $technology->order;
            $technology->order = $prevTech->order;
            $prevTech->order = $currentOrder;

            $technology->save();
            $prevTech->save();

            $this->refreshTechnologies();
        }
    }

    public function moveDown($id)
    {
        $technology = Technology::findOrFail($id);
        $nextTech = Technology::where('order', '>', $technology->order)
            ->orderBy('order', 'asc')
            ->first();

        if ($nextTech) {
            $currentOrder = $technology->order;
            $technology->order = $nextTech->order;
            $nextTech->order = $currentOrder;

            $technology->save();
            $nextTech->save();

            $this->refreshTechnologies();
        }
    }

    public function cancel()
    {
        $this->resetForm();
        $this->showForm = false;
    }

    private function resetForm()
    {
        $this->editingTechnologyId = null;
        $this->category = '';
        $this->title = '';
        $this->icon = '';
        $this->order = count($this->technologies);
        $this->is_active = true;
        $this->items = [];
        $this->newItemName = '';
        $this->newItemChecked = true;
    }

    public function render()
    {
        return view('livewire.admin.technology-manager');
    }
}
