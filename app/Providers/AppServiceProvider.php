<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $repositories = [
            'UserRepositoryInterface' => 'UserRepository',
            'CategoryRepositoryInterface' => 'CategoryRepository'
        ];

        foreach ($repositories as $key => $value) {
            $this->app->bind("App\\Repositories\\Contracts\\$key", "App\\Repositories\\$value");
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
