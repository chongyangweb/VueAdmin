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
		$token = JWTAuth::attempt(['username'=>'6666','password'=>'123456']);
		var_dump($token);
		return 123;
	});

	// 视图公共部分 index.vue
	Route::get('/index','IndexController@index');

	// 单独出来的各种接口
	Route::match(['options','post','get'],'/Auto/content_upload', 'AutoController@content_upload');

	// 登陆接口
	Route::post('/login', 'LoginController@login');
	Route::get('/logout', 'LoginController@logout');
	Route::post('/checkUser', 'LoginController@checkUser');

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

	// 幻灯片
	Route::match(['get','post'],'/slide/add', 'SlideController@add');
	Route::post('/slide/del', 'SlideController@del');
	Route::match(['get','post'],'/slide/edit/{id}', 'SlideController@edit');
	Route::post('/slide/index', 'SlideController@index');
	Route::match(['options','post'],'/slide/slide', 'SlideController@slide');

	// 系统设置
	Route::match(['get','post'],'/setting/index','SettingController@index');
	Route::match(['options','post'],'/setting/upload_logo', 'SettingController@upload_logo');

	// 文章产品专题栏目
	Route::match(['get','post'],'/columns/add/{is_type?}', 'ColumnsController@add')->where('is_type', '[0-9]+');
	Route::post('/columns/del', 'ColumnsController@del');
	Route::match(['get','post'],'/columns/edit/{id}/{is_type?}', 'ColumnsController@edit')->where('is_type', '[0-9]+');
	Route::post('/columns/index', 'ColumnsController@index');

	// 文章管理
	Route::match(['get','post'],'/article/add', 'ArticleController@add');
	Route::post('/article/del', 'ArticleController@del');
	Route::match(['get','post'],'/article/edit/{id}', 'ArticleController@edit');
	Route::post('/article/index', 'ArticleController@index');
	Route::match(['options','post'],'/article/thumb', 'ArticleController@thumb');

	// 产品管理
	Route::match(['get','post'],'/product/add', 'ProductController@add');
	Route::post('/product/del', 'ProductController@del');
	Route::match(['get','post'],'/product/edit/{id}', 'ProductController@edit');
	Route::post('/product/index', 'ProductController@index');
	Route::match(['options','post'],'/product/thumb', 'ProductController@thumb');

	// 专题管理
	Route::match(['get','post'],'/seminar/add', 'SeminarController@add');
	Route::post('/seminar/del', 'SeminarController@del');
	Route::match(['get','post'],'/seminar/edit/{id}', 'SeminarController@edit');
	Route::post('/seminar/index', 'SeminarController@index');
	Route::match(['options','post'],'/seminar/thumb', 'SeminarController@thumb');
});