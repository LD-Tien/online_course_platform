<?php

use App\Enums\UserRole;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Common\CategoryController;
use App\Http\Controllers\Common\Course\CourseController;
use App\Http\Controllers\Common\LessonVideoController;
use App\Http\Controllers\Common\Review\ReviewController;
use App\Http\Controllers\Instructor\CourseController as InstructorCourseController;
use App\Http\Controllers\CourseModerationController;
use App\Http\Controllers\Learner\Comment\CommentController;
use App\Http\Controllers\Learner\EnrollmentController;
use App\Http\Controllers\Learner\ReviewController as LearnerReviewController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\Learner\LessonController as LearnerLessonController;
use App\Http\Controllers\Moderator\CourseController as ModeratorCourseController;
use App\Http\Controllers\ModuleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return response()->json([
            'code' => 200,
            'message' => 'Get success',
            'data' => \Auth::user()
        ]);
    });
});

Route::middleware(['auth:sanctum', 'checkUserRole:' . UserRole::ADMIN])
    ->prefix('admin')->group(function () {
        Route::get('', function () {
            return 'admin';
        });
        Route::get('categories', [AdminCategoryController::class, 'index']);
        Route::get('categories/{id}', [AdminCategoryController::class, 'show']);
        Route::post('categories', [AdminCategoryController::class, 'store']);
        Route::put('categories/{id}', [AdminCategoryController::class, 'update']);
        Route::delete('categories/{id}', [AdminCategoryController::class, 'destroy']);
    });

Route::middleware(['auth:sanctum', 'checkUserRole:' . UserRole::MODERATOR])
    ->prefix('moderator')->group(function () {
        Route::get('', function () {
            return 'moderator';
        });

        Route::prefix('courses')->group(function () {
            Route::get('', [ModeratorCourseController::class, 'index']);
            Route::get('{course}', [ModeratorCourseController::class, 'show']);
            Route::get('{course}/analysis', [CourseModerationController::class, 'startCourseAnalysis']);
            Route::get('{course}/modules/{module}/lessons/{lesson}/analysis', [CourseModerationController::class, 'startLessonAnalysis']);
            Route::post('handleResponseEdenAI', [CourseModerationController::class, 'handleResponseEdenAI']);
        });
    });

Route::middleware(['auth:sanctum', 'checkUserRole:' . UserRole::INSTRUCTOR])
    ->prefix('instructor')->group(function () {
        Route::get('', function () {
            return 'instructor';
        });
        Route::prefix('courses')->group(function () {
            Route::get('', [InstructorCourseController::class, 'index']);
            Route::get('{course}', [InstructorCourseController::class, 'show']);
            Route::post('', [InstructorCourseController::class, 'store']);
            Route::put('{course}', [InstructorCourseController::class, 'update']);
            Route::delete('{course}', [InstructorCourseController::class, 'destroy']);

            Route::prefix('{course}/modules')->group(function () {
                Route::post('', [ModuleController::class, 'store']);
                Route::get('', [ModuleController::class, 'index']);
                Route::put('{module}', [ModuleController::class, 'update']);
                Route::delete('{module}', [ModuleController::class, 'destroy']);

                Route::prefix('{module}/lessons')->group(function () {
                    Route::post('', [LessonController::class, 'store']);
                    Route::get('', [LessonController::class, 'index']);
                    Route::get('{lesson}', [LessonController::class, 'show']);
                    Route::put('{lesson}', [LessonController::class, 'update']);
                    Route::delete('{lesson}', [LessonController::class, 'destroy']);
                });
            });
        });
    });

Route::get('categories', [CategoryController::class, 'index']);

Route::prefix('courses')->group(function () {
    Route::get('', [CourseController::class, 'index']);
    Route::get('{course}', [CourseController::class, 'show']);
});

Route::prefix('reviews')->group(function () {
    Route::get('{courseId}', [ReviewController::class, 'index']);
});

Route::middleware(['auth:sanctum', 'checkUserRole:' . UserRole::LEARNER . ',' . UserRole::INSTRUCTOR])
    ->prefix('learner')->group(function () {
        Route::prefix('courses')->group(function () {
            Route::post('{course}/enrollment', [EnrollmentController::class, 'enrollment']);
            Route::get('{course}', [CourseController::class, 'show']);
        });

        Route::prefix('lessons')->group(function () {
            Route::post('{lesson}/finish', [LearnerLessonController::class, 'finishLesson']);
            Route::delete('{lesson}/unfinished', [LearnerLessonController::class, 'unfinishedLesson']);
        });

        Route::prefix('reviews')->group(function () {
            Route::post('', [LearnerReviewController::class, 'store']);
        });

        Route::prefix('comments')->group(function () {
            Route::get('', [CommentController::class, 'index']);
            Route::post('', [CommentController::class, 'store']);
            Route::delete('{comment_id}', [CommentController::class, 'delete']);
            Route::post('reaction', [CommentController::class, 'reaction']);
        });

        Route::get('', function () {
            return 'leaner';
        });
    });

Route::prefix('eden-ai')->group(function () {
    Route::post('/webhook/moderation-video/{lesson}', [CourseModerationController::class, 'handleVideoReviewResult'])->name('webhook.handle-video-review-result');
});

Route::get('/test', function () {
    return 'test api successfully.';
});

Route::get('/{lesson}/video', [LessonVideoController::class, 'getVideo']);

Route::fallback(function () {
    abort(404, 'API resource not found');
});

require __DIR__ . '/auth.php';
