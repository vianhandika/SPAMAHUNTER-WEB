<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::resource ('user','UserController');


Route::patch    ('user/changepassword/{id}' ,'UserController@changePassword');
Route::post     ('user/uploadpicture/{id}' ,'UserController@changeUserPicture');
Route::patch    ('user/changerole/{id}' ,'UserController@changerole');
Route::get      ('user/getuser/{username}','UserController@getuserbylogin');
// Route::post     ('login' ,'AuthController@login');

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post ('login', 'AuthController@login');
});

Route::group(['middleware' => 'jwt.auth'], function(){
    Route::get  ('auth/user', 'AuthController@user');
    Route::post ('auth/logout', 'AuthController@logout');
});
Route::group(['middleware' => 'jwt.refresh'], function(){
    Route::get  ('auth/refresh', 'AuthController@refresh');
});

Route::resource ('event','EventController');
Route::patch    ('event/changehighlight/{id}','EventController@changeHighlight');
Route::patch    ('event/verify/{id}','EventController@eventverify');

Route::resource ('message','MessageController');

Route::resource ('profile','UserProfileController');
Route::get      ('profile/user/{id}','UserProfileController@getbyuser');

Route::resource ('comment','EventCommentController');
Route::get      ('comment/event/{id}','EventCommentController@commentbyevent');