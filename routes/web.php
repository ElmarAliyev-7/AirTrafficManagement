<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    DashboardController,
    AuthController,
    PilotController,
    PlaneController,
    SliderController,
    FlightController,
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
        //Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        //Sliders
        Route::get('sliders', [DashboardController::class, 'sliders'])->name('sliders');
        Route::match(['get', 'post'],'/create-slider',     [SliderController::class, 'create'])->name('create-slider');
        Route::match(['get', 'put'],'/update-slider/{id}', [SliderController::class, 'update'])->name('update-slider');
        Route::delete('/delete-slider/{id}',               [SliderController::class, 'delete'])->name('delete-slider');

        //About us
        Route::match(['get', 'put'],'/about-us', [DashboardController::class, 'aboutUs'])->name('about-us');

        //Pilots
        Route::get('/pilots', [DashboardController::class, 'pilots'])->name('pilots');
        Route::match(['get', 'post'],'/create-pilot',     [PilotController::class, 'create'])->name('create-pilot');
        Route::match(['get', 'put'],'/update-pilot/{id}', [PilotController::class, 'update'])->name('update-pilot');
        Route::delete('/delete-pilot/{id}', [PilotController::class, 'delete'])->name('delete-pilot');

        //Planes
        Route::get('planes', [DashboardController::class, 'planes'])->name('planes');
        Route::match(['get', 'post'],'/create-plane',     [PlaneController::class, 'create'])->name('create-plane');
        Route::match(['get', 'put'],'/update-plane/{id}', [PlaneController::class, 'update'])->name('update-plane');
        Route::delete('/delete-plane/{id}', [PlaneController::class, 'delete'])->name('delete-plane');

        //Flights
        Route::get('flights', [DashboardController::class, 'flights'])->name('flights');
        Route::match(['get', 'post'],'/create-flight',     [FlightController::class, 'create'])->name('create-flight');
        Route::match(['get', 'put'],'/update-flight/{id}', [FlightController::class, 'update'])->name('update-flight');
        Route::delete('/delete-flight/{id}', [FlightController::class, 'delete'])->name('delete-flight');

        //Profile
        Route::match(['get', 'put'], '/profile', [AuthController::class, 'profile'])->name('profile');

        //Logout
        Route::get('/logout',   [AuthController::class, 'logOut'])->name('logout');
    });
});

