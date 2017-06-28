<?php
use \think\Config;
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
//设置报错级别
if (APP_ENV == 'product') {
    error_reporting(E_ERROR);
}
// 配置文件目录
$path = APP_PATH . 'config' . DS . APP_ENV . DS;
// 加载模块配置
$config = Config::load($path . 'config' . CONF_EXT);
// 读取数据库配置文件
Config::load($path . 'database' . CONF_EXT, 'database');

//注册命名空间
//\think\Loader::addNamespace('library', ROOT_PATH . 'library/');
