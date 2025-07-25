<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions=[
            'role-list',
            'role-edit',
            'role-delete',
            'role-create',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
            'category-list',
            'category-create',
            'category-edit',
            'category-delete',
            'order-list',
            'order-create',
            'order-edit',
            'order-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

        ];
        foreach($permissions as $key=>$permission){
            Permission::firstOrCreate(['name' => $permission,
                'guard_name' => 'web']);
        }
        $roles = [
            'Admin',
            'Manager',
            'User',
            // add more roles as needed
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role, 'guard_name' => 'web']);
        }
        // Assign all permissions to Admin role
        $adminRole = Role::where('name', 'Admin')->first();
        $allPermissions = Permission::all();
        if ($adminRole) {
            $adminRole->syncPermissions($allPermissions);
            //dd($adminRole->permissions);
        }
    }
}
