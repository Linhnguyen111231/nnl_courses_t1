<?php

use App\Http\Controllers\API\CoursesAPIController as APICoursesAPIController;
use App\Http\Controllers\API\CoursesAPIController;
use App\Http\Controllers\CoursesController;
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


Route::post('/getsearch',[CoursesController::class,'search']);
Route::post('/add-course',[CoursesController::class,'store']);
Route::post('/delete/selected',[CoursesController::class,'delete']);
Route::delete('/delete/{id}',[CoursesController::class,'destroy']);
Route::post('/delete/all',[CoursesController::class,'delete']);
Route::post('/edit/show/{id}',[CoursesController::class,'show']);
Route::put('/edit-course/{id}',[CoursesController::class,'update']);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});