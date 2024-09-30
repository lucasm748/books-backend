<?php

namespace App\Providers;

use App\Domain\Interfaces\Repositories\IAuthorsRepository;
use App\Infrastructure\Eloquent\Repositories\AuthorsRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IAuthorsRepository::class, AuthorsRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}