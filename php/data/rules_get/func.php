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

function getHtml($caiji){
    run_time(true);
    $GLOBALS['html'] = $caiji -> post($GLOBALS['geturl'], $_POST);
    return   true;
}

function readCache($cachefile){
    $GLOBALS['html'] = file_get_contents($cachefile);
    $GLOBALS['debug'][] = '使用缓存：是';
    $GLOBALS['debug'][] = '缓存路径：' . $cachefile;
}

function siteAbort($url){
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 3);                                                                       //3秒超时
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_exec($ch);
    $httpcode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $httpcode!=200;
}

function getIscollect($caiji_config,$cachefile,&$iscollect){
    $caiji_config['collect_close'] and  is_file($cachefile)? $iscollect = false: exit('not file');

}



function saveCache($cachefile){
   !empty($GLOBALS['html'])                                                                                           and   write($cachefile, $GLOBALS['html']);
    is_file($cachefile)                                                                                                 and   touch($cachefile, time() + 300);
}