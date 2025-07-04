<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Booking;
use App\Policies\BookingPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Booking::class => BookingPolicy::class, // <-- TAMBAHKAN BARIS INI
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //
    }
}
