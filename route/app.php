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
use think\facade\Route;

Route::get('api/:version/banner/:id', ':version.banner/getBannerById');

// theme
Route::get('api/:version/theme', ':version.theme/getThemesByIds');
Route::get('api/:version/theme/:id', ':version.theme/getThemeProducts');

// product
Route::get('api/:version/product/by_category', ':version.product/getProductsByCategoryId');
Route::get('api/:version/product/:id', ':version.product/getProductById')
    ->pattern([ 'id' => '\d+' ]);
Route::get('api/:version/product/recent', ':version.product/getRecent');

// category
Route::get('api/:version/category/all', ':version.category/getAllCategories');

// token
Route::post('api/:version/token/user', ':version.token/getToken');

// address
Route::post('api/:version/address', ':version.address/createOrUpdateAddress')
    ->middleware([
        app\middleware\CheckPrimaryScope::class,
    ]);

// order
Route::post('api/:version/order', ':version.order/placeOrder')
    ->middleware([
        app\middleware\CheckExclusiveScope::class,
    ]);
