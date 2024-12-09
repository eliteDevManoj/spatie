<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        

        /** basic permissions */
            Permission::create([
                'name' => 'create user'
            ]);

            Permission::create([
                'name' => 'edit user'
            ]);

            Permission::create([
                'name' => 'delete user'
            ]);

            Permission::create([
                'name' => 'view user'
            ]);

            Permission::create([
                'name' => 'manage user'
            ]);

            
            Permission::create([
                'name' => 'create role'
            ]);
            
            Permission::create([
                'name' => 'edit role'
            ]);

            Permission::create([
                'name' => 'view role'
            ]);

            Permission::create([
                'name' => 'delete role'
            ]);

            Permission::create([
                'name' => 'manage role'
            ]);



            Permission::create([
                'name' => 'create permission'
            ]);
            
            Permission::create([
                'name' => 'edit permission'
            ]);

            Permission::create([
                'name' => 'view permission'
            ]);

            Permission::create([
                'name' => 'delete permission'
            ]);

            Permission::create([
                'name' => 'manage permission'
            ]);
        /** basic permissions */


        /** basic roles */
            $superAdminRole = Role::create([
                'name' => 'super admin'
            ]);
            
            $adminRole = Role::create([
                'name' => 'admin'
            ]);

            $standardRole = Role::create([
                'name' => 'standard'
            ]);
        /** basic roles */


        /** assign permissions to super admin role */

        $superAdminRole->givePermissionTo([
            'create user',
            'edit user',
            'delete user',
            'view user',
            'manage user',
            'create role',
            'edit role',
            'view role',
            'delete role',
            'manage role',
            'create permission',
            'edit permission',
            'view permission',
            'delete permission',
            'manage permission'
        ]);

        /** assign permissions to super admin role */


        /** create super admin */
            $superAdmin = User::create([
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => 'Welcome@123#'
            ]);

            $superAdmin->assignRole('super admin');

        /** create super admin */
    }
}
