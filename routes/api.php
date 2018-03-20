<?php

use Illuminate\Http\Request;

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
Route::options('{all}', function (){
    $response = Response::make('OK');
    $response->header('Access-Control-Allow-Origin', '*');
    $response->header('Access-Control-Allow-Headers', '*');
    return $response;
});

Route::group(['middleware' => 'cors'], function (){

   Route::post('/login','LoginController@login');

   Route::group(['middleware' => 'jwt'], function (){
       Route::post('/test', 'LoginController@test');
   });
});