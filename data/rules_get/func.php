<?php
function thisurl(){
    if(!empty($_SERVER["REQUEST_URI"])){
        $scrtName = $_SERVER["REQUEST_URI"];
        $nowurl = $scrtName;
    }else{
        $scrtName = $_SERVER["PHP_SELF"];
        if(empty($_SERVER["QUERY_STRING"])) $nowurl = $scrtName;
        else                                    $nowurl = $scrtName . "?" . $_SERVER["QUERY_STRING"];

    }
    return $nowurl;
}