<?php

use App\Http\Controllers\ContactController;
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

        Route::get('/contacts', [ContactController::class, 'getAllContacts'])->middleware('test');

        Route::get('/contacts/{id}', [ContactController::class,'getContactById']);
        
        Route::put('/contacts/{id}', [ContactController::class,'putContactById']);
        
        Route::post('/contacts', [ContactController::class,'postContactById']);
        
        Route::delete('/contacts/{id}', [ContactController::class,'deleteContactById']);
    }
);
