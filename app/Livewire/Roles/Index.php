<?php

namespace App\Livewire\Roles;
use Spatie\Permission\Models\Role;


use Livewire\Component;

class Index extends Component
{
    public function render()
    {
       
        return view('livewire.roles.index',[
            'roles' => Role::all()
        ]);
        
    }
}
