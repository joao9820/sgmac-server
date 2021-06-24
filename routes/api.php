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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/signon', 'Api\\AuthController@register');
Route::post('/signin', 'Api\\AuthController@login');

Route::namespace('Api')->middleware('apiJWT')->group(function() {
   Route::get('/responsibilities', 'FuncoesController@index');
   Route::get('/medicines', 'MedicamentosController@index');
   Route::get('/pacients', 'PacientesController@index');
   Route::get('/users', 'UsersController@index');
   Route::delete('/users/{id}', 'UsersController@destroy');
   Route::get('/illnesses', 'DoencasController@index');

   Route::apiResource('/solicitations', 'SolicitacoesController');

   Route::post('/signout', 'AuthController@logout'); 

});

//Route::post('/signon', 'Api/')
