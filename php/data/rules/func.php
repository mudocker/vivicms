<?php
function getCacheFromIndex(&$cachefile, &$cachetime, $v_config, $from_url){
    $cachefile = VV_CACHE . '/index.html';
    $cachetime = $v_config['indexcache'];
    $GLOBALS['geturl'] = $from_url;
}
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
function getCache(&$cacheid,&$cachefile,&$cachetime,$v_config){
    $cacheid = md5($GLOBALS['geturl']);
    $cachefile = getcachefile($cacheid);
    $cachetime = $v_config['othercache'];
}

function getCacheAbout(&$cacheid,&$cachefile,&$cachetime,$v_config,$server_url){
    delSlash();
    if(isset($_SERVER["PATH_INFO"])&&$_SERVER["PATH_INFO"])                                                         getUrlWithIndexPhp($server_url);
    else if(!isset($GLOBALS['geturl']))                                                                               getUrlNoIndexPhp($server_url);
    getCache($cacheid,$cachefile,$cachetime,$v_config);
}