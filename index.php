<?php
/**
 * @author lurenzhong@xiaomi.com
 * @date 2016-08-21 16:39
 * @file index.php
 * @brief 框架入口文件
 * @version
 */

//定义常用目录
define('PHALPHP', realpath('./'));
define('APP', PHALPHP.'/app');
define('CORE', PHALPHP.'/core');

define('DEBUG', true);

if( DEBUG ){
    ini_set('display_errors', 'On');
}else{
    ini_set('display_errors', 'Off');
}

//引入框架核心文件
include CORE. '/phalphp.php';

//自动加载
spl_autoload_register('\core\phalphp::load');

\core\phalphp::run(); //执行run方法