<?php
!defined('VV_INC') and exit(header("HTTP/1.1 403 Forbidden"));
define('DRULES',VV_DATA."/rules/");
define('DRURLEXT',VV_DATA."/rules/urlext/");
function irule($file){
  return  require_once(DRULES .$file);
}
function iext($file){
    return  require_once(DRURLEXT .$file);
}

banip();
$GLOBALS['debug'] = [];
$v_config['web_debug'] == "on"? @ini_set('display_errors', 'On'): error_reporting(0);