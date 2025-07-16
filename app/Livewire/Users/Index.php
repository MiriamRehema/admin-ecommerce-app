<?php

namespace App\Livewire\Users;

use App\Models\User;
use Spatie\Permission\Models\Role;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.users.index',[
            'users' => User::all(),
            'roles'=>Role::all(),
        ]);
    }
}
