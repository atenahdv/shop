<?php

use Illuminate\Support\Facades\Route;


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

Route::prefix('api')->group(function (){
    Route::get('/categories','App\Http\Controllers\Backend\CategoryController@apiIndex');
    Route::post('/categories/attribute','App\Http\Controllers\Backend\CategoryController@apiIndexAttribute');
  });


Route::prefix('administrator')->group(function (){
    Route::get('/','App\Http\Controllers\Backend\MainController@mainpage');
    Route::resource('categories','App\Http\Controllers\Backend\CategoryController');
    Route::get('/categories/{id}/settings','App\Http\Controllers\Backend\CategoryController@indexSetting')->name('categories.indexSetting');
    Route::post('/categories/{id}/settings','App\Http\Controllers\Backend\CategoryController@saveSetting');
    Route::resource('attributes-group','App\Http\Controllers\Backend\AttributeGroupController');
    Route::resource('attributes-value','App\Http\Controllers\Backend\AttributeValueController');
    Route::resource('brands','App\Http\Controllers\Backend\BrandController');
    Route::resource('products','App\Http\Controllers\Backend\ProductController');
    Route::post('photos/upload','App\Http\Controllers\Backend\PhotoController@upload')->name('photos.upload');
});
Route::get('/administrator/categories/delete/{id}', 'App\Http\Controllers\Backend\CategoryController@destroy')
    ->name('categories.destroy');
Route::get('/administrator/attributes-group/delete/{id}', 'App\Http\Controllers\Backend\AttributeGroupController@destroy')
    ->name('attributes-group.destroy');
Route::get('/administrator/attributes-value/delete/{id}', 'App\Http\Controllers\Backend\AttributeValueController@destroy')
    ->name('attributes-value.destroy');
Route::get('/administrator/brands/delete/{id}', 'App\Http\Controllers\Backend\BrandController@destroy')
    ->name('brands.destroy');
