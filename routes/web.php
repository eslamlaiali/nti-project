<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\AdminMidlleware;
use App\Http\Middleware\Logged;
use App\Http\Middleware\SupervisorMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function() {
    return view('login.index');
})->name('login');

Route::post('/verifyLogin', [MemberController::class, 'verifyLogin'])->name('verifyLogin.member');

Route::get('/logout', [MemberController::class, 'logout'])->name('logout.member');


Route::group(['middleware' => Logged::class] , function (){

    Route::group(['middleware' => AdminMidlleware::class] , function (){
        Route::resource('category', CategoryController::class);
        Route::post('category/isActive/{category}', 'App\Http\Controllers\CategoryController@isActive')->name('category.isActive');

        Route::resource('member', MemberController::class);
        Route::post('member/isActive/{member}', 'App\Http\Controllers\MemberController@isActive')->name('member.isActive');
    });

    Route::resource('product', ProductController::class);
    Route::post('product/isActive/{product}', 'App\Http\Controllers\ProductController@isActive')->name('product.isActive');

    Route::get('isAgree', [ProductController::class, 'showIsAgree'])->name('product.isAgree');

    Route::group(['middleware' => SupervisorMiddleware::class] , function (){
        Route::post('product/agree/{product}', 'App\Http\Controllers\ProductController@agree')->name('product.agree');
    });
});


