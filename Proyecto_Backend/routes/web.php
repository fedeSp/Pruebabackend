<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'UsuarioController@index');

########## RUTAS ##########

Route::get('/vistaUsuarios', 'UsuarioController@index'); #vista principal
Route::get('/formAgregarUsuario', 'UsuarioController@create'); #vista de creacion de usuario
Route::post('/agregarUsuario', 'UsuarioController@store'); #proceso interno de creacion de usuario
Route::get('/formModificarUsuario/{id}', 'UsuarioController@edit'); #vista de modificacion de usuario
Route::post('/modificarUsuario/{id}', 'UsuarioController@update'); #proceso interno de modificacion de usuario
Route::post('/eliminarUsuario', 'UsuarioController@destroy'); #proceso de eliminado de usuario
