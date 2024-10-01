<?php

namespace App\Providers;

use App\Domain\Interfaces\Repositories\IAuthorsRepository;
use App\Domain\Interfaces\Repositories\ISubjectsRepository;
use App\Infrastructure\Eloquent\Repositories\AuthorsRepository;
use App\Infrastructure\Eloquent\Repositories\SubjectsRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IAuthorsRepository::class, AuthorsRepository::class);
        $this->app->bind(ISubjectsRepository::class, SubjectsRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}