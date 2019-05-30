<?php

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here is where you can register 'tenant' routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "tenant" middleware group. Now create something great!
|
*/

Route::get('/home', 'HomeController@index')->name('home');

/**
 * Tenant Namespace Routes
 */
Route::group(['namespace' => 'Tenant'], function () {

    /**
     * Project Routes
     */
    Route::group(['prefix' => '/{project}', 'as' => 'projects.'], function () {

        /**
         * Files Routes
         */
        Route::resource('/files', 'ProjectFileController');
    });

    /**
     * Projects Routes
     */
    Route::resource('/projects', 'ProjectController');
});
