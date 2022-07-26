<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::get('/', function () {
    return view('welcome');
});


//Contacts
Route::get('/contacts', function() {
    return "GET contacts";
});

Route::post('/contacts', function(){
    return "POST contacts";
});

Route::put('/contacts', function () {
    return "PUT contacts";
});

Route::delete('/contacts', function() {
    return "DELETe contacts";
});