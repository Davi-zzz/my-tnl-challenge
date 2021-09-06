<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\DisheController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;

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
//authentication 
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('sendLogin');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', function () {return view('register');})->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('sendRegister');
// ------------------------------



Route::resource('/restaurant', RestaurantController::class);
Route::resource('/dishe', DisheController::class)->except('show');
Route::resource('/menu', MenuController::class)->except('index','show', 'create');
Route::get('/menu/create', [MenuController::class, 'create'])->name('menu.create');



Route::get('/', [RestaurantController::class, 'index'])->name('index');
