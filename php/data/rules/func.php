<?php


function delSlash(){
    substr($_SERVER['QUERY_STRING'], 0, 1) == '/'                                                                     and    $_SERVER['QUERY_STRING'] = substr($_SERVER['QUERY_STRING'], 1); //得到 斜杠后面的数据
}





function HeaderCharset($html, $callHeader=true){
     $charset=preg_match('/<meta.*charset.?=[ |"]?([^ ]*).?".*>/i', $html,$matches)?  $matches[1]:false;
   $GLOBALS['urlext']=='html' and   $charset==false and $charset=$GLOBALS['charset'];
    $GLOBALS['urlext']=='html' and    $callHeader and $charset!=false and  header("Content-Type:text/html; charset={$charset}");
    return $charset;
}

function isScript($caiji_config,$v_config){
    return  SCRIPT != 'search' && $_SERVER['QUERY_STRING']&& checktime_log_timeout() && $caiji_config['rewrite']
        && (substr($_SERVER["REQUEST_URI"], 0, 2) == '/?'
            || (!$v_config['web_remark']
                && substr($_SERVER["REQUEST_URI"], 0, 11) == '/index.php?')
            || preg_match('~^/' . $v_config['web_remark'] . '/\?~', $_SERVER["REQUEST_URI"])
            || preg_match('~^/' . $v_config['web_remark'] . '/index.php\?~', $_SERVER["REQUEST_URI"]));
}



function thisurl(){
    if(!empty($_SERVER["REQUEST_URI"])){
        $scrtName = $_SERVER["REQUEST_URI"];
        $nowurl = $scrtName;
    }else{
        $scrtName = $_SERVER["PHP_SELF"];
        $nowurl =  empty($_SERVER["QUERY_STRING"])?  $scrtName: $scrtName . "?" . $_SERVER["QUERY_STRING"];
    }
    return $nowurl;
}

function getHtml($caiji){
    run_time(true);
    $GLOBALS['html'] = $caiji ->post($GLOBALS['geturl'], $_POST);
    $GLOBALS['isgetnew']=true;
    return   true;
}



function readCache($cachefile){

    $GLOBALS['html'] =file_get_contents($cachefile);
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



function fSaveCache(){
    $cachefile= $GLOBALS['cachefile'];
    !empty($GLOBALS['html'])                                                                                           and   write($cachefile, $GLOBALS['html']);
    is_file($cachefile)                                                                                                 and   touch($cachefile, time() + 300);
}


function getCacheOver(&$cacheOver, &$iscollect, $caiji_config, $cachefile, $cachetime){
    getIscollect($caiji_config,$cachefile,$iscollect);
    $filetimeOver=(@filemtime($cachefile) + ($cachetime * 3600)) <= time();
    $cacheOver= $iscollect && (!is_file($cachefile) || $filetimeOver);
}
