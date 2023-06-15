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
use App\Http\Controllers\TestController;
use App\Http\Controllers\TryOutController;
use App\Http\Controllers\UserController;
use App\Models\DevelopmentSuggestion;
use App\Models\QuestionOption;
use App\Models\Role;
use App\Models\Test;
use App\Models\TryOut;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use League\CommonMark\Environment;

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

// Migrate
if (env('APP_ENV') == 'local') {
    Route::get('/migrate', function () {
        Artisan::call("migrate");
    });
}


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

Route::middleware(['auth', 'single_session'])->group(function () {
    Route::get('/profil', [ProfileController::class, 'index']);
    Route::post('/profil', [ProfileController::class, 'update']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    role_route([Role::ADMIN, Role::SISWA], function () {
        Route::get('/tryout/do/{id?}', [TryOutController::class, 'do'])->name('tryout.do');
        Route::get('/tryout/question/{id}', [TryOutController::class, 'getQuestion'])->name('tryout.question');
        Route::get('/test/{id}/submit', [TestController::class, 'submit'])->name('test.submit');
        Route::get('/tryout/explanation/{id?}', [TryOutController::class, 'explanation'])->name('tryout.explanation');
        Route::get('/tryout/explanation/{id}/result', [TryOutController::class, 'result'])->name('tryout.result');
        Route::get('/tryout/explanation/{id}/result/json', [TryOutController::class, 'resultJson'])->name('tryout.result.json');
        Route::get('/tryout/chart', [TryOutController::class, 'showChart'])->name('tryout.chart');
    });

    role_route([Role::ADMIN], function () {
        Route::get('/question/search', [QuestionController::class, 'search'])->name('question.search');
        Route::resource('/question', QuestionController::class);
        Route::resource('/question-category', QuestionCategoryController::class);
        Route::resource('/tryout', TryOutController::class);
        Route::match(['get', 'post'], '/tryout/set-question/{id}', [TryOutController::class, 'setQuestions'])->name('tryout.set-question');
        Route::resource('/user', UserController::class);
        Route::match(['get', 'post'], '/user/change-password/{id}', [UserController::class, 'changePassword'])->name('user.change-password');
        Route::get('/user/login/{id}', [UserController::class, 'forceLogin'])->name('user.force-login');
    });
});
