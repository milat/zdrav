<?php

use App\Http\Controllers\HydrationController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\MeasurementController;
use App\Http\Controllers\MindfulnessController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TrainingCategoryController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\UserPreferenceController;
use App\Http\Controllers\WeightController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('login');
//    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// USER PREFERENCES
Route::middleware('auth')->group(function () {
    Route::get('/user_preferences', [UserPreferenceController::class, 'view'])->name('user_preference.view');
    Route::patch('/user_preferences/update', [UserPreferenceController::class, 'update'])->name('user_preference.update');
});

// PROFILE
Route::middleware('auth')->group(function () {
    Route::get('/user', [UserController::class, 'edit'])->name('user.edit');
    Route::patch('/user', [UserController::class, 'update'])->name('user.update');
});

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

$AuthCrudRoutes = [
    'meal' => MealController::class,
    'hydration' => HydrationController::class,
    'mindfulness' => MindfulnessController::class,
    'weight' => WeightController::class,
    'measurement' => MeasurementController::class,
    'test' => TestController::class,
    'training' => TrainingController::class,
    'training_category' => TrainingCategoryController::class,
];

foreach ($AuthCrudRoutes as $domain => $controller) {
    Route::middleware('auth')->controller($controller)->prefix($domain)->group(function () use ($domain) {
        Route::get('/create', 'create')->name($domain.'.create');
        Route::post('/store', 'store')->name($domain.'.store');
        Route::get('/', 'view')->name($domain.'.view');
        Route::get('/edit/{id}', 'edit')->name($domain.'.edit');
        Route::patch('/update/{id}', 'update')->name($domain.'.update');
        Route::delete('/destroy/{id}', 'destroy')->name($domain.'.destroy');
    });
}

Route::get('/test/filter', [TestController::class, 'filter'])->middleware('auth')->name('test.filter');
Route::get('/training_category/all', [TrainingCategoryController::class, 'all'])->middleware('auth')->name('training_category.all');
