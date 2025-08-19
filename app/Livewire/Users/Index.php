<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class Index extends Component
{
    
    public $user_id;
    public $allRoles;
    public $name, $email, $password, $selectedRoles = [], $is_active = true;
    public $mode = 'index';

    public $confirmingDelete = false;
    public $userToDelete;

    public $search = ''; // ✅ Add this line

    public function mount()
    {
        $this->allRoles = Role::all();
    }

    public function loadUsers()
    {
       
    }

    public function updatedSearch()
    {
        $this->loadUsers(); // refresh when search updates
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
        $this->selectedRoles = $user->roles->pluck('id')->toArray(); // ✅ Fixed here
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
        $this->selectedRoles = []; // ✅ Fixed typo
        $this->is_active = true;
    }

    public function render()
    {

         $this->users = User::with('roles')
            ->when($this->user_id, fn($query) => $query->where('id', $this->user_id))
            ->when($this->search, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('name', 'like', '%' . $this->search . '%')
                             ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->get();

        return view('livewire.users.index', [
            'roles' => $this->allRoles,
            'users' => $this->users,
        ]);
    }
}
