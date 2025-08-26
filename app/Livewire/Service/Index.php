<?php

namespace App\Livewire\Service;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithFileUploads;

    public $mode = 'index';

    public $services;
    public $selectedService;

    public $name;
    public $slug;
    public $description;
    public $price;
    public $status = true;
    public $image;
     // use this directly for upload + display

    public $search = '';
    public $confirmingDelete = false;
    public $serviceToDelete;

    public function render()
    {
        $this->services = Service::query()
            ->when($this->search, fn($query) =>
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%'))
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.service.index');
    }

    public function resetForm()
    {
        $this->reset([
            'name', 'slug', 'description', 'price', 'status',
            'selectedService', 'image'
        ]);
    }

    public function create()
    {
        $this->resetForm();
        $this->mode = 'create';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:service,slug',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|max:2048',
        ]);

        
        Service::create([
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'status' => $this->status,
            'image' => $this->image ? $this->image->store('categories', 'public') : null,
        ]);

        $this->mode = 'index';
        session()->flash('message', 'Service created successfully.');
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);

        $this->selectedService = $service;
        $this->name = $service->name;
        $this->slug = $service->slug;
        $this->description = $service->description;
        $this->price = $service->price;
        $this->status = $service->status;
        $this->image = $service->image;
    

        $this->mode = 'edit';
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:service,slug,' . $this->selectedService->id,
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|max:2048',
        ]);

        $service = $this->selectedService;
        $service->update([
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'status' => $this->status,
            'image' => $this->image ? $this->image->store('categories', 'public') : $service->image,
        ]);

        $this->mode = 'index';
        session()->flash('message', 'Service updated successfully.');
    }

    public function show($id)
    {
        $this->selectedService = Service::findOrFail($id);
        $this->image = $this->selectedService->image;
        $this->mode = 'show';
    }

    public function confirmDelete($id)
    {
        $this->confirmingDelete = true;
        $this->serviceToDelete = $id;
    }

    public function deleteConfirmed()
    {
        $service = Service::findOrFail($this->serviceToDelete);

        
        

        $this->confirmingDelete = false;
        $this->serviceToDelete = null;
        $this->mode = 'index';

        session()->flash('message', 'Service deleted successfully.');
    }
}
