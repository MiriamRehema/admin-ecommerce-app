@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Create User') }}</div>

                <div class="card-body">
                    <a href="{{ route('users.index') }}" class="btn btn-info">Back</a>
                    <form method="POST" action="{{route('users.store')}}">
                    @csrf

                    
                    
                    <div class="mt-2">
                        <label>Name:</label>
                        <input type="name" name="name" class="form-control">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label>Email:</label>
                        <input type="email" name="email" class="form-control">
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label>Password:</label>
                        <input type="password" name="password" class="form-control">
                        @error('password')
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
