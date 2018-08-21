<?php
if (true){
    !defined('VV_INC') and exit(header("HTTP/1.1 403 Forbidden"));
    define('DRGET',VV_DATA.'/rules_get/');
    define('DREPLACE',VV_DATA.'/rules_get/replace/');
    require_once (DRGET.'func.php');
    require_once (DRGET.'v_config/sifton.php');
    require_once (DREPLACE.'geturl.php');
}                                                                                                          //beforeGetHtml
require_once (DRGET.'getHtmlCode.php');                                                                             //gethtml
require_once (DRGET.'replace.php');                                                                                                //replace
?>