<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
            'product-delete'
        ];
        foreach($permissions as $key=>$permission){
            Permission::create(['name' => $permission]);
        }
    }
}
