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

Route::prefix('klusbib')->group(function() {
//    Route::get('/', 'KlusbibController@index');
    Route::get('/', [
        'as' => 'klusbib',
        'uses' => 'KlusbibController@index' ]);
    Route::get('/users', [
        'as' => 'klusbib.users.index',
        'uses' => 'UsersController@index' ]);
    Route::get('/users/{user}/edit', [
        'as' => 'klusbib.users.edit',
        'uses' => 'UsersController@edit' ]);
});
Route::group(
    ['prefix' => 'users',
        'middleware' => ['auth']],
    function () {
        // override user edit
        Route::get('{user}/edit', [
            'as' => 'users.edit',
            'uses' => '\Modules\Klusbib\Http\Controllers\UsersController@edit'
            //            'uses' => 'AssetsController@dueForAudit'
        ]);
    });