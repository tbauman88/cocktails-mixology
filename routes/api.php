<?php

use App\Http\Controllers\DrinkController;
use App\Http\Controllers\IngredientController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('/drinks', [DrinkController::class, 'index'])->name('drinks');
//Route::get('/ingredients', [IngredientController::class, 'index'])->name('ingredients');

Route::resource('drinks', DrinkController::class)->only(['index', 'store']);
Route::resource('ingredients', IngredientController::class)->only('index');
