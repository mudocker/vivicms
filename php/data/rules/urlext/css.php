<?php
if($GLOBALS['urlext'] == 'css'){
    header("Content-type: text/css");
    $cachetime = $v_config['csscachetime'];
    list($cacheid,) = explode('?', $GLOBALS['geturl']);
    $cachefile = getcsscachefile($cacheid);
    $v_config['cacheon'] = $v_config['csscache'];
}