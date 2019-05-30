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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

/**
 * Auth Routes
 */
Route::group(['middleware' => 'auth'], function () {

    /**
     * Tenant Switch Route
     */
    Route::get('/tenant/{company}', 'TenantController@switch')->name('tenant.switch');

    /**
     * Company Routes
     */
    Route::resource('/companies', 'CompanyController');
});
