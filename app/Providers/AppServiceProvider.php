<?php

namespace App\Providers;

use App\Repositories\InformationRepository;
use App\Repositories\Interfaces\InformationInterface;
use App\Repositories\Interfaces\MovieFormatInterface;
use App\Repositories\Interfaces\MovieInterface;
use App\Repositories\Interfaces\MovieTypeInterface;
use App\Repositories\Interfaces\PersonInterface;
use App\Repositories\Interfaces\PersonMovieInterface;
use App\Repositories\MovieFormatRepository;
use App\Repositories\MovieRepository;
use App\Repositories\MovieTypeRepository;
use App\Repositories\PersonMovieRepository;
use App\Repositories\PersonRepository;
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
        $this->app->bind(PersonInterface::class, PersonRepository::class);
        $this->app->bind(PersonMovieInterface::class, PersonMovieRepository::class);
        $this->app->bind(InformationInterface::class, InformationRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}