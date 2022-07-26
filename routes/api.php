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

Route::group([],
    function(){
        Route::get('/contacts/{id}', function($id) {
            return "GET contact by id" .$id;
        });
        
        Route::put('/contacts/{id}', function($id) {
            return "PUT contact by id" .$id;
        });
        
        Route::post('/contacts', function() {
            return "POST contact by id";
        });
        
        Route::delete('/contacts/{id}', function($id) {
            return "DELETe contact by id" .$id;
        });
    }
);
