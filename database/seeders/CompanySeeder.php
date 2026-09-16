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
            'name' => 'PT Indra Jaya Sentosa',
            'address' => 'Jl. Maharaja Indra no.123, Riau',
            'email' => 'IndraJayaSentosa@example.com',
            'phone_number' => '081234567890'
    
        ]);
    }
}
