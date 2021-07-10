<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', [UserController::class, 'show']);
// Admin
Route::group(['prefix' => 'user', 'as' => 'user.'], function() {
  Route::get('list',  [UserController::class, 'list']);
  Route::get('table/list', [UserController::class, 'userTable'])->name('list.table');
  Route::post('store', [UserController::class, 'store']);
  Route::get('edit', [UserController::class, 'edit']);
  Route::get('delete/{id}', [UserController::class, 'delete']);
});