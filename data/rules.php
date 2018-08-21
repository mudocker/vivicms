<?php
require_once (VV_DATA.'/rules/config.php');
include(VV_INC . "/delcache.php");
require_once(VV_DATA.'/rules/getTargetId.php');
$caiji_config = require(VV_DATA . "/config/{$collectid}.php");
require_once(DATA_RULES.'urlencode.php');
require_once (DATA_RULES.'convert_QUERY_STRING_charset.php');
require_once (DATA_RULES.'convert_param_charset.php');
require_once (DATA_RULES.'getImgDomain.php');
require_once (DATA_RULES.'from_url_geturl.php');
require_once (DATA_RULES.'server_url.php');
require_once (DATA_RULES.'WEB_ROOT.php');
require_once (DATA_RULES.'cachetime_cacheid.php');
require_once (DATA_RULES.'SCRIPT.php');
require_once (DATA_RULES.'urlext/Content_type.php');
require_once (DATA_RULES.'plus_run_before_get.php');
require_once (DATA_RULES.'urlext/in_imgarr.php');
require_once (DATA_RULES.'urlext/css.php');
require_once (DATA_RULES.'urlext/header_location_js.php');
require_once (DATA_RULES.'urlext/header_location_xml.php');
require_once (DATA_RULES.'urlext/header_location_swf.php');
include(VV_DATA . '/rules_get.php');
require_once(DATA_RULES.'ac_yulan.php');
require_once (DATA_RULES.'echo_html.php');
!ret_true() and  exit('error');

?>