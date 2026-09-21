<?php

namespace Database\Seeders;

use App\Models\Company;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Company::create([
            'name' => "Galih's Company",
            'address' => 'Jl. Maharaja Galih no.123, Riau',
            'email' => "Galih'scompany@example.com",
            'phone_number' => '081234567890'
    
        ]);
    }
}
