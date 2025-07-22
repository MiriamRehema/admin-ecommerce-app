<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
     public function __construct()
{
    // examples:
    $this->middleware(['permission:product-list|product-create|product-edit|product-delete'])->only(['index', 'show']);
    $this->middleware(['permission:product-edit'])->only(['edit', 'update']);
    $this->middleware(['permission:product-create'])->only(['create', 'store']);
    $this->middleware(['permission:product-delete'])->only(['destroy']);

}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return view('products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'name'=>'required',
            
            
        ]

        );
        Product::create([
            'name'=>$request->name,
           
        ]);
        return redirect()->route('products.index')
               ->with("success","Product created successfully");
        //,dd($request->all());
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product =Product::find($id);
        //dd($product);
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $product =Product::find($id);
        return view('products.edit',compact("product"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'required',
            
            
        ]
        );
        $product = Product::find($id);

        $product->name=$request->name;

        $product->save();

         return redirect()->route('products.index')
               ->with("success","Product updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product=Product::find($id);
        $product->delete();

        return redirect()->route('products.index')
               ->with("success","Successfully Deleted.");
    }
}
