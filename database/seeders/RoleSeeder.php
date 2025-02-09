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
            ['name' => 'view role',   'guard_name' => 'web'],
            ['name' => 'update role',   'guard_name' => 'web'],
            ['name' => 'delete role',   'guard_name' => 'web'],
            ['name' => 'view permission',   'guard_name' => 'web'],
            ['name' => 'create permission',   'guard_name' => 'web'],
            ['name' => 'update permission',   'guard_name' => 'web'],
            ['name' => 'delete permission',   'guard_name' => 'web'],
        ]);

        $admin->givePermissionTo([
            'create role',
             'view role',
             'update role',
             'delete role',
             'view permission',
             'create permission',
             'update permission',
             'delete permission',
            
            ]);

         $user = User::find(1);

         if ($user) {

            $user->assignRole('super-admin');
        }
        
    }
}
