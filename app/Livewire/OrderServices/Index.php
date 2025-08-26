<?php

namespace App\Livewire\OrderServices;

use Livewire\Component;
use App\Models\OrderService;
use App\Models\Service;

class Index extends Component
{
    public function render()
    {
        return view('livewire.order-services.index',[
            'order_services' => OrderService::all(),
            'services' => Service::all()
        ]);
    }
}
