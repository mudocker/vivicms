<?php
//https://l.cn/../1.js

if(strpos($_SERVER['QUERY_STRING'], '..') === false && @is_file(VV_ROOT . '/' . $_SERVER['QUERY_STRING'])){
    $getfile = false;
    if(in_array($GLOBALS['urlext'], $imgarr)){
        header("Content-type: image/{$GLOBALS['urlext']}");
        $getfile = true;
    }
    if($GLOBALS['urlext'] == 'js'){
        header("Content-type: text/javascript");
        $getfile = true;
    }
    if($GLOBALS['urlext'] == 'css'){
        header("Content-type: text/css");
        $getfile = true;
    }
    if($getfile){
        echo@file_get_contents(VV_ROOT . '/' . $_SERVER['QUERY_STRING']);
        exit();
    }
}