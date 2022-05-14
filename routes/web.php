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

// Route::get('/', [Todo::class, 'index']);
Route::get('/', 'App\Http\Controllers\Todo@index');
Route::post('/todos', 'App\Http\Controllers\Todo@store');
Route::get('/edit_task/{id}', 'App\Http\Controllers\Todo@edit');
Route::put('/todos/update', 'App\Http\Controllers\Todo@update');
Route::get('/delete_task/{id}', 'App\Http\Controllers\Todo@destroy');
Route::get('/approve_task/{id}', 'App\Http\Controllers\Todo@approve_task');
