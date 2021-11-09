<?php

use App\Http\Controllers\BlogController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/blog', [BlogController::class, 'index']);
Route::post('/blog', [BlogController::class, 'store']);
Route::get('/blog/create', [BlogController::class, 'create']);
Route::get('/blog/{blog}/edit', [BlogController::class, 'edit']);
Route::get('/blog/{blog}', [BlogController::class, 'show']);
Route::delete('/blog/{blog}', [BlogController::class, 'destroy']);
Route::patch('/blog/{blog}', [BlogController::class, 'update']);
