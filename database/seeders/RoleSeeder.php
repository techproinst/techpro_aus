<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'super-admin']);
        Permission::insert([
            ['name' => 'create role', 'guard_name' => 'web'],
            ['name' => 'view role',   'guard_name' => 'web']
        ]);

        $admin->givePermissionTo(['create role', 'view role']);

         $user = User::find(1);

         if ($user) {
            
            $user->assignRole('super-admin');
        }
        
    }
}
