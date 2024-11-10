<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        
        foreach ($users as $user) {
            Employee::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'position' => fake()->jobTitle(),
                'department' => fake()->randomElement(['IT', 'HR', 'Finance', 'Marketing', 'Operations']),
                'nip' => fake()->unique()->numerify('########'),
                'start_working' => fake()->dateTimeBetween('-5 years', 'now'),
                'signature' => null, // Initially empty signature
            ]);
        }
    }
}
