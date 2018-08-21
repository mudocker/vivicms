<?php
!defined('VV_INC') and exit(header("HTTP/1.1 403 Forbidden"));
require_once (VV_DATA.'/rules_get/func.php');
require_once (VV_DATA.'/rules_get/v_config/sifton.php');
require_once (VV_DATA.'/rules_get/replace/geturl.php');
require_once (VV_DATA.'/rules_get/getHtmlCode.php');
require_once (VV_DATA.'/rules_get/replace/main_new.php');
require_once (VV_DATA.'/rules_get/replace/from_title.php');
require_once (VV_DATA.'/rules_get/replace/search_url.php');
require_once (VV_DATA.'/rules_get/replace/replace_zdy.php');
require_once (VV_DATA.'/rules_get/replace/zdy.php');
require_once (VV_DATA.'/rules_get/replace/config_ads2.php');
require_once (VV_DATA.'/rules_get/replace/no_css_js.php');
require_once (VV_DATA.'/rules_get/linkword_on.php');
plus_run('end');
?>