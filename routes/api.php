<?php

use App\Http\Controllers\Api\V1\TodoController;
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

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1')->group(function () {
    Route::get('todos', [TodoController::class, 'index']);
    Route::get('todos/{id}', [TodoController::class, 'show']);
    Route::post('todos', [TodoController::class,'store']);
    Route::delete('todos/{id}', [TodoController::class,'destroy']);
    Route::put('todos/{id}', [TodoController::class, 'update']);
});
