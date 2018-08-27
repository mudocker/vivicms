<?php
namespace md\data;

class BaseGlobal
{
    function __set($name, $value)
    {
        $GLOBALS[$name]=$value;
    }


    function __get($name)
    {
        return isset($GLOBALS[$name])?$GLOBALS[$name]:null;
    }
}