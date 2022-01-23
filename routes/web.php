<?php

use App\Http\Controllers\AboutPageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DevelopmentSuggestionController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\QuestionCategoryController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\UserController;
use App\Models\DevelopmentSuggestion;
use App\Models\Role;
use Illuminate\Support\Facades\Route;

// Untuk route yang butuh role.
function role_route($roles, $callback)
{
    return Route::middleware('role:' . implode(",", $roles))->group($callback);
}

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// HomePage.

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/login', [AuthController::class, 'login_post']);
    Route::get('/daftar', [AuthController::class, 'daftar']);
    Route::post('/daftar', [AuthController::class, 'daftar_post']);
    Route::get('/lupa-password', [AuthController::class, 'lupa_password']);
    Route::post('/lupa-password', [AuthController::class, 'lupa_password_post']);
    Route::post('/reset-password', [AuthController::class, 'reset_password']);
});

Route::get('/verif', [AuthController::class, 'verif']);

Route::prefix('auth')->group(function () {
    Route::get('/redirect', [AuthController::class, 'redirect']);
    Route::prefix('google')->group(function () {
        Route::get('/', [GoogleController::class, 'callback']);
        Route::get('/redirect', [GoogleController::class, 'redirect']);
    });
    Route::prefix('facebook')->group(function () {
        Route::get('/', [FacebookController::class, 'callback']);
        Route::get('/redirect', [FacebookController::class, 'redirect']);
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profil', [ProfileController::class, 'index']);
    Route::post('/profil', [ProfileController::class, 'update']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/', [DashboardController::class, 'index']);
    role_route([Role::ADMIN], function () {
        Route::resource('/question', QuestionController::class);
        Route::resource('/question-category', QuestionCategoryController::class);
    });
});