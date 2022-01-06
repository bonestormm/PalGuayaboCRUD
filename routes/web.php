<?php

use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::post('menu', [\App\Http\Controllers\MenuController::class, 'store'])->name('menu.store');
    Route::get('createMenu', [\App\Http\Controllers\MenuController::class, 'create'])->name('menu.show');
    Route::get('menus', [\App\Http\Controllers\MenuController::class, 'index'])->name('menus.index');
    Route::get('viewEditMenu/{id}', [\App\Http\Controllers\MenuController::class, 'edit'])->name('menus.viewEdit');
    Route::put('updateMenu/{id}', [\App\Http\Controllers\MenuController::class, 'update'])->name('menus.updateMenu');
    Route::get('deleteMenu/{id}', [\App\Http\Controllers\MenuController::class, 'destroy'])->name('menu.delete');
    Route::get('showMenu/{id}', [\App\Http\Controllers\MenuController::class, 'show'])->name('menu.showSpecific');

    Route::get('foods', [\App\Http\Controllers\FoodController::class, 'index'])->name('foods.index');
    Route::get('createFood', [\App\Http\Controllers\FoodController::class, 'create'])->name('food.show');
    Route::post('food', [\App\Http\Controllers\FoodController::class, 'store'])->name('food.store');
    Route::get('viewEditFood/{id}', [\App\Http\Controllers\FoodController::class, 'edit'])->name('food.viewEdit');
    Route::put('updateFood/{id}', [\App\Http\Controllers\FoodController::class, 'update'])->name('food.updateFood');
    Route::get('deleteFood/{id}', [\App\Http\Controllers\FoodController::class, 'destroy'])->name('food.delete');
    Route::get('showFood/{id}', [\App\Http\Controllers\FoodController::class, 'show'])->name('food.showSpecific');

});



Route::get('/', function () {
    return view('welcome');
});

