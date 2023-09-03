<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Api\Controllers\Auth\AuthenticationController;
use App\Http\Api\Controllers\Product\ProductController;
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


Route::post('register', [AuthenticationController::class, 'register'])->name('api.register');
Route::post('login', [AuthenticationController::class, 'login'])->name('api.login');
Route::get('refresh', [AuthenticationController::class, 'refresh'])->name('api.token.refresh');

    // Product
    Route::group(['middleware' => ['api','auth'],'prefix' => 'product'],function (){
        Route::post('create',[ProductController::class,'create'])->name('product.create');
        Route::get('list',[ProductController::class,'index'])->name('product.list');
        Route::put('update/{product}',[ProductController::class,'update'])->name('product.update');
        Route::get('show/{product}',[ProductController::class,'show'])->name('product.show');
        Route::post('delete/{product}',[ProductController::class,'delete'])->name('product.delete');
    });
