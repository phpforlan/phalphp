<?php
/**
 * @author lurenzhong@xiaomi.com
 * @date 2016-08-21 17:10
 * @file route.php
 * @brief 路由类，负责获取控制器名和方法名
 * @version
 */

namespace core\lib;

class route
{
    public $ctrl; //保存控制器
    public $action; //保存方法名

    /**
     * 初始化方法中获取控制器名和方法名
     * route constructor.
     */
    public function __construct()
    {
        if( isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != '/' ){
            $path = $_SERVER['REQUEST_URI'];
            $pathArr = explode('/', trim($path,'/'));

            //获取控制器名
            if( isset($pathArr[0]) ){
                $this->ctrl = $pathArr[0];
                unset($pathArr[0]);
            }

            //获取方法名
            if( isset($pathArr[1]) ){
                $this->action = $pathArr[1];
                unset($pathArr[1]);
            }else{
                $this->action = 'index';
            }

            //url多余部分转换成get参数
            $pathArr = array_values($pathArr); //重建索引
            if( !empty($pathArr) ){
                $count = count($pathArr);
                $i = 0;
                while( $i< $count ){ //循环获取参数
                    if( isset($pathArr[$i+1]) ){
                        $_GET[$pathArr[$i]] = $pathArr[$i+1];
                    }
                    $i = $i+2;
                }
            }

        }else{
            $this->ctrl = 'index';
            $this->action = 'index';
        }

    }

}