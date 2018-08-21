<?php
if(isset($GLOBALS['urlext'])&&$GLOBALS['urlext'] == 'css' || $GLOBALS['urlext'] == 'js'){
    substr($GLOBALS['html'], 0, 1) == '?'                                                                               and  $GLOBALS['html'] = substr($GLOBALS['html'], 1);
    if($v_config['web_debug'] == "on")                                                                               echo "/*---调试信息 start---\r\n" . implode("\r\n", $GLOBALS['debug']) . "\r\n---调试信息 end---*/\r\n";
    echo $GLOBALS['html'];
}else if(in_array($GLOBALS['urlext'], $extarr) || stripos($GLOBALS['html'], '<head>') > -1 || stripos($GLOBALS['html'], '<html>') > -1 || stripos($GLOBALS['html'], '<body>') > -1){
    require_once (DATA_RULES.'result/debug.php');
    require_once (DATA_RULES.'result/getTplPath.php');
    require_once (DATA_RULES.'result/vxiaotou_link.php');
    include($tplfile); //$tplfile=echo $html;
}else echo $GLOBALS['html'];

