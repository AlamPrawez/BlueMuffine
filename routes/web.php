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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function(){
  return redirect('/login');
});//->name('user.index');



Auth::routes();
Route::group(['middleware' => 'auth'], function () {
Route::post('/user/store' , [UserController::class,'store'])->name('user.store');
Route::get('/user/list' , [UserController::class,'list'])->name('user.list');
Route::get('/user/list/edit' , [UserController::class,'edit'])->name('user.list.edit');
Route::get('/user/list/delete' , [UserController::class,'delete'])->name('user.list.delete');
Route::post('/user/update' , [UserController::class,'update'])->name('user.update');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('user.index');

});
