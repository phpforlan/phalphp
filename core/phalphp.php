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
        $ctrl = $route->ctrl; //index
        $action = $route->action; //index

        $ctrlFile = APP.'/ctrl/'.$ctrl.'Ctrl.php';
        if( is_file($ctrlFile) ){
            include $ctrlFile;
            //根据命名空间，实例化对应的控制器
            $controller = '\\'.MODULE.'\ctrl\\'.$ctrl.'Ctrl';
            $objCtrl = new $controller;

            //判断action方法是否存在
            if( method_exists($objCtrl,$action) ){
                $objCtrl->$action(); //执行对应的action方法
            }else {
                throw  new \Exception('找不到对应的action方法');
            }

        }else{
            throw new \Exception('找不到对应的控制器'.$ctrlFile);
        }

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