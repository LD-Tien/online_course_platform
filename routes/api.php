<?php

use App\Enums\UserRole;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
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
        Route::prefix('courses')->group(function () {
            Route::get('', [CourseController::class, 'index']);
            Route::get('{id}', [CourseController::class, 'show']);
            Route::post('', [CourseController::class, 'store']);
            Route::put('{course}', [CourseController::class, 'update']);
            Route::delete('{course}', [CourseController::class, 'destroy']);

            Route::prefix('{course}/modules')->group(function () {
                Route::post('', [ModuleController::class, 'store']);
                Route::get('', [ModuleController::class, 'index']);
                Route::put('{module}', [ModuleController::class, 'update']);
                Route::delete('{module}', [ModuleController::class, 'destroy']);
            });
        });
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
