<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ToolController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/category',[CategoryController::class,'category']);
Route::get('/category/{category}',[CategoryController::class,'show']);
Route::post('/category',[CategoryController::class,'store']);
Route::put('/category/{category}',[CategoryController::class,'update']);
Route::delete('/category/{category}',[CategoryController::class,'delete']);

Route::get('/tool',[ToolController::class,'tool']);
Route::get('/tool/{tool}',[ToolController::class,'show']);
Route::post('/tool',[ToolController::class,'store']);
Route::put('/tool/{tool}',[ToolController::class,'update']);
Route::delete('/tool/{tool}',[ToolController::class,'delete']);
