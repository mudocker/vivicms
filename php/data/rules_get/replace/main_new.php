<?php

use md\data\replace\config_ads2;
use md\data\replace\replace_css;
use md\data\replace\del_target_url;
use md\data\replace\getAllLink;

use md\data\replace\HideJSError;
use md\data\replace\replace_js;
use md\data\replace\keyword_inline;
use md\data\replace\meta_content_frame;
use md\data\replace\no_css_js;
use md\data\replace\no_site_app;
use md\data\replace\replace_pic;
use md\data\replace\plug_before_convert_charset;
use md\data\replace\replace_before_on;
use md\data\replace\call_replace_zdy;
use md\data\replace\replace_flinks;
use md\data\replace\replace_style_by_caiji_config_css;
use md\data\replace\replace_title;
use md\data\replace\replace_web_description;
use md\data\replace\replace_web_keywords;
use md\data\replace\replace_web_seo_name;
use md\data\replace\zdy;
use md\data\rules_get\replace\replace_by_from_title;
use md\data\rules_get\replace\search_url;
if ( $GLOBALS['urlext']=='js'||$GLOBALS['urlext']=='css'|| $GLOBALS['urlext']=='jpg'||$GLOBALS['urlext']=='ttf') return;
if (!$isgetnew)return;
if (!$GLOBALS['html'])return;

        new plug_before_convert_charset($caiji);
        new replace_before_on();
        new meta_content_frame();
        new del_target_url();
        new getAllLink();
        new replace_pic();
        new replace_js();
        new replace_css();

        require_once (DREPLACE.'href.php');
     //   require_once (DREPLACE.'gbk.php');
        new replace_by_from_title();
        new search_url();
        new call_replace_zdy();
        new zdy();
        new config_ads2();
        new HideJSError();
        new no_site_app();
        new replace_style_by_caiji_config_css();
        new replace_web_keywords();
        new replace_web_description();
        new replace_web_seo_name();
        new replace_flinks();

        new replace_title($caiji);
        new keyword_inline();

