<?php

namespace App\Livewire\Roles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


use Livewire\Component;

class Index extends Component
{
    public function render()
    {
       
        return view('livewire.roles.index',[
              //dd($permissions),
             'roles' => Role::all(),
             'permissions'=>Permission::all()
        ]);
        
    }
}
