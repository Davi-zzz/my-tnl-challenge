<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\API\PublicController;

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

Route::get('/', function() {return redirect()->route('index');});
Route::prefix('public')->group(function () {

    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/index', [PublicController::class, 'listRestaurants'])->name('index');
    Route::post('/restaurant/show', [PublicController::class, 'showRestaurant']);
    
});
Route::group(['middleware' => ['auth:sanctum']],function (){
    //protecting routes with middleware group thats use sanctum of laravel 8
});