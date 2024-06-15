<?php

namespace App\Providers;

use App\Interfaces\Category\CategoryRepositoryInterface;
use App\Interfaces\Enrollment\EnrollmentRepositoryInterface;
use App\Interfaces\Lesson\UserLessonRepositoryInterface;
use App\Interfaces\Moderation\ModerationRepositoryInterface;
use App\Interfaces\Lesson\LessonRepositoryInterface;
use App\Interfaces\Module\ModuleRepositoryInterface;
use App\Interfaces\User\UserRepositoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\EdenAI\EdenAIRepository;
use App\Repositories\Enrollment\EnrollmentRepository;
use App\Repositories\Lesson\LessonRepository;
use App\Repositories\Lesson\UserLessonRepository;
use App\Repositories\Module\ModuleRepository;
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
        $this->app->bind(ModuleRepositoryInterface::class, ModuleRepository::class);
        $this->app->bind(LessonRepositoryInterface::class, LessonRepository::class);
        $this->app->bind(UserLessonRepositoryInterface::class, UserLessonRepository::class);
        $this->app->bind(EnrollmentRepositoryInterface::class, EnrollmentRepository::class);
        $this->app->bind(ModerationRepositoryInterface::class, EdenAIRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
