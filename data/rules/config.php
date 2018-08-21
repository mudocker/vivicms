<?php
!defined('VV_INC') and exit(header("HTTP/1.1 403 Forbidden"));
define('DATA_RULES',VV_DATA."/rules/");
banip();
$GLOBALS['debug'] = [];
$v_config['web_debug'] == "on"? @ini_set('display_errors', 'On'): error_reporting(0);