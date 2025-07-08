<!-- 

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Update Product') }}</div>
                @foreach($products as $product)
                <div class="card-body">
                    
                    <a href="{{ route('products.index') }}" class="btn btn-info">Back</a>
                    <form method="POST" action="{{route('products.update', $product->id)}}">

                    
                    @csrf
                    @method('PUT')

                    
                    
                    <div class="mt-2">
                        <label>Name:</label>
                        <input type="name" name="name" class="form-control" value="{{ $product->name}}">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                @endforeach

                    </div>
                    <div class="mt-2">
                    <button class="btn btn-success">Update</button>
                    </div>
                    </form>



                    </div>


                
                   
                   
                </div>
            </div>
        </div>
    </div>
</div> -->
