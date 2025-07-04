@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Create Product') }}</div>

                <div class="card-body">
                    <a href="{{ route('products.index') }}" class="btn btn-info">Back</a>
                    <form method="POST" action="{{route('products.store')}}">
                    @csrf

                    
                    
                    <div class="mt-2">
                        <label>Name:</label>
                        <input type="name" name="name" class="form-control">
                        @error('name')
                        
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-2">
                    <button class="btn btn-success">Submit</button>
                    </div>
                    </form>



                    </div>


                
                   
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
