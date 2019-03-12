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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Admin')->prefix('Admin')->group(function(){
	Route::get('test',function(){
		return 123;
	});

	// 视图公共部分 index.vue
	Route::get('/index','IndexController@index');

	// 栏目
	Route::get('/cat/add', 'CatController@add');
	Route::post('/cat/add', 'CatController@added');
	Route::post('/cat/del', 'CatController@del');
	Route::post('/cat/edit/{id}', 'CatController@edited');
	Route::get('/cat/edit/{id}', 'CatController@edit');
	Route::post('/cat/index', 'CatController@index');

	// 角色
	Route::get('/role/add', 'RoleController@add');
	Route::post('/role/add', 'RoleController@added');
	Route::post('/role/del', 'RoleController@del');
	Route::post('/role/edit/{id}', 'RoleController@edited');
	Route::get('/role/edit/{id}', 'RoleController@edit');
	Route::post('/role/index', 'RoleController@index');

	// 用户
	Route::match(['get','post'],'/user/add', 'UserController@add');
	Route::post('/user/del', 'UserController@del');
	Route::match(['get','post'],'/user/edit/{id}', 'UserController@edit');
	Route::post('/user/index', 'UserController@index');
	Route::match(['options','post'],'/user/avatar', 'UserController@avatar');
});