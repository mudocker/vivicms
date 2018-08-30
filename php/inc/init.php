<?php
!defined('VV_INIT') and  exit(header("HTTP/1.1 403 Forbidden"));
define('VV_VERSION', '666');


define('RUN_TIME', debug_time());
require(VV_INIT . '/memory_get_usage.php');
require(VV_INIT . '/get_REQUEST_URI.php');
$version = "兄弟发大财小偷系统 " . VV_VERSION;
require(VV_INIT . '/switch_action.php');
$randtime = time();
require(VV_INIT . '/auth_tips_html.php');


require(VV_INIT . '/ads_conf.php');

//require(VV_INIT . '/file_get_cache.php');

?>
