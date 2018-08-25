<?php

use md\data\flow\getCacheFilenName;
use md\data\rules\ac_yulan;
use md\data\rules\convert_param_charset;
use md\data\rules\echo_html;
use md\data\rules\from_url_geturl;
use md\data\rules\get_url_charset;
use md\data\rules\getImgDomain;
use md\data\rules\getTargetId;
use md\data\rules\plus_run_before_get;
use md\data\rules\server_url;
use md\data\rules\urlencode;
use md\data\rules\urlext\Content_type;
use md\data\rules\urlext\css;
use md\data\rules\urlext\in_imgarr;
use md\data\rules\urlext\location_js;
use md\data\rules\urlext\location_swf;
use md\data\rules\WEB_ROOT;
use md\inc\delcache;


require_once(VV_DATA . '/rules/config.php');
require_once(DRULES . 'func.php');
new delcache();
new getTargetId();
new urlencode();
new get_url_charset();
new convert_param_charset();
new getImgDomain();
new from_url_geturl($from_url,$isouturl);
new server_url();
new WEB_ROOT();
new getCacheFilenName();
require_once(DRULES . 'SCRIPT.php');
new Content_type();
new plus_run_before_get();
new in_imgarr();
new css();
new location_js();
// require_once(DRURLEXT . 'header_location_xml.php');
new location_swf();


if (true){
!defined('VV_INC') and exit(header("HTTP/1.1 403 Forbidden"));
define('DRGET',VV_DATA.'/rules_get/');
define('DREPLACE',VV_DATA.'/rules_get/replace/');
require_once (DRGET.'func.php');
require_once (DRGET.'v_config/sifton.php');
require_once (DREPLACE.'geturl.php');
}
require_once (DRGET.'getHtmlCode.php');
require_once (DREPLACE.'main_new.php');
require_once (DREPLACE.'from_title.php');
require_once (DREPLACE.'search_url.php');
require_once (DREPLACE.'replace_zdy.php');
require_once (DREPLACE.'zdy.php');
require_once (DREPLACE.'config_ads2.php');
require_once (DREPLACE.'no_css_js.php');
require_once (DRGET.'linkword_on.php');
plus_run('end');
new ac_yulan();
new echo_html();
                                                                        //showHtml
!ret_true() and  exit('error');

?>