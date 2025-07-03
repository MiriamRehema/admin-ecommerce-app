<x-layout>
    <x-slot name="header">
        <h1>Users</h1>
    </x-slot>
    <div class="container">
        <div class='row justify-content-center'>
            <div class="card">
                <div class="card-header">{{__('Users')}}</div>
                <div class="card-body">
                    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Create New User</a>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

             
            </div>
            
            

        </div>

    </div>

    
</x-layout>