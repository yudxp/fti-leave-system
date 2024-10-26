<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Permissions
        $this->command->warn(PHP_EOL . 'Creating set of permission for roles...');
        Artisan::call('permissions:sync -C -Y');
        $this->command->info('Sets of permissions has been created.');

        // Roles
        /* Super Administrator Role */
        $this->command->warn(PHP_EOL . 'Creating super admin role...');
        $role = Role::create(['name' => 'Super Admin']);
        $role->givePermissionTo(Permission::all());
        $this->command->info('Super admin role has been created.');


        $superadmin  = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@database.com',
            'password' => Hash::make('123456'),
        ]);
        $superadmin->assignRole('Super Admin');
        $superadmin->givePermissionTo(Permission::all());


        /* Power User Role */
        $this->command->warn(PHP_EOL . 'Creating standard role...');
        $role = Role::create(['name' => 'Employee']);

        $includedPermission = ['Employee', 'Leave'];
        $permissions = Permission::where(function ($query) use ($includedPermission) {
            foreach ($includedPermission as $value) {
                $query->orWhere('name', 'like', '%' . $value . '%');
            }
        })->pluck('name')->toArray();

        $role->givePermissionTo($permissions);
        $this->command->info('Employee role has been created.');

        // Create a power user and assign the Power User role
        $employee  = User::create([
            'name' => 'Employee',
            'email' => 'employee@database.com',
            'password' => Hash::make('123456'),
        ]);
        $employee->assignRole('Employee');
        $employee->givePermissionTo($permissions);
    }
}
