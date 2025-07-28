<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
//use App\Models\Product;
//use App\Models\Category;

//use App\Models\OrderItem;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('orders.index');
        
       
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('orders.create');
        //dd($orders);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        //$users = User::all();
        $request->validate([
            'user_id'=>'required|exists:users,id',
            'grand_total'=>'required|numeric',
            'payment_method'=>'required|string|max:255',
            'payment_status'=>'required|string|max:255',

            'status'=>'required|string|max:255',
            'currency'=>'required|string|max:10',
            'shipping_amount'=>'required|numeric',
            'shipping_method'=>'required|string|max:255',
            'notes'=>'nullable|string|max:1000',

           
        ]);

        $order = Order::create([
            'user_id' => $request->user_id,
            'status' => $request->status,
            'grand_total' => $request->grand_total,
            'payment_method' => $request->payment_method,
            'payment_status' => $request->payment_status,
            'currency' => $request->currency,
            'shipping_amount' => $request->shipping_amount,
            'shipping_method' => $request->shipping_method,
            'notes' => $request->notes,
            'created_at' => now(),
            'updated_at' => now(),
        ])->load('user'); // Load the user relationship

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
