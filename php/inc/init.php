<?php
if(!defined('VV_INC'))exit(header("HTTP/1.1 403 Forbidden"));
define('VV_VERSION', '666');
require(VV_INC . '/define.php');
require(VV_INC . '/function.php');
define('RUN_TIME', debug_time());
require(VV_INC . '/init/memory_get_usage.php');
require(VV_INC . '/init/get_REQUEST_URI.php');
$version = "兄弟发大财小偷系统 " . VV_VERSION;
require(VV_INC . '/init/switch_action.php');
$randtime = time();
require(VV_INC . '/init/auth_tips_html.php');
//require(VV_INC . '/init/temp_head.php');
$linkwordfile = VV_DATA . "/linkword.conf";
require(VV_INC . '/init/ads_conf.php');

require(VV_INC . '/init/file_get_cache.php');

?>
