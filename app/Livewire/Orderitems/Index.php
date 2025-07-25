<?php

namespace App\Livewire\Orderitems;
use App\Models\OrderItem;
use App\Models\Order;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.orderitems.index',
        [
            'orderitems' => OrderItem::all(),
            'orders' => Order::all()
        ]);
    }
}
