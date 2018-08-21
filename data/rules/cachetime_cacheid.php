<?php
if(empty($_SERVER['QUERY_STRING'])){
    $cachefile = VV_CACHE . '/index.html';
    $cachetime = $v_config['indexcache'];
    $GLOBALS['geturl'] = $from_url;
}else{
    substr($_SERVER['QUERY_STRING'], 0, 1) == '/'                                                                     and    $_SERVER['QUERY_STRING'] = substr($_SERVER['QUERY_STRING'], 1);
    if($_SERVER["PATH_INFO"])                                                                                         $GLOBALS['geturl'] = $server_url . $_SERVER["PHP_SELF"] . ($_SERVER["QUERY_STRING"]?'?' . $_SERVER["QUERY_STRING"]:'');
    else if(!isset($GLOBALS['geturl']))                                                                               $GLOBALS['geturl'] = $server_url . '/' . $_SERVER['QUERY_STRING'];

    $cacheid = md5($GLOBALS['geturl']);
    $cachefile = getcachefile($cacheid);
    $cachetime = $v_config['othercache'];
}