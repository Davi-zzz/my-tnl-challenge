<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\API\PublicController;
use App\Http\Controllers\API\RestaurantController;

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

Route::get('/',[PublicController::class, 'listRestaurants']);

Route::group(['prefix' => 'public'], function () {
    
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register']);
    // Route::get('/index', [PublicController::class, 'listRestaurants'])->name('index');
    Route::post('/restaurant/show', [PublicController::class, 'showRestaurant']);
    
});
Route::group(['middleware' => ['auth:sanctum'], 'prefix' => 'auth'], function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/restaurant/create', [RestaurantController::class, 'store']);
    


});
