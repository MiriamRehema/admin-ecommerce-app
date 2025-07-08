<?php

namespace App\Livewire\Products;
use  \App\Models\Product;
use Livewire\Component;

// use App\Http\Requests\ProductRequest; // If you have a custom request for validation 

class Index extends Component
{
    public function render()
    {
        $products = Product::all();
        return view('livewire.products.index', compact('products'));

    }
    // public function create()
    // {
    //      return view('products.create');
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name'=>'required',
            
            
    //     ]

    //     );
    //     Product::create([
    //         'name'=>$request->name,
           
    //     ]);
    //     return redirect()->route('products.index')
    //            ->with("success","Product created successfully");
    //     //,dd($request->all());
    // }
    

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(string $id)
    // {
    //     $product =Product::find($id);
    //     return view('products.show',compact('product'));
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(string $id)
    // {
    //      $product =Product::find($id);
    //     return view('products.edit',compact("product"));
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, string $id)
    // {
    //     $request->validate([
    //         'name'=>'required',
            
            
    //     ]
    //     );
    //     $product = Product::find($id);

    //     $product->name=$request->name;

    //     $product->save();

    //      return redirect()->route('products.index')
    //            ->with("success","Product updated successfully.");
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(string $id)
    // {
    //     $product=Product::find($id);
    //     $product->delete();

    //     return redirect()->route('products.index')
    //            ->with("success","Successfully Deleted.");
    // }
}
