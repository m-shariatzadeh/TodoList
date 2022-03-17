<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\TodoGroupController;
use App\Http\Controllers\UserController;
use App\Models\User;
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

Route::middleware('auth')->get('todo',function (){
    return view('todo.index');
})->name('todo');


Route::resource('api/todos',TodoController::class)->middleware('auth');
Route::get('api/usersList',[UserController::class,'index'])->middleware('auth');
//Route::get('api/usersList/{user}',[UserController::class,'test'])->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
