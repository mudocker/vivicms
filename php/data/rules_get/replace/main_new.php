<?php

use md\data\replace\config_ads2;
use md\data\replace\css;
use md\data\replace\del_target_url;
use md\data\replace\getAllLink;

use md\data\replace\JS;
use md\data\replace\meta_content_frame;
use md\data\replace\no_css_js;
use md\data\replace\pic;
use md\data\replace\plug_before_convert_charset;
use md\data\replace\replace_before_on;
use md\data\replace\call_replace_zdy;
use md\data\replace\replace_title;
use md\data\replace\zdy;
use md\data\rules_get\replace\replace_by_from_title;
use md\data\rules_get\replace\search_url;

if ($GLOBALS['urlext']!='js'&&$GLOBALS['urlext']!='css'&&$GLOBALS['urlext']!='jpg'&&$GLOBALS['urlext']!='ttf'){
    if($isgetnew && $GLOBALS['html']){
        new plug_before_convert_charset($caiji);
        new replace_before_on();
        new meta_content_frame();
        new del_target_url();
        new getAllLink();
        new pic();
        new JS();
        new css();

        require_once (DREPLACE.'href.php');
     //   require_once (DREPLACE.'gbk.php');
        new replace_by_from_title();
        new search_url();
        new call_replace_zdy();
        new zdy();
        new config_ads2();
        new no_css_js();
        new replace_title($caiji);
        require_once (DREPLACE.'no_css_js.php');
        require_once (DRGET.'linkword_on.php');
    }
}
