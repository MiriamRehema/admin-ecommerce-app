@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Show Product') }}</div>

                <div class="card-body">
                    <a href="{{ route('products.index') }}" class="btn btn-info">Back</a>
                    <p><strong>Name:</strong>{{$product->name}}</p>
                    <!-- <p><strong>Price:</strong>{{$product->price}}</p> -->
                    



                    </div>


                
                   
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
