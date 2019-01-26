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

Route::get('/','DataController@index');

Route::resource('data', 'DataController');


View::composer(
    ['data-view','data-create','data-edit'],
    'App\Http\View\Composers\GenderComposer'
);

