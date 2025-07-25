<?php

namespace App\Livewire\Orders;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.orders.index', [
            'orders' => Order::all(),
            'orderitems' => OrderItem::all(),
            'products' => Product::all(),
            'categories' => Category::all(),
            'users' => User::all(),
        ]);
    }
}
