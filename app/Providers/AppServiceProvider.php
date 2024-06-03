<?php

namespace App\Providers;

use App\Repositories\Interfaces\MovieFormatInterface;
use App\Repositories\Interfaces\MovieInterface;
use App\Repositories\Interfaces\MovieTypeInterface;
use App\Repositories\MovieFormatRepository;
use App\Repositories\MovieRepository;
use App\Repositories\MovieTypeRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(MovieTypeInterface::class, MovieTypeRepository::class);
        $this->app->bind(MovieFormatInterface::class, MovieFormatRepository::class);
        $this->app->bind(MovieInterface::class, MovieRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}