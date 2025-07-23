<?php

namespace App\Livewire\Orders;
use App\Models\Order;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.orders.index', [
            'orders' => Order::all()
        ]);
    }
}
