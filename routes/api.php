<?php

use App\Enums\UserRole;
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
    });

Route::middleware(['auth:sanctum', 'checkUserRole:' . UserRole::LEANER])
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
