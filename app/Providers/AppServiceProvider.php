<?php

namespace App\Providers;

use App\Repositories\Interfaces\MovieFormatInterface;
use App\Repositories\Interfaces\MovieTypeInterface;
use App\Repositories\MovieFormatRepository;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}