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
                'position' => fake()->randomElement(['Asisten Ahli', 'Lektor', 'Lektor Kepala', 'Asisten Doktor', 'Guru Besar', 'Profesor']),
                'department' => fake()->randomElement(['Teknik Geofisika', 'Teknik Elektro', 'Rekayasa Instrumentasi dan Automasi', 'Rekayasa Kehutanan', 'Teknik Informatika']),
                'nip' => fake()->unique()->numerify('####################'),
                'start_working' => fake()->dateTimeBetween('-6 years', 'now'),
                'signature' => null, // Initially empty signature
            ]);

            StatusPegawai::create([
                'status_pegawai' => fake()->randomElement(['PNS', 'PPPK']),
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
            ['faculty' => 'Teknik Geofisika', 'research_group' => 'Geofisika Lingkungan'],
            ['faculty' => 'Teknik Mesin', 'research_group' => 'Ilmu dan Teknik Material'],
            ['faculty' => 'Teknik Mesin', 'research_group' => 'Konversi Energi'],
            ['faculty' => 'Teknik Mesin', 'research_group' => 'Desain dan Manufaktur'],
            ['faculty' => 'Teknik Industri', 'research_group' => 'Manajemen Industri'],
            ['faculty' => 'Teknik Industri', 'research_group' => 'Sistem Manufaktur'],
            ['faculty' => 'Teknik Industri', 'research_group' => 'Rancangan Optimasi & Sistem Industri'],
            ['faculty' => 'Teknik Industri', 'research_group' => 'Rancangan Sistem Kerja dan Ergonomi'],
            ['faculty' => 'Teknik Pertambangan', 'research_group' => 'Eksplorasi Sumber Daya Bumi'],
            ['faculty' => 'Teknik Pertambangan', 'research_group' => 'Penambangan, Pengolahan dan Pemurnian'],
            ['faculty' => 'Teknik Material', 'research_group' => 'Teknologi Pemrosesan Material'],
            ['faculty' => 'Teknik Material', 'research_group' => 'Material Maju'],
            ['faculty' => 'Teknik Geologi', 'research_group' => 'Sedimentologi, Stratigrafi, dan Geodinamika'],
            ['faculty' => 'Teknik Geologi', 'research_group' => 'Geologi Terapan'],
            ['faculty' => 'Teknik Geologi', 'research_group' => 'Petrologi, Vulkanologi, dan Geotermal'],
            ['faculty' => 'Teknik Informatika', 'research_group' => 'Keamanan Siber dan Komputasi Pervasif'],
            ['faculty' => 'Teknik Informatika', 'research_group' => 'Kecerdasan Buatan dan Rekayasa Data'],
            ['faculty' => 'Teknik Informatika', 'research_group' => 'Rakayasa Perangkat Lunak dan Sistem Informasi'],
            ['faculty' => 'Teknik Biomedis', 'research_group' => 'Instrumentasi dan Pengolahan Citra Biomedik'],
            ['faculty' => 'Teknik Biomedis', 'research_group' => 'Biomaterial dan Rekayasa Jaringan'],
            ['faculty' => 'Teknik Elektro', 'research_group' => 'Sistem Elektrik dan Material Konversi Energi'],
            ['faculty' => 'Teknik Elektro', 'research_group' => 'Telekomunikasi, Elektronika dan Sistem Komputer'],
            ['faculty' => 'Teknik Elektro', 'research_group' => 'Teknologi Sistem Instrumentasi Automasi dan Produksi'],
            ['faculty' => 'Teknik Sistem Energi', 'research_group' => 'Manajemen Energi'],
            ['faculty' => 'Teknik Sistem Energi', 'research_group' => 'Perancangan Sistem Energi'],
            ['faculty' => 'Teknik Fisika', 'research_group' => 'Material Teknologi Berkelanjutan'],
            ['faculty' => 'Teknik Fisika', 'research_group' => 'Lingkungan Binaan Berkelanjutan dan Cerdas'],
            ['faculty' => 'Teknik Telekomunikasi', 'research_group' => 'Advanced Radio Telecommunication'],
            ['faculty' => 'Rekayasa Keolahragaan', 'research_group' => 'Ilmu dan Teknik Olahraga'],
            ['faculty' => 'Rekayasa Instrumentasi dan Automasi', 'research_group' => 'Instrumentasi Cerdas dan Automasi Industri'],
            ['faculty' => 'Teknik Kimia', 'research_group' => 'Pengembangan dan Perancangan Proses dan Produk Biologi'],
            ['faculty' => 'Teknik Kimia', 'research_group' => 'Pengembangan dan Perancangan Proses dan Produk Kimia'],
            ['faculty' => 'Teknik Pangan', 'research_group' => 'Kimia dan Gizi Pangan'],
            ['faculty' => 'Teknik Pangan', 'research_group' => 'Rekayasa Proses dan Pengolahan Pangan'],
            ['faculty' => 'Teknik Pangan', 'research_group' => 'Mikrobiologi dan Bioteknologi Pangan'],
            ['faculty' => 'Teknik Biosistem', 'research_group' => 'Teknik Produksi dan Pengolahan Biomassa'],
            ['faculty' => 'Teknik Biosistem', 'research_group' => 'Teknik Sistem Otomasi dan Biomedika'],
            ['faculty' => 'Teknik Industri Pertanian', 'research_group' => 'Teknologi Rekayasa dan Proses Agroindustri'],
            ['faculty' => 'Teknik Industri Pertanian', 'research_group' => 'Teknologi Pengemasan dan Managemen Agroindustri'],
            ['faculty' => 'Teknik Industri Pertanian', 'research_group' => 'Teknik dan Pengelolaan Lingkungan Agroindustri'],
            ['faculty' => 'Rekayasa Kehutanan', 'research_group' => 'Forest Material Science and Engineering'],
            ['faculty' => 'Rekayasa Kehutanan', 'research_group' => 'Ecological Forest Engineering '],
            ['faculty' => 'Rekayasa Kosmetik', 'research_group' => 'Ecological Forest Engineering']
        ];

        foreach ($researchGroups as $researchGroup) {
            ResearchGroup::create($researchGroup);
        }
    }
}
