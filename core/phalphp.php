<?php
/**
 * @author lurenzhong@xiaomi.com
 * @date 2016-08-21 16:50
 * @file phalphp.php
 * @brief 框架核心文件
 * @version
 */

namespace core;

use core\lib\route;

class phalphp
{
    static public $classMap = array();

    /**
     * run方法
     */
    static public function run()
    {
        //通过路由类获取ctrl和action
        $route = new \core\lib\route();
        $ctrl = $route->ctrl;
        $action = $route->action;

    }


    /**
     * 自动加载函数
     * @param $className
     * @return bool
     */
    static public function load($className)
    {
        if( isset(self::$classMap[$className]) ){
            return true;
        }else{
            // core\lib\route
            $filePath = PHALPHP.'/'.str_replace('\\','/',$className).'.php';

            if( is_file($filePath) ){
                include $filePath;
                self::$classMap[$className] = $filePath; //保存到$classMap中，表示已加载过
            }else{
                return false;
            }
        }

    }

}