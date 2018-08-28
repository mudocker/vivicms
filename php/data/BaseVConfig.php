<?php
/**
 * Created by PhpStorm.
 * User: ACER-VERITON
 * Date: 2018/8/28
 * Time: 14:36
 */

namespace md\data;


class BaseVConfig
{
    function __set($name, $value){
        $GLOBALS['v_config'][$name]=$value;
    }


    function __get($name){
        return isset($GLOBALS['v_config'][$name])?$GLOBALS['v_config'][$name]:null;
    }
}