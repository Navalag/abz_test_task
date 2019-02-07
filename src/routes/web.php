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

Auth::routes();

Route::get('/', 'OrgChartController@index')->name('orgChart');
Route::get('/orgchart/{relation}/{nodeId}', 'OrgChartController@orgChartGetJSON')->name('postOrgChart');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/create', 'HomeController@create')->name('create');

Route::post('/create', 'HomeController@createRow')->name('create.row');
Route::post('/edit', 'HomeController@editRow')->name('edit.row');
Route::post('/delete', 'HomeController@deleteRow')->name('delete.row');
