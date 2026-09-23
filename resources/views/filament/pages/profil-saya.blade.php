<x-filament::page>
    @if (! $employee)
        <div class="rounded-xl border border-gray-200 dark:border-gray-700 p-6 text-center text-gray-500">
            Akun Anda belum terhubung ke data karyawan. Hubungi Super Admin.
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="rounded-xl border border-gray-200 dark:border-gray-700 p-6 space-y-4">
                <div>
                    <p class="text-sm text-gray-500">Nama</p>
                    <p class="font-medium">{{ $employee->user->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="font-medium">{{ $employee->user->email }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Departemen</p>
                    <p class="font-medium">{{ $employee->department?->name ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Posisi</p>
                    <p class="font-medium">{{ $employee->position?->name ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Status</p>
                    <p class="font-medium capitalize">{{ $employee->status }}</p>
                </div>
            </div>
            <div class="rounded-xl border border-gray-200 dark:border-gray-700 p-6 space-y-4">
                <div>
                    <p class="text-sm text-gray-500">No. Telepon</p>
                    <p class="font-medium">{{ $employee->phone_number ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Alamat</p>
                    <p class="font-medium">{{ $employee->address ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Tanggal Lahir</p>
                    <p class="font-medium">{{ $employee->date_of_birth?->format('d M Y') ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Tanggal Mulai Kerja</p>
                    <p class="font-medium">{{ $employee->start_date?->format('d M Y') ?? '-' }}</p>
                </div>
            </div>
        </div>
    @endif
</x-filament::page>