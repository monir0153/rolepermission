<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create(['name' => 'superadmin']);

        $permission = Permission::create(['name' => 'user list']);
        $permission = Permission::create(['name' => 'create user']);
        $permission = Permission::create(['name' => 'edit user']);
        $permission = Permission::create(['name' => 'delete user']);
        $permission = Permission::create(['name' => 'create role']);
        $permission = Permission::create(['name' => 'edit role']);
        $permission = Permission::create(['name' => 'delete role']);

        $role->givePermissionTo(Permission::all());
        // $permission->assignRole($role);
        // $user = User::latest()->get();
        // $user->assignRole($role);
        
    }
}
