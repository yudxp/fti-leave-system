<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StatusPegawai;
use App\Models\LeaveBalance;
use App\Models\ResearchGroup;
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

        $researchGroups = [
            ['faculty' => 'Teknik Geofisika', 'research_group' => 'Geofisika Sumber Daya Alam'],
            ['faculty' => 'Teknik Mesin', 'research_group' => 'Ilmu dan Teknik Material'],
            ['faculty' => 'Teknik Industri', 'research_group' => 'Manajemen Industri'],
            ['faculty' => 'Teknik Pertambangan', 'research_group' => 'Eksplorasi Sumber Daya Bumi'],
            ['faculty' => 'Teknik Material', 'research_group' => 'Teknologi Pemrosesan Material'],
            ['faculty' => 'Teknik Geologi', 'research_group' => 'Sedimentologi, Stratigrafi, dan Geodinamika'],
            ['faculty' => 'Teknik Informatika', 'research_group' => 'Keamanan Siber dan Komputasi Pervasif'],
            ['faculty' => 'Teknik Biomedis', 'research_group' => 'Instrumentasi dan Pengolahan Citra Biomedik'],
            ['faculty' => 'Teknik Elektro', 'research_group' => 'Sistem Elektrik dan Material Konversi Energi'],
            ['faculty' => 'Teknik Sistem Energi', 'research_group' => 'Manajemen Energi'],
            ['faculty' => 'Teknik Fisika', 'research_group' => 'Material Teknologi Berkelanjutan'],
            ['faculty' => 'Teknik Telekomunikasi', 'research_group' => 'Advanced Radio Telecommunication'],
            ['faculty' => 'Rekayasa Keolahragaan', 'research_group' => 'Ilmu dan Teknik Olahraga'],
            ['faculty' => 'Rekayasa Instrumentasi dan Automasi', 'research_group' => 'Instrumentasi Cerdas dan Automasi Industri'],
            ['faculty' => 'Teknik Kimia', 'research_group' => 'Pengembangan dan Perancangan Proses dan Produksi Kimia'],
            ['faculty' => 'Teknik Pangan', 'research_group' => 'Kimia dan Gizi Pangan'],
            ['faculty' => 'Teknik Biosistem', 'research_group' => 'Teknik Produksi dan Pengolahan Biomassa'],
            ['faculty' => 'Teknik Industri Pertanian', 'research_group' => 'Rekayasa Sistem Otomasi dan Biomedika'],
            ['faculty' => 'Rekayasa Kehutanan', 'research_group' => 'Forest Material Science and Engineering'],
            ['faculty' => 'Rekayasa Kosmetik', 'research_group' => 'Ecological Forest Engineering']
        ];

        foreach ($researchGroups as $researchGroup) {
            ResearchGroup::create($researchGroup);
        }
    }
}
