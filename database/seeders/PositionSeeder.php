<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // 1. Kumpulkan semua data dalam satu array [1]
        $PositionsData = [
            [
                'department_id' => 1,
                'name'          => 'Head of Development',
                'description'   => 'Lead semua project, atur deadline & kualitas code',
                'allowance'     => 15000000,
            ],
            [
                'department_id' => 1,
                'name'          => 'Project Manager / Scrum Master',
                'description'   => 'Jembatan ke klien, bikin timeline project, atur sprint & backlog',
                'allowance'     => 20000000,
            ],
            [
                'department_id' => 2,
                'name'          => 'Head of Infrastructure',
                'description'   => 'Penanggung jawab server & keamanan jaringan perusahaan',
                'allowance'     => 12000000,
            ],
            [
                'department_id' => 2,
                'name'          => 'Cloud & DevOps Engineer',
                'description'   => 'Atur AWS/GCP, CI/CD, auto-deploy, monitoring & alerting',
                'allowance'     => 12000000,
            ],
            [
                'department_id' => 3,
                'name'          => 'Head of Innovation / AI Lead',
                'description'   => 'Riset tren teknologi baru',
                'allowance'     => 12000000,
            ],
            [
                'department_id' => 3,
                'name'          => 'Data Scientist / AI Engineer',
                'description'   => 'Bikin model AI, machine learning',
                'allowance'     => 12000000,
            ],
        ];

        // 2. Lakukan perulangan untuk mengeksekusi NamaModel::create() [1]
        foreach ($PositionsData as $position) {
            Position::create($position  );
        }
    }

}
