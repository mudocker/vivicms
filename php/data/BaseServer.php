<?php
namespace md\data;

class BaseServer
{
    function __set($name, $value)
    {
        $_SERVER[$name]=$value;
    }


    function __get($name)
    {
        return isset($_SERVER[$name])?$_SERVER[$name]:null;
    }
}