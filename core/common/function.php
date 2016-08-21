<?php
/**
 * @author lurenzhong@xiaomi.com
 * @date 2016-08-21 17:48
 * @file function.php
 * @brief
 * @version
 */

/**
 * 打印函数
 * @param $var
 */
function p($var)
{
    if( is_bool($var) ){
        var_dump($var);
    }elseif( is_null($var) ){
        var_dump(null);
    }else{
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }
}