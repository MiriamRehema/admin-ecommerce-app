<?php

namespace App\Livewire\Roles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


use Livewire\Component;

class Index extends Component
{
public $mode = 'index';

public $name;
public $selectedRole;
public $selectedPermissions = [];
public $allPermissions;
public $role_id;
public $confirmingDelete = false;

public function mount() {
    $this->loadRoles();
    $this->allPermissions = Permission::all();
}

public function loadRoles() {
    $this->roles = Role::with('permissions')->get();
}

public function create() {
    $this->resetForm();
    $this->mode = 'create';
}

public function store() {
    $this->validate(['name' => 'required']);
    $role = Role::create(['name' => $this->name]);
    $role->syncPermissions($this->selectedPermissions);
    session()->flash('success', 'Role created!');
    $this->resetForm();
    $this->loadRoles();
    $this->mode = 'index';
}

public function show($id) {
    $this->selectedRole = Role::with('permissions')->findOrFail($id);
    $this->mode = 'show';
}

public function edit($id) {
    $role = Role::with('permissions')->findOrFail($id);
    $this->role_id = $role->id;
    $this->name = $role->name;
    $this->selectedPermissions = $role->permissions->pluck('name')->toArray();
    $this->mode = 'edit';
}

public function update() {
    $this->validate(['name' => 'required']);
    $role = Role::findOrFail($this->role_id);
    $role->name = $this->name;
    $role->save();
    $role->syncPermissions($this->selectedPermissions);
    session()->flash('success', 'Role updated!');
    $this->resetForm();
    $this->loadRoles();
    $this->mode = 'index';
}

public function confirmDelete($id) {
    $this->role_id = $id;
    $this->confirmingDelete = true;
}

public function deleteConfirmed() {
    $role = Role::findOrFail($this->role_id);
    $role->delete();
    session()->flash('success', 'Role deleted!');
    $this->confirmingDelete = false;
    $this->loadRoles();
}

public function resetForm() {
    $this->reset(['name', 'selectedPermissions', 'role_id']);
}
public function render()
{
    $roles = Role::with('permissions')->paginate(10); // ✅ safe here
    return view('livewire.roles.index', compact('roles'));
}

}
