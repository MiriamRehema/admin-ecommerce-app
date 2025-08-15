<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class Index extends Component
{
    public $users;
    public $user_id;
    public $allRoles;
    public $name, $email, $password, $selectedRoles = [], $is_active = true;
    public $mode = 'index'; // can be 'index', 'create', 'edit', 'show'
    public $updatedUserId;

    public $confirmingDelete = false;
    public $userToDelete;

    public function mount()
    {
        $this->allRoles = Role::all();

        $this->loadUsers();
    }
    public function updatedUserId($value)
{
      logger('updatedUserId triggered', ['value' => $value]);
    $this->user_id=$value;
    $this->loadUsers(); 
    //dd('Selected user_id = ' . $value);// Reload users list when selection changes
    
}
    public function loadUsers()
{
    $this->users = User::with('roles')
        ->when($this->user_id, fn($query) => $query->where('id', $this->user_id))
        ->get();
}

    

    public function show($id)
    {
        $this->selectedUser = User::with('roles')->findOrFail($id);
        $this->mode = 'show';
    }

    public function edit($id)
    {
        $user = User::with('roles')->findOrFail($id);
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->is_active = $user->is_active;
        $this->roles = $user->roles->pluck('id')->toArray();
        $this->mode = 'edit';
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'is_active' => 'required|boolean',
        ]);

        $user = User::findOrFail($this->user_id);
        $user->name = $this->name;
        $user->email = $this->email;
        if ($this->password) {
            $user->password = Hash::make($this->password);
        }
        $user->is_active = $this->is_active;
        $user->save();
        $user->syncRoles($this->selectedRoles);

        $this->resetForm();
        $this->loadUsers();
        $this->mode = 'index';
    }

    public function create()
    {
        $this->resetForm();
        $this->mode = 'create';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'is_active' => 'required|boolean',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'is_active' => $this->is_active,
        ]);

        $user->syncRoles($this->selectedRoles);

        $this->resetForm();
        $this->loadUsers();
        $this->mode = 'index';
    }

    public function confirmDelete($id)
{
    $this->userToDelete = $id;
    $this->confirmingDelete = true;
}

public function deleteConfirmed()
{
    User::findOrFail($this->userToDelete)->delete();
    $this->confirmingDelete = false;
    $this->userToDelete = null;
    $this->loadUsers();
}

    public function resetForm()
    {
        $this->user_id = null;
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->selecteRoles = [];
        $this->is_active = true;
    }

    public function render()
    {
        return view('livewire.users.index', [
            'roles' => Role::all(),
        
        ]);
    }
    
}


