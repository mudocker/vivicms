<?php

if (true) {
    require_once(VV_DATA . '/rules/config.php');
    require_once(DRULES . 'func.php');
    include(VV_INC . "/delcache.php");
    require_once(DRULES . 'getTargetId.php');
    require_once(DRULES . 'urlencode.php');
    require_once(DRULES . 'convert_QUERY_STRING_charset.php');
    require_once(DRULES . 'convert_param_charset.php');
    require_once(DRULES . 'getImgDomain.php');
    require_once(DRULES . 'from_url_geturl.php');
    require_once(DRULES . 'server_url.php');
    require_once(DRULES . 'WEB_ROOT.php');
    require_once(VV_DATA . '/flow/getCacheFilenName.php');
    require_once(DRULES . 'SCRIPT.php');
    require_once(DRURLEXT . 'Content_type.php');
    require_once(DRULES . 'plus_run_before_get.php');
    require_once(DRURLEXT . 'in_imgarr.php');
    require_once(DRURLEXT . 'css.php');
    require_once(DRURLEXT . 'header_location_js.php');
    require_once(DRURLEXT . 'header_location_xml.php');
    require_once(DRURLEXT . 'header_location_swf.php');

}                                                                                                           //ȡURL ת��

include(VV_DATA . '/rules_get.php');                                                                                //getHtml
require_once(DRULES.'ac_yulan.php');
require_once (DRULES.'echo_html.php');                                                                               //showHtml
!ret_true() and  exit('error');

?>