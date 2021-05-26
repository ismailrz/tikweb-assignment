<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::namespace('App\Http\Controllers')->group(function(){
    ///////////////// User Api   //////////////////////
    Route::get('get-users', 'UserController@getUsers');
    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');
    Route::post('assign-role-to-user', 'UserController@assignRoleToUser');
    Route::post('delete-role-from-user', 'UserController@DeleteRoleFromUser');

    ///////////////// Role Api   //////////////////////
    Route::post('add-role', 'RoleController@addRole');



    ///////////////// Profile Api   //////////////////////
    Route::post('user-profile-information', 'ProfileController@userProfileInformation');

});