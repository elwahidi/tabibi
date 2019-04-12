<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/home', function () {
    return view('welcome');
})->name('home');

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('auth')->group(function (){

    // administrateur

    Route::get('parameter','UserController@parameter')->name('parameter');
    Route::post('parameter','UserController@update')->name('parameter.update');


    Route::get('psw','UserController@psw')->name('psw');
    Route::post('psw','UserController@updatePsw')->name('psw.update');

});

// establishment
Route::resource('establishment','EstablishmentController');


