<?php
if(isset($GLOBALS['urlext'])&&$GLOBALS['urlext'] == 'css' || $GLOBALS['urlext'] == 'js'){
    substr($GLOBALS['html'], 0, 1) == '?'                                                                               and  $GLOBALS['html'] = substr($GLOBALS['html'], 1);
    if($v_config['web_debug'] == "on")                                                                               echo "/*---������Ϣ start---\r\n" . implode("\r\n", $GLOBALS['debug']) . "\r\n---������Ϣ end---*/\r\n";
    echo $GLOBALS['html'];
}else if(in_array($GLOBALS['urlext'], $extarr) || stripos($GLOBALS['html'], '<head>') > -1 || stripos($GLOBALS['html'], '<html>') > -1 || stripos($GLOBALS['html'], '<body>') > -1){
    require_once (DRULES.'result/debug.php');
    require_once (DRULES.'result/getTplPath.php');
    require_once (DRULES.'result/vxiaotou_link.php');
    include($tplfile); //$tplfile=echo $html;
}else echo $GLOBALS['html'];

