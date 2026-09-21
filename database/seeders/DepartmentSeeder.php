<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // department::create([
        //     'company_id'   => 1,
        //     'name'         => 'Development Division',
        //     'motto'        => "We don't just code, we craft solutions.",
        //     'description'  => 'Departemen inti yang bertanggung jawab merancang, membangun, dan mengembangkan produk digital. Dari website, aplikasi mobile, hingga sistem enterprise.',
        //     'address'      => 'Gedung A Lt. 2',
        //     'email'        => 'development@company.com',
        //     'phone_number' => '0761123456',
        // ]);
        
        // 1. Kumpulkan semua data dalam satu array [1]
        $DepartmentsData = [
            [
                'company_id'   => 1,
                'name'         => 'Development Division',
                'motto'        => "We don't just code, we craft solutions.",
                'description'  => 'Departemen inti yang bertanggung jawab merancang, membangun, dan mengembangkan produk digital. Dari website, aplikasi mobile, hingga sistem enterprise.',
                'address'      => 'Gedung A Lt. 2',
                'email'        => 'development@company.com',
                'phone_number' => '0761123456',
            ],
            [
                'company_id'   => 1,
                'name'         => 'Infrastructure Division',
                'motto'        => " Always On, Always Secure.",
                'description'  => 'Departemen yang memastikan semua sistem berjalan 24/7 tanpa henti. Mereka adalah penjaga di balik layar yang membuat semua tetap online, aman, dan cepat.',
                'address'      => 'Gedung B Lt. 1',
                'email'        => 'infrastructure@company.com',
                'phone_number' => '0761654321',
            ],
            [
                'company_id'   => 1,
                'name'         => 'Innovation Division',
                'motto'        => " Innovate Today, Lead Tomorrow.",
                'description'  => 'Departemen R&D dan inovasi, tempat ide-ide gila diuji menjadi produk nyata. Fokus pada teknologi masa depan.',
                'address'      => 'Gedung B Lt. 2',
                'email'        => 'innovation@company.com',
                'phone_number' => '0761987654',
            ],
        ];

        // 2. Lakukan perulangan untuk mengeksekusi NamaModel::create() [1]
        foreach ($DepartmentsData as $department) {
            Department::create($department);
        }
    }
}
