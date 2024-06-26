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
Route::post('/orgchart/drag_n_drop', 'OrgChartController@dragAndDrop')->name('postOrgChart');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/datatable/init', 'HomeController@createDatatable')->name('create');
Route::post('/datatable/create', 'HomeController@createRow')->name('create.row');
Route::post('/datatable/edit', 'HomeController@editRow')->name('edit.row');
Route::post('/datatable/delete', 'HomeController@deleteRow')->name('delete.row');
Route::post('/datatable/upload_avatar', 'HomeController@uploadPhoto')->name('upload.photo');
