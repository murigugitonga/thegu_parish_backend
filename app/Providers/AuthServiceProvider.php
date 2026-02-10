<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
//use Illuminate\Support\ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    // Defining policies
    protected $policies =[
        \App\Models\Member::class => \App\Policies\MemberPolicy::class,
        \App\Models\Finance::class => \App\Policies\FinancePolicy::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
