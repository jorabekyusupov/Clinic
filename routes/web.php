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
// Route::get('/', function(){echo "Tibbiyot"; });
Route::get('/picture/{id}', 'PictureController@getPicture')->name('picture.get-picture');
Route::get('/picture-thumbnail/{id}', 'PictureController@getPictureThumbnail')->name('picture.get-picture-thumbnail');
