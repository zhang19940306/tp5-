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
use think\Route;
Route::rule('login', 'index/user/login', 'get');
Route::rule('dologin', 'index/user/dologin', 'post');
Route::get('register', 'index/user/register');
Route::post('doregister', 'index/user/doregister');

//商品详情
Route::get('api/product/:id', 'api/product/read', ['id' => '\d+']);

//商品列表
Route::get('api/product', 'api/product/index');

//注册接口
Route::post('user/doregister', 'api/user/doregister');

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],
    // 'article/:id' => ['index/article/read', ['method' => 'get'], ['id' => '\d+']],
    // 'article'     => ['index/article/index', ['method' => 'get']],

    // 路由分组
    '[article]'   => [
        ':id' => ['index/article/read', ['method' => 'get'], ['id' => '\d+']],
        '/'   => ['index/article/index', ['method' => 'get']],
    ],

];
