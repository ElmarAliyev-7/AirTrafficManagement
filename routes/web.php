<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    DashboardController,
    AuthController,
};

//Front Routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

//Back Routes
Route::group(['prefix' => 'admin' , 'as'  => 'admin.'], function() {

    Route::group(['middleware'=> 'isNotLogin'], function(){
        Route::match(['get', 'post'], '/', [AuthController::class, 'index'])->name('login');
    });

    Route::group(['middleware'=> 'isLogin'], function(){
        Route::get('/dashboard',      [DashboardController::class, 'index'])->name('dashboard');
        Route::match(['get', 'put'],'/about-us', [DashboardController::class, 'aboutUs'])->name('about-us');

        Route::match(['get', 'put'], '/profile', [AuthController::class, 'profile'])->name('profile');
        Route::get('/logout',   [AuthController::class, 'logOut'])->name('logout');
    });
});

