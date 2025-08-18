<?php

namespace App\Livewire\Categories;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public $categories, $name, $slug, $description, $is_active = true, $image;
    public $mode = 'index';
    public $categoryIdBeingEdited;

    public $confirmingDelete = false;
    public $categoryToDelete=null;

    public function mount()
    {
        $this->loadCategories();
    }

    public function loadCategories()
    {
        $this->categories = Category::latest()->get();
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
            'slug' => 'required|string|unique:categories,slug',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
        ]);

        $category = new Category();
        $category->name = $this->name;
        $category->slug = $this->slug;
        $category->description = $this->description;
        $category->is_active = $this->is_active;

        if ($this->image) {
            $category->image = $this->image->store('categories', 'public');
        }

        $category->save();

        session()->flash('success', 'Category created successfully!');
        $this->resetForm();
        $this->loadCategories();
        $this->mode = 'index';
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        $this->fill($category->toArray());
        $this->image = $category->image;
        $this->categoryIdBeingEdited = $id;
        $this->mode = 'show';
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->fill($category->toArray());
        $this->image = null;
        $this->categoryIdBeingEdited = $id;
        $this->mode = 'edit';
    }

    public function update()
    {
        $category = Category::findOrFail($this->categoryIdBeingEdited);

        $this->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:categories,slug,' . $category->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image',
        ]);

        $category->name = $this->name;
        $category->slug = $this->slug;
        $category->description = $this->description;
        $category->is_active = $this->is_active;

        if ($this->image) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $category->image = $this->image->store('categories', 'public');
        }

        $category->save();

        session()->flash('success', 'Category updated!');
        $this->resetForm();
        $this->loadCategories();
        $this->mode = 'index';
    }

    public function confirmDelete($id)
{
    $this->categoryToDeleteId = $id;
    $this->confirmingDelete = true;
}
    public function deleteConfirmed()
    {
         $category = Category::findOrFail($this->categoryToDeleteId);

    // Delete the image if exists
    if ($category->image && Storage::disk('public')->exists($category->image)) {
        Storage::disk('public')->delete($category->image);
    }

    $category->delete();

    $this->confirmingDelete = false;
    $this->categoryToDeleteId = null;

    session()->flash('success', 'Category deleted!');
    $this->loadCategories(); // reload list

    }

    public function resetForm()
    {
        $this->reset(['name', 'slug', 'description', 'is_active', 'image', 'categoryIdBeingEdited']);
    }

    public function render()
    {
        return view('livewire.categories.index');
    }
}
