<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;
use App\Policies\RolePolicy;
// Tambahkan di bagian atas file, setelah use yang sudah ada:
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use App\Policies\LeaveRequestPolicy;
use App\Policies\LeaveTypePolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Gate::policy(Role::class, RolePolicy::class);
        // Tambahkan di dalam boot():
        Gate::policy(LeaveRequest::class, LeaveRequestPolicy::class);
        Gate::policy(LeaveType::class, LeaveTypePolicy::class);
    }
}
