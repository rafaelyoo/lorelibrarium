<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\BookRepositoryInterface;
use App\Repositories\BookRepository;
use App\Repositories\AuthorRepository;
use App\Repositories\AuthorRepositoryInterface;
use App\Repositories\ReportRepository;
use App\Repositories\ReportRepositoryInterface;
use App\Repositories\SubjectRepository;
use App\Repositories\SubjectRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            BookRepositoryInterface::class, 
            BookRepository::class,
        );
        $this->app->bind(
            AuthorRepositoryInterface::class,
            AuthorRepository::class,
        );
        $this->app->bind(
            SubjectRepositoryInterface::class,
            SubjectRepository::class,
        );
        $this->app->bind(
            ReportRepositoryInterface::class,
            ReportRepository::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
