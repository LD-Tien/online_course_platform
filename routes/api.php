<?php

use App\Enums\UserRole;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Course\CourseController;
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
        return $request->user();
    });
});

Route::middleware(['auth:sanctum', 'checkUserRole:' . UserRole::ADMIN])
    ->prefix('admin')->group(function () {
        Route::get('', function () {
            return 'admin';
        });
        Route::get('categories', [CategoryController::class, 'index']);
        Route::get('categories/{id}', [CategoryController::class, 'show']);
        Route::post('categories', [CategoryController::class, 'store']);
        Route::put('categories/{id}', [CategoryController::class, 'update']);
        Route::delete('categories/{id}', [CategoryController::class, 'destroy']);
    });

Route::middleware(['auth:sanctum', 'checkUserRole:' . UserRole::CENSOR])
    ->prefix('censor')->group(function () {
        Route::get('', function () {
            return 'censor';
        });
    });

Route::middleware(['auth:sanctum', 'checkUserRole:' . UserRole::INSTRUCTOR])
    ->prefix('instructor')->group(function () {
        Route::get('', function () {
            return 'instructor';
        });
        Route::get('courses', [CourseController::class, 'index']);
        Route::get('courses/{id}', [CourseController::class, 'show']);
        Route::post('courses', [CourseController::class, 'store']);
        Route::put('courses/{id}', [CourseController::class, 'update']);
        Route::delete('courses/{id}', [CourseController::class, 'destroy']);
    });

Route::middleware(['auth:sanctum', 'checkUserRole:' . UserRole::LEANER . ',' . UserRole::INSTRUCTOR])
    ->group(function () {
        Route::get('', function () {
            return 'leaner';
        });
    });

Route::get('/test', function () {
    return 'test api successfully.';
});

Route::fallback(function () {
    abort(404, 'API resource not found');
});

require __DIR__ . '/auth.php';
