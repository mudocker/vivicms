<?php


$isHtml=(isset($GLOBALS['urlext'])&&in_array($GLOBALS['urlext'], $extarr)) || stripos($GLOBALS['html'], '<head>') > -1 || stripos($GLOBALS['html'], '<html>') > -1 || stripos($GLOBALS['html'], '<body>') > -1;
if(isset($GLOBALS['urlext'])&&($GLOBALS['urlext'] == 'css' || $GLOBALS['urlext'] == 'js')){
    substr($GLOBALS['html'], 0, 1) == '?'                                                                               and  $GLOBALS['html'] = substr($GLOBALS['html'], 1);
    header("Content-Type:text/html; charset=utf-8");
    if($v_config['web_debug'] == "on")                                                                               echo "/*start---\r\n" . implode("\r\n", $GLOBALS['debug']) . "\r\nend---*/\r\n";
    echo $GLOBALS['html'];
}else if($isHtml){
    require_once (DRULES.'result/debug.php');
    require_once (DRULES.'result/getTplPath.php');
    require_once (DRULES.'result/vxiaotou_link.php');

    header("Content-Type:text/html; charset=utf-8");
    include($tplfile); //$tplfile=echo $html;

}else{
    header("Content-Type:text/html; charset=utf-8");
    echo $GLOBALS['html'];
}



