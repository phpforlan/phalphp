<?php
/**
 * @author lurenzhong@xiaomi.com
 * @date 2016-08-22 20:51
 * @file conf.php
 * @brief 配置操作类
 * @version
 */

namespace core\lib;

class conf
{
    static public $conf = array(); //保存已加载配置

    /**
     * 获取指定配置信息
     * @param $name
     * @param $file
     * @return bool
     * @throws \Exception
     */
    static public function get($name, $file)
    {
        //判断是否已加载过
        if( isset(self::$conf[$file]) ){
            return isset( self::$conf[$file][$name] ) ? self::$conf[$file][$name] : false;
        }else{
            //判断配置文件是否存在
            $filePath = PHALPHP. '/core/config/'.$file . '.php';
            if( is_file($filePath) ){
                $conf = include $filePath;
                if( isset($conf[$name]) ){
                    self::$conf[$file] = $conf;
                    return $conf[$name];
                }else{
                    throw new \Exception('没有这个配置项'.$name);
                }
            }else{
                throw new \Exception('找不到配置文件'.$filePath);
            }
        }

    }

}