<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
//\think\Route::get('/about', 'index/index/about');

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '__alias__'   => [
        'about.html' => 'index/Index/about',
        'company'    => 'index/Index',
        'user'       => 'index/User',
        'news'       => 'index/News',
    ],
];
