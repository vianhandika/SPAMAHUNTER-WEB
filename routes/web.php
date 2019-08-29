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

// Route::get('/', function () {
//     return view('index');
// });

// Route::get('/vueapp/{any}', function(){
//     return view('vueapp');
// })->where('any', '.*');

// Route::get('/vueapp', function(){
//     return view('vueapp');
// });
Route::get('verify/{verifycode}','UserController@emailverification')->name('verifemail');
Route::get('/{any}', function(){
    return view('index');
})->where('any', '([A-z\d-\/_.]+)?');



// Route::get('/event/{id}', function () {return view('index');});

// Route::get('/user', function(){
//     return view('user');
// });

// Route::get('/admin/manageevent', function(){
//     return view('index');
// });