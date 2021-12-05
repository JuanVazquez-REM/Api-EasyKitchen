<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Usuarios;
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



Route::get('hola','controladores\Usuarios@hola');
Route::post('register','controladores\Usuarios@insertarUser');
Route::post('login','controladores\Usuarios@LogIn');

Route::middleware('auth:sanctum')->get('logout','controladores\Usuarios@LogOut');
Route::middleware('auth:sanctum')->get('check','controladores\Usuarios@Check');

Route::middleware('auth:sanctum')->get('users','controladores\Usuarios@usuarios');
Route::middleware('auth:sanctum')->post('update/user','controladores\Usuarios@actualizarUser');


Route::middleware('auth:sanctum')->get('recetas','RecetasController@mostrar');
