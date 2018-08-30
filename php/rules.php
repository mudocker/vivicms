<?php

use md\data\downOther;
use md\data\flow\SaveCache;
use md\data\params\GetParaseUrl_Schema_Host;
use md\data\ReadCacheNoTimeout;
use md\data\replace\replace_keyword_link;
use md\data\replace\replace_src;
use md\data\replace\replace_synonym;
use md\data\replace\replace_to_utf8;
use md\data\replace\replace_tongji;
use md\data\rules\ac_yulan;
use md\data\rules\echo_html;
use md\data\rules\headerContextType;
use md\data\rules\urlext\downFont;
use md\data\rules\urlext\downHtml;
use md\data\rules\urlext\downCss;
use md\data\rules\urlext\downloadImage;
use md\data\rules\urlext\downloadJS;
use md\data\rules\urlext\downSwf;
use md\data\SiteAbortReadCache;
use md\data\flow\getCacheFilenName;
use md\data\rules\convert_param_charset;
use md\data\rules\getFromUrl;
use md\data\rules\getTargetUrl;
use md\data\rules\search_script;
use md\data\rules\setCharset;
use md\data\rules\get_caiji_config;
use md\data\rules\plus_run_before_get;
use md\data\rules\getTargetRootUrl;
use md\data\rules\encodeQS;
use md\data\rules\urlext\getExt;
use md\data\rules\defineWebRootAndSign;
use md\inc\delcache;
use md\data\replace\replace_ad;
use md\data\replace\del_target_url;
use md\data\replace\getAllLink;
use md\data\replace\HideJSError;
use md\data\replace\meta_content_frame;
use md\data\replace\no_site_app;
use md\data\replace\replace_pic;
use md\data\replace\plug_before_convert_charset;
use md\data\replace\replace_before_on;
use md\data\replace\call_replace_zdy;
use md\data\replace\replace_flinks;

use md\data\replace\replace_title;
use md\data\replace\replace_web_description;
use md\data\replace\replace_web_keywords;
use md\data\replace\replace_web_seo_name;
use md\data\replace\zdy;
use md\data\rules_get\replace\replace_by_from_title;
use md\data\rules_get\replace\search_url;
require_once(VV_RULES. '/config.php');

new delcache();                                                                                                              //无
new get_caiji_config();                                                                                                //无
new encodeQS();                                                                                                      //无
new setCharset();                                                                                                        //无
new convert_param_charset();                                                                                             //无
                                                                                                    //无
new getFromUrl();
new GetParaseUrl_Schema_Host();
new getTargetRootUrl();
new defineWebRootAndSign();
new getExt();
new getTargetUrl();
new getCacheFilenName();
new search_script();




new plus_run_before_get();
new downloadImage();                                                                                              //不缓存
new downCss();
new downHtml();
new downloadJS();
new downSwf();
new downFont();
new downOther();

new ReadCacheNoTimeout();                                                                                              // 不超时 读                                                                                                                   //缓存
new SiteAbortReadCache();                                                                                                //站异常 读
new headerContextType();

getHtml();                                                                                                        //读 后缓存

new replace_to_utf8();
new plug_before_convert_charset($caiji);
new replace_before_on();
new meta_content_frame();
//new del_target_url();
new getAllLink();
new replace_pic($allimg,'jpg');
new replace_src();
new replace_pic($alljs,'js');
new replace_pic($allcss,'css');
new replace_pic($allhtml,'html');


//require_once (DREPLACE.'href.php');

//require_once (DREPLACE.'gbk.php');
new replace_by_from_title();
new search_url();
new call_replace_zdy();
new zdy();
new replace_ad();
new HideJSError();
new no_site_app();
// new replace_style_by_caiji_config_css();
new replace_web_keywords();
new replace_web_description();
new replace_web_seo_name();
new replace_flinks();
new replace_title($caiji);
new replace_synonym();
new replace_keyword_link();
new replace_tongji();


plus_run('end');
new SaveCache();
new ac_yulan();
new echo_html();

?>