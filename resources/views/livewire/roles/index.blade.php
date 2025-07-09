
   <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Roles') }}</div>


                <div class="card-body">
                   @if (session('success'))
                    <div class="alert alert-success">
                    {{ session('success') }}
                    </div>
                    @endif
                    <a href="{{ route('roles.create') }}" class="btn btn-success mb-3">Add Roles</a>
                
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    
                                    <td>{{ $role->created_at->format('Y-m-d H:i') }}</td>
                                    <td>
                                        <form method="POST" action="{{route('roles.destroy', $role->id)}}" >
                                            @csrf
                                            @method('DELETE')
                                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <a href="{{ route('roles.show', $role->id) }}" class="btn btn-info btn-sm">Show</a>  
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


