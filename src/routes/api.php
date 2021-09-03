<?php
use App\Http\Controllers\API\MenuController;
use App\Http\Controllers\API\PublicController;
use App\Http\Controllers\API\RestaurantController;
use App\Http\Controllers\API\DisheController;
use App\Http\Controllers\Auth\AuthController;
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

Route::get('/', [PublicController::class, 'listRestaurants']);
Route::get('/restaurant/{id}', [PublicController::class, 'showRestaurant']);

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register']);
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        //Restaurant Routes /api/auth/restuarant
        Route::apiResource('restaurant', RestaurantController::class);

        //Restaurant Routes /api/auth/menu
        Route::apiResource('menu', MenuController::class);

        //Restaurant Routes /api/auth/dishe
        Route::apiResource('dishes', DisheController::class);

    });
});
