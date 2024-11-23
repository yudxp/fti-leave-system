<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StatusPegawai;
use App\Models\LeaveBalance;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        
        foreach ($users as $user) {
            $employee = Employee::create([
                'user_id' => $user->id,
                'position' => fake()->jobTitle(),
                'department' => fake()->randomElement(['IT', 'HR', 'Finance', 'Marketing', 'Operations']),
                'nip' => fake()->unique()->numerify('########'),
                'start_working' => fake()->dateTimeBetween('-5 years', 'now'),
                'signature' => null, // Initially empty signature
            ]);

            StatusPegawai::create([
                'status_pegawai' => fake()->randomElement(['PNS', 'PPPK', 'PPPKP']),
                'employee_id' => $employee->id,
            ]);

            LeaveBalance::create([
                'employee_id' => $employee->id,
                'leave_type_id' => fake()->numberBetween(1, 3),
                'year' => now()->year,
                'total_leave_days' => fake()->numberBetween(12, 20),
            ]);
        }
    }
}
