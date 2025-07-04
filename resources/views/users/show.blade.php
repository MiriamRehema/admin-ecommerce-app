@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Show User') }}</div>

                <div class="card-body">
                    <a href="{{ route('users.index') }}" class="btn btn-info">Back</a>
                    <p><strong>Name:</strong>{{$user->name}}</p>
                    <p><strong>Email:</strong>{{$user->email}}</p>
                    



                    </div>


                
                   
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
