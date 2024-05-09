<?php

namespace App\Providers;

use App\Interfaces\Category\CategoryRepositoryInterface;
use App\Interfaces\User\UserRepositoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\User\UserRepository;
use App\Interfaces\Course\CourseRepositoryInterface;
use App\Repositories\Course\CourseRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(CourseRepositoryInterface::class, CourseRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
