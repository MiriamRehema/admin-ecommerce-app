<?php

namespace App\Livewire\Categories;
use App\Models\Category;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.categories.index', [
            'categories' => Category::all()
        ]);
    }
}
