<?php

namespace Database\Seeders;

use App\Models\LeaveType;
use Illuminate\Database\Seeder;

class LeaveTypeSeeder extends Seeder
{
    public function run(): void
    {
        $leaveTypes = [
            [
                'name'                 => 'Cuti Tahunan',
                'default_quota'        => 12,
                'is_paid'              => true,
                'requires_attachment'  => false,
                'max_consecutive_days' => 12,
            ],
            [
                'name'                 => 'Cuti Sakit',
                'default_quota'        => 14,
                'is_paid'              => true,
                'requires_attachment'  => true,  // wajib surat dokter
                'max_consecutive_days' => null,
            ],
            [
                'name'                 => 'Cuti Melahirkan',
                'default_quota'        => 90,
                'is_paid'              => true,
                'requires_attachment'  => true,
                'max_consecutive_days' => null,
            ],
            [
                'name'                 => 'Cuti Ayah',
                'default_quota'        => 2,
                'is_paid'              => true,
                'requires_attachment'  => false,
                'max_consecutive_days' => 2,
            ],
            [
                'name'                 => 'Cuti Alasan Penting',
                'default_quota'        => 3,
                'is_paid'              => true,
                'requires_attachment'  => false,
                'max_consecutive_days' => 3,
            ],
            [
                'name'                 => 'Cuti Tidak Berbayar',
                'default_quota'        => 30,
                'is_paid'              => false,
                'requires_attachment'  => false,
                'max_consecutive_days' => null,
            ],
        ];

        foreach ($leaveTypes as $leaveType) {
            LeaveType::create($leaveType);
        }
    }
}
