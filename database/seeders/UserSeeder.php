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

        $includedPermission = ['Employee', 'Leave', 'LeaveRequest'];
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

        
        /* Dekan Role */
        $this->command->warn(PHP_EOL . 'Creating dekan role...');
        $role = Role::create(['name' => 'Dekan']);

        $includedPermission = ['LeaveRequest'];
        $permissions = Permission::where(function ($query) use ($includedPermission) {
            foreach ($includedPermission as $value) {
                $query->orWhere('name', 'like', '%' . $value . '%');
            }
        })->pluck('name')->toArray();

        $dekan = User::create([
            'name' => 'Dekan',
            'email' => 'dekan@database.com',
            'password' => Hash::make('123456'),
        ]);
        $dekan->assignRole('Dekan');
        $dekan->givePermissionTo($permissions);
        $this->command->info('Dekan role has been created.');

        /* Kepegawaian Role */
        $this->command->warn(PHP_EOL . 'Creating kepegawaian role...');
        $role = Role::create(['name' => 'Kepegawaian']);

        $includedPermission = ['Employee'];
        $permissions = Permission::where(function ($query) use ($includedPermission) {
            foreach ($includedPermission as $value) {
                $query->orWhere('name', 'like', '%' . $value . '%');
            }
        })->pluck('name')->toArray();
        $kepegawaian = User::create([
            'name' => 'Kepegawaian',
            'email' => 'kepegawaian@database.com',
            'password' => Hash::make('123456'),
        ]);
        $kepegawaian->assignRole('Kepegawaian');
        $kepegawaian->givePermissionTo($permissions);   
        $this->command->info('Kepegawaian role has been created.');


        /* Ketua KK Role */
        $this->command->warn(PHP_EOL . 'Creating ketua kkurangan role...');
        $role = Role::create(['name' => 'Ketua KK']);       

        $includedPermission = ['LeaveRequest'];
        $permissions = Permission::where(function ($query) use ($includedPermission) {
            foreach ($includedPermission as $value) {
                $query->orWhere('name', 'like', '%' . $value . '%');
            }
        })->pluck('name')->toArray();

        $ketua_kk = User::create([
            'name' => 'Ketua KK',
            'email' => 'ketua_kk@database.com',
            'password' => Hash::make('123456'),
        ]);
        $ketua_kk->assignRole('Ketua KK');
        $ketua_kk->givePermissionTo($permissions);
        $this->command->info('Ketua KK role has been created.');
    }
}
