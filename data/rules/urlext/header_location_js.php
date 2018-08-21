<?php
if(SCRIPT == 'js' || $GLOBALS['urlext'] == 'js'){
    header("Content-type: text/javascript");
    $cachetime = $v_config['jscachetime'];
    list($cacheid,) = explode('?', $GLOBALS['geturl']);
    $cachefile = getjscachefile($cacheid, $server_host);
    if(!$v_config['jscache']){
        header("Location: {$GLOBALS['geturl']}");
        exit;
    }
    $v_config['cacheon'] = $v_config['jscache'];
}