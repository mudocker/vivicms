<?php


function delSlash(){
    substr($_SERVER['QUERY_STRING'], 0, 1) == '/'                                                                     and    $_SERVER['QUERY_STRING'] = substr($_SERVER['QUERY_STRING'], 1); //得到 斜杠后面的数据
}
function getUrlWithIndexPhp($server_url){
  $param=  $_SERVER["QUERY_STRING"]?'?' . $_SERVER["QUERY_STRING"]:'';
    $GLOBALS['geturl'] = $server_url . $_SERVER["PHP_SELF"] .$param;
}
function getUrlNoIndexPhp($server_url){
    $GLOBALS['geturl'] = $server_url . '/' . $_SERVER['QUERY_STRING'];
}





function getCharsetAndHeader($html,$callHeader=true){
     $charset=preg_match('/<meta.*charset.?=[ |"]?([^ ]*).?".*>/i', $html,$matches)?  $matches[1]:false;
     $callHeader and  header("Content-Type:text/html; charset={$charset}");
    return $charset;
}

