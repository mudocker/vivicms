<?php

use md\data\replace\meta_content_frame;
use md\data\replace\plug_before_convert_charset;
use md\data\replace\replace_before_on;
use md\data\rules_get\replace\replace_by_from_title;

if ($GLOBALS['urlext']!='js'&&$GLOBALS['urlext']!='css'&&$GLOBALS['urlext']!='jpg'&&$GLOBALS['urlext']!='ttf'){
    if($isgetnew && $GLOBALS['html']){
        new plug_before_convert_charset($caiji);
        new replace_before_on();
        new meta_content_frame();
        require_once (DREPLACE.'other_url.php');
        require_once (DREPLACE.'match_res.php');
        require_once (DREPLACE.'pic.php');
        require_once (DREPLACE.'js.php');
        require_once (DREPLACE.'css.php');
        require_once (DREPLACE.'href.php');
        require_once (DREPLACE.'gbk.php');
        new replace_by_from_title();
        require_once (DREPLACE.'search_url.php');
        require_once (DREPLACE.'replace_zdy.php');
        require_once (DREPLACE.'zdy.php');
        require_once (DREPLACE.'config_ads2.php');
        require_once (DREPLACE.'no_css_js.php');
        require_once (DRGET.'linkword_on.php');
    }
}
