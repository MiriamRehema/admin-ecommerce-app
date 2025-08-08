<?php

namespace App\Livewire\Service;


use Livewire\Component;
use App\Models\Service;


class Index extends Component
{
    public function render()
    {
       return view('livewire.service.index',[
            'services' => Service::all(),
            
        ]);
    }
}
