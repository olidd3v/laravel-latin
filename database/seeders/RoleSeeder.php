<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $staff = Role::firstOrCreate(['name' => 'staff']);

        $admin->syncPermissions(Permission::all());

        $staff->syncPermissions(
            Permission::where('name', 'like', 'activities.%')
                ->orWhere('name', 'like', 'categories.%')
                ->get()
        );
    }
}