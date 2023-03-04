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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['namespace' => 'Api'], function(){
   
    // todo list apis
    Route::get('/todo-lists','TodoController@index')->name('todo.lists');

    Route::post('/todo/add','TodoController@store')->name('todo.store');

    Route::get('/todo/{id}/details','TodoController@details')->name('todo.details');

    Route::post('/todo/{id}/update','TodoController@update')->name('todo.update');

    Route::delete('/todo/{id}/delete','TodoController@delete')->name('todo.delete');


    // todotasks lists apis

    Route::get('/todotask-lists','TodoTaskController@index')->name('todotask.lists');

    Route::post('/todotask/add','TodoTaskController@store')->name('todotask.store');

    Route::get('/todotask/{id}/details','TodoTaskController@details')->name('todotask.details');

    Route::post('/todotask/{id}/update','TodoTaskController@update')->name('todotask.update');

    Route::delete('/todotask/{id}/delete','TodoTaskController@delete')->name('todotask.delete');



});