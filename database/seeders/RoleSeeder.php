<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::firstOrCreate(['name' => 'super-admin']);

        $permissions = [
            'create role', 'view role', 'update role', 'delete role',
            'view permission', 'create permission', 'update permission', 'delete permission',
            'create user', 'view user', 'update user', 'delete user',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',

            ]);
        }

        if($admin){

            $admin->givePermissionTo($permissions);
        }


        
         $user = User::find(1);

         if ($user) {

            $user->assignRole('super-admin');
            
        } else {

            Log::warning('User with ID 1 not found. Super-admin role not assigned.');
        }
        
    }
}
