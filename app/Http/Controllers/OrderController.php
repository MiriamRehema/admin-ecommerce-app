<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem; // Include the OrderItem model
use App\Models\User;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('orderItems')->get(); // Load orders with their items
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $users=User::all(); // Get all users for the select input
        return view('orders.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        //$this->authorize('order-create');
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'grand_total' => 'required|numeric',
            'payment_method' => 'required|string|max:255',
            'payment_status' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'shipping_amount' => 'required|numeric',
            'notes' => 'nullable|string|max:1000',
            'order_items' => 'required|array', // Validate order items
            'order_items.*.product_id' => 'required|exists:products,id', // Validate each item
            'order_items.*.quantity' => 'required|numeric|min:1', // Validate quantity
            'order_items.*.unit_amount' => 'required|numeric|min:0', // Validate unit amount
        ]);

        // Create the order
        $order = Order::create([
            'user_id' => $request->user_id,
            'status' => $request->status,
            'grand_total' => $request->grand_total,
            'payment_method' => $request->payment_method,
            'payment_status' => $request->payment_status,
            'shipping_amount' => $request->shipping_amount,
            'notes' => $request->notes,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create order items
        foreach ($request->order_items as $item) {
            $order->orderItems()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_amount' => $item['unit_amount'],
                'total_amount' => $item['quantity'] * $item['unit_amount'], // Calculate total amount
            ]);
        }

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::with('orderItems')->findOrFail($id); // Load order with items
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = Order::with('orderItems')->findOrFail($id); // Load order with items
        $users = User::all(); // Get all users for the select input
        return view('orders.edit', compact('order', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'grand_total' => 'required|numeric',
            'payment_method' => 'required|string|max:255',
            'payment_status' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'shipping_amount' => 'required|numeric',
            'notes' => 'nullable|string|max:1000',
            'order_items' => 'required|array',
            'order_items.*.product_id' => 'required|exists:products,id',
            'order_items.*.quantity' => 'required|numeric|min:1',
            'order_items.*.unit_amount' => 'required|numeric|min:0',
        ]);

        $order->update([
            'user_id' => $request->user_id,
            'status' => $request->status,
            'grand_total' => $request->grand_total,
            'payment_method' => $request->payment_method,
            'payment_status' => $request->payment_status,
            'shipping_amount' => $request->shipping_amount,
            'notes' => $request->notes,
            'updated_at' => now(),
        ]);

        // Update order items
        $order->orderItems()->delete(); // Remove existing items
        foreach ($request->order_items as $item) {
            $order->orderItems()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_amount' => $item['unit_amount'],
                'total_amount' => $item['quantity'] * $item['unit_amount'],
            ]);
        }

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete(); // Delete the order and its items if necessary
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}