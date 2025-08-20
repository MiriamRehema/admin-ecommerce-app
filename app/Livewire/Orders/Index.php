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
    public $mode = 'index';
    public $orders;
    public $confirmingDelete = false;
    public $selectedOrder;
    public $orderItems = [];

     public $user_id, $payment_method, $payment_status, $status, $shipping_amount, $notes;

     public $users = [];  // E.g., for dropdown
     public $products = []; // For product dropdown in items

     public $orderIdBeingDeleted;

     public function mount()
    {
    $this->orders = Order::with('user')->get();
    $this->users = User::all();
    $this->products = Product::all();
    }

    public function create()
    {
    $this->resetForm();
    $this->mode = 'create';
    }

    public function store()
    {
    $this->validate([
        'user_id' => 'required|exists:users,id',
        'payment_method' => 'required',
        'payment_status' => 'required',
        'status' => 'required',
        'shipping_amount' => 'required|numeric',
        'orderItems' => 'required|array|min:1',
    ]);

    $order = Order::create([
        'user_id' => $this->user_id,
        'payment_method' => $this->payment_method,
        'payment_status' => $this->payment_status,
        'status' => $this->status,
        'shipping_amount' => $this->shipping_amount,
        'notes' => $this->notes,
        'grand_total' => collect($this->orderItems)->sum('total_amount'),
    ]);

    foreach ($this->orderItems as $item) {
        $order->items()->create($item);
    }

    $this->orders = Order::with('user')->get();
    $this->mode = 'index';
     }

    public function edit($id)
    {
    $order = Order::with('items')->findOrFail($id);

    $this->fill([
        'user_id' => $order->user_id,
        'payment_method' => $order->payment_method,
        'payment_status' => $order->payment_status,
        'status' => $order->status,
        'shipping_amount' => $order->shipping_amount,
        'notes' => $order->notes,
        'orderItems' => $order->items->toArray(),
        'mode' => 'edit',
        'selectedOrder' => $order,
    ]);
    }
    public function update()
{
    $this->validate([
        'user_id' => 'required|exists:users,id',
        'payment_method' => 'required',
        'payment_status' => 'required',
        'status' => 'required',
        'shipping_amount' => 'required|numeric',
        'orderItems' => 'required|array|min:1',
    ]);

    $order = Order::findOrFail($this->selectedOrder->id);

    $order->update([
        'user_id' => $this->user_id,
        'payment_method' => $this->payment_method,
        'payment_status' => $this->payment_status,
        'status' => $this->status,
        'shipping_amount' => $this->shipping_amount,
        'notes' => $this->notes,
        'grand_total' => collect($this->orderItems)->sum('total_amount'),
    ]);

    // Optional: Delete old items before re-adding
    $order->items()->delete();

    foreach ($this->orderItems as $item) {
        $order->items()->create($item);
    }

    $this->orders = Order::with('user')->get();
    $this->mode = 'index';
}


    public function show($id)
     {
    $this->selectedOrder = Order::with('items.product', 'user')->findOrFail($id);
    $this->mode = 'show';
     }
     public function removeItem($index)
{
    unset($this->orderItems[$index]);
    $this->orderItems = array_values($this->orderItems); // Reindex to prevent key gaps
}

     public function confirmDelete($id)
    {
    $this->orderIdBeingDeleted = $id;
    $this->confirmingDelete = true;
    }

    public function deleteConfirmed()
    {
    Order::findOrFail($this->orderIdBeingDeleted)->delete();
    $this->orders = Order::with('user')->get();
    $this->confirmingDelete = false;
    }

    public function addItem()
    {
    $this->orderItems[] = [
        'product_id' => '',
        'quantity' => 1,
        'unit_amount' => 0,
        'total_amount' => 0,
    ];
    }

     public function resetForm()
    {
    $this->reset([
        'user_id',
        'payment_method',
        'payment_status',
        'status',
        'shipping_amount',
        'notes',
        'orderItems',
        'selectedOrder',
    ]);
    $this->orderItems = [[]];
    }
    public function render()
   {
    return view('livewire.orders.index', [
        'orders' => $this->orders,
        'users' => $this->users,
        'products' => $this->products,
    ]);
}
}
