<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VerificationController;

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


Route::get('/',[AuthController::class,'home']);
Route::get('/login',[AuthController::class,'index'])->name('login')->middleware('guest');;
Route::post('/login',[AuthController::class,'storeLogin']);
Route::post('/logout',[AuthController::class,'logout']);

Route::get('/register',[AuthController::class,'register'])->middleware('guest');;
Route::post('/register',[AuthController::class,'storeRegister']);

Route::get('/email/verify/need-verification',[VerificationController::class,'notice'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}',[VerificationController::class,'verify'])->middleware('auth', 'signed')->name('verification.verify');
Route::get('/email/verify/resend-verification',[VerificationController::class,'send'])->middleware('auth', 'throttle:6,1')->name('verification.send');

Route::middleware(['auth', 'auth.session', 'verified'])->group(function ()
{
  Route::get('/dashboard',[VerificationController::class,'dashboard']);
});
