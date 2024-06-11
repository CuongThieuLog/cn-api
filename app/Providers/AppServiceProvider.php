<?php

namespace App\Providers;

use App\Repositories\CinemaRepository;
use App\Repositories\FoodRepository;
use App\Repositories\InformationRepository;
use App\Repositories\Interfaces\CinemaInterface;
use App\Repositories\Interfaces\FoodInterface;
use App\Repositories\Interfaces\InformationInterface;
use App\Repositories\Interfaces\MovieFormatInterface;
use App\Repositories\Interfaces\MovieInterface;
use App\Repositories\Interfaces\MovieTypeInterface;
use App\Repositories\Interfaces\PersonInterface;
use App\Repositories\Interfaces\PersonMovieInterface;
use App\Repositories\Interfaces\ScheduleInterface;
use App\Repositories\Interfaces\ScreenInterface;
use App\Repositories\Interfaces\SeatInterface;
use App\Repositories\Interfaces\TicketFoodInterface;
use App\Repositories\Interfaces\TicketInterface;
use App\Repositories\MovieFormatRepository;
use App\Repositories\MovieRepository;
use App\Repositories\MovieTypeRepository;
use App\Repositories\PersonMovieRepository;
use App\Repositories\PersonRepository;
use App\Repositories\ScheduleRepository;
use App\Repositories\ScreenRepository;
use App\Repositories\SeatRepository;
use App\Repositories\TicketFoodRepository;
use App\Repositories\TicketRepository;
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
        $this->app->bind(CinemaInterface::class, CinemaRepository::class);
        $this->app->bind(ScreenInterface::class, ScreenRepository::class);
        $this->app->bind(FoodInterface::class, FoodRepository::class);
        $this->app->bind(SeatInterface::class, SeatRepository::class);
        $this->app->bind(ScheduleInterface::class, ScheduleRepository::class);
        $this->app->bind(TicketInterface::class, TicketRepository::class);
        $this->app->bind(TicketFoodInterface::class, TicketFoodRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}