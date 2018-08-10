<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

/*return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

];*/
use think\Route;
//后台首页
Route::get('/admin','admin/index/index'); 
Route::get('/admin/left','admin/index/left'); 
Route::get('/admin/top','admin/index/top'); 
Route::get('/admin/main','admin/index/main'); 


//后台用户
Route::any('/user/index','admin/user/index'); //用户首页列表
Route::get('/user/add','admin/user/add'); //用户添加
Route::get('/user/del','admin/user/delete'); //用户删除
Route::any('/user/upd','admin/user/upd'); //用户编辑

//后台登录
Route::any('/public/login','admin/public/login'); //用户登录
Route::get('/public/logout','admin/public/logout'); //用户退出

//权限表
Route::get('/auth/add','admin/auth/add'); //权限添加
Route::get('/auth/index','admin/auth/index'); //权限列表
Route::get('/auth/upd','admin/auth/upd'); //权限编辑

//角色表
Route::any('/role/add','admin/role/add'); //权限编辑
Route::get('/role/index','admin/role/index'); //权限列表
Route::any('/role/upd','admin/role/upd'); //权限列表

//商品类型表
Route::get('type/getattr','admin/type/getattr');//查看商品类型的属性列表
Route::get('type/index','admin/type/index');//类型列表
Route::any('type/upd','admin/type/upd');//编辑类型
Route::any('type/add','admin/type/add');//添加类型
Route::get('type/del','admin/type/del');//删除类型