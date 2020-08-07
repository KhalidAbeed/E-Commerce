<?php

use Illuminate\Support\Facades\Route;
define('PAGINATION_COUNT',5);
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
Route::group(['namespace'=>'Admin','middleware'=>'auth:admin'],function(){
    Route::get('/', 'logincontroller@index')->name('admin.dashbord');

    ################ Start Languages routes ################################
    Route::group(['prefix'=>'languages'],function(){
        Route::get('/','LanguageController@index')->name('languages.all');
        Route::get('/create','LanguageController@create')->name('languages.create');
        Route::post('/create','LanguageController@store')->name('languages.store');

        Route::get('/edit/{id}','LanguageController@edit')->name('languages.edit');
        Route::post('/update/{id}','LanguageController@update')->name('languages.update');

        Route::get('/delete/{id}','LanguageController@destroy')->name('languages.destroy');


    });
    ################ End Languages routes ################################




     ################ Start Maincategories routes ################################
     Route::group(['prefix'=>'Main_categories'],function(){
        Route::get('/','MaincategoryController@index')->name('Maincategories.all');
        Route::get('/create','MaincategoryController@create')->name('Maincategories.create');
        Route::post('/create','MaincategoryController@store')->name('Maincategories.store');

        Route::get('/edit/{id}','MaincategoryController@edit')->name('Maincategories.edit');
        Route::post('/update/{id}','MaincategoryController@update')->name('Maincategories.update');

        Route::get('/delete/{id}','MaincategoryController@destroy')->name('Maincategories.destroy');


    });
    ################ End Maincategories routes ################################

});



Route::group(['namespace'=>'Admin','middleware'=>'guest:admin'],function(){
    Route::get('login','logincontroller@getlogin');
    Route::post('login','logincontroller@login')->name('admin.login');
});

Route::get('lang',function(){
    return getlang();
});
