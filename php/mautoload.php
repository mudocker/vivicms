<?php


use md\data\rules\ac_yulan;

spl_autoload_register('myAutoLoad', true, true);
function myAutoLoad($className){


    $className= './' .str_replace('md\\','',$className).'.php';
    file_exists($className) and $data= require($className);

    return $data;
}
