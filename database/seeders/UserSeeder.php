<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = [
            [
                'name'     => 'Galih Kuncoro', //nih admin cuy
                'email'    => 'galih@company.com',
                'password' => Hash::make('password'),
            ],
            /////////////////////////////////////////////////
            [
                'name'     => 'Budi Santoso',
                'email'    => 'budi@company.com',
                'password' => Hash::make('password'),
            ],
            [
                'name'     => 'Siti Rahayu',
                'email'    => 'siti@company.com',
                'password' => Hash::make('password'),
            ],
            [
                'name'     => 'Sandi Sans',
                'email'    => 'sandi@company.com',
                'password' => Hash::make('password'),
            ],
            [
                'name'     => 'Mulyadi',
                'email'    => 'mulyadi@company.com',
                'password' => Hash::make('password'),
            ],
            [
                'name'     => 'Sinta Saputri',
                'email'    => 'sinta@company.com',
                'password' => Hash::make('password'),
            ],
            [
                'name'     => 'Ferry kusuma',
                'email'    => 'ferry@company.com',
                'password' => Hash::make('password'),
            ],
            [
                'name'     => 'Dedeng Sukandar',
                'email'    => 'dedeng@company.com',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($users as $index => $userData) {
            $user = User::create($userData);

            // Index 0 = Galih (superadmin), sisanya employee
            if ($index === 0) {
                $user->assignRole('super_admin');
            } else {
                $user->assignRole('Employee');
            }
        }
    }
}
