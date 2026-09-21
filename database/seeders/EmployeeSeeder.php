<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $employees = [
            [
                'user_id'        => 2,
                'department_id'  => 1,
                'position_id'    => 1,
                'address'        => 'Jl. Sudirman No. 1, Dumai',
                'place_of_birth' => 'Dumai',
                'date_of_birth'  => '1990-01-15',
                'gender'         => 'male',
                'religion'       => 'muslim',
                'phone_number'   => '08123456789',
                'salary'         => 8000000,
                'start_date'     => '2023-01-01',
                'status'         => 'active',
            ],
            [
                'user_id'        => 3,
                'department_id'  => 1,
                'position_id'    => 2,
                'address'        => 'Jl. Diponegoro No. 5, Dumai',
                'place_of_birth' => 'Pekanbaru',
                'date_of_birth'  => '1995-03-20',
                'gender'         => 'female',
                'religion'       => 'muslim',
                'phone_number'   => '08234567890',
                'salary'         => 6000000,
                'start_date'     => '2023-06-01',
                'status'         => 'active',
            ],
            [
                'user_id'        => 4,
                'department_id'  => 2,
                'position_id'    => 3,
                'address'        => 'Jl. Gatot Subroto No. 10, Dumai',
                'place_of_birth' => 'Medan',
                'date_of_birth'  => '1998-07-11',
                'gender'         => 'male',
                'religion'       => 'christian',
                'phone_number'   => '08345678901',
                'salary'         => 5000000,
                'start_date'     => '2024-01-15',
                'status'         => 'trainee',
            ],
            [
                'user_id'        => 5,
                'department_id'  => 2,
                'position_id'    => 4,
                'address'        => 'Jl. Ahmad Yani No. 3, Dumai',
                'place_of_birth' => 'Dumai',
                'date_of_birth'  => '1993-11-05',
                'gender'         => 'male',
                'religion'       => 'muslim',
                'phone_number'   => '08456789012',
                'salary'         => 7000000,
                'start_date'     => '2022-08-01',
                'status'         => 'active',
            ],
            [
                'user_id'        => 6,
                'department_id'  => 3,
                'position_id'    => 5,
                'address'        => 'Jl. Imam Bonjol No. 7, Dumai',
                'place_of_birth' => 'Bengkalis',
                'date_of_birth'  => '2000-05-22',
                'gender'         => 'female',
                'religion'       => 'christian',
                'phone_number'   => '08567890123',
                'salary'         => 4500000,
                'start_date'     => '2024-03-01',
                'status'         => 'applicant',
            ],
            [
                'user_id'        => 7,
                'department_id'  => 3,
                'position_id'    => 6,
                'address'        => 'Jl. Hasanuddin No. 12, Dumai',
                'place_of_birth' => 'Siak',
                'date_of_birth'  => '1997-09-30',
                'gender'         => 'male',
                'religion'       => 'muslim',
                'phone_number'   => '08678901234',
                'salary'         => 5500000,
                'start_date'     => '2023-03-15',
                'status'         => 'active',
            ],
            [
                'user_id'        => 8,
                'department_id'  => 3,
                'position_id'    => 5,
                'address'        => 'Jl. Kopral Jaya No. 32, Jakarta',
                'place_of_birth' => 'Siak',
                'date_of_birth'  => '1985-06-13',
                'gender'         => 'male',
                'religion'       => 'hindu',
                'phone_number'   => '08678901234',
                'salary'         => 1000000,
                'start_date'     => '2024-06-17',
                'end_date'       => '2025-09-11',
                'status'         => 'former',
            ],
        ];

        foreach ($employees as $employee) {
            Employee::create($employee);
        }
    }
}
