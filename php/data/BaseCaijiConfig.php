<?php
/**
 * Created by PhpStorm.
 * User: ACER-VERITON
 * Date: 2018/8/28
 * Time: 14:35
 */

namespace md\data;


class BaseCaijiConfig
{

    function __set($name, $value){
        $GLOBALS['caiji_config'][$name]=$value;
    }


    function __get($name){
        return isset($GLOBALS['caiji_config'][$name])?$GLOBALS['caiji_config'][$name]:null;
    }
}