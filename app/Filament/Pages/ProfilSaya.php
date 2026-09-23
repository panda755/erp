<?php

namespace App\Filament\Pages;

use App\Models\Employee;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class ProfilSaya extends Page
{
    protected string $view = 'filament.pages.profil-saya';
        protected static bool $shouldRegisterNavigation = false;

    public ?Employee $employee = null;

    public function mount(): void
    {
        $this->employee = Employee::with(['user', 'department', 'position'])
            ->where('user_id', Auth::id())
            ->first();
    }
}
