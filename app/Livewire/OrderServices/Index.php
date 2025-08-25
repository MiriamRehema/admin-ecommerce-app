<?php

namespace App\Livewire\OrderServices;

use Livewire\Component;
use App\Models\Order_Service;
use App\Models\Service;

class Index extends Component
{
    public function render()
    {
        return view('livewire.order-services.index',[
            'order_services' => Order_Service::all(),
            'services' => Service::all()
        ]);
    }
}
