<?php


function delSlash(){
    substr($_SERVER['QUERY_STRING'], 0, 1) == '/'                                                                     and    $_SERVER['QUERY_STRING'] = substr($_SERVER['QUERY_STRING'], 1); //得到 斜杠后面的数据
}





function HeaderCharset($html, $callHeader=true){
     $charset=preg_match('/<meta.*charset.?=[ |"]?([^ ]*).?".*>/i', $html,$matches)?  $matches[1]:false;
     $callHeader and $charset!=false and  header("Content-Type:text/html; charset={$charset}");
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



