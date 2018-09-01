<?php
define('SCRIPT', 'js');
require(dirname(__FILE__) . '/inc/common.inc.php');
require(dirname(__FILE__) . '/inc/caiji.class.php');
$v_config = require(VV_DATA . '/config.php');
require(dirname(__FILE__) . '/inc/robot.php');
if($_SERVER["QUERY_STRING"]){
    list($var_3,) = explode('?', $_SERVER["QUERY_STRING"]);
    list($var_3,) = explode('&', $var_3);
    list($var_2, $GLOBALS["geturl"]) = explode('|', decode_source($var_3));
}else{
    exit('err');
}
$var_2 = (int)$var_2;
if(!$var_2){
    exit('err');
}
$caiji_config = require(VV_DATA . "/config/{$var_2}.php");
if(!preg_match('~^https?://~i', $GLOBALS["geturl"])){
    exit('err');
}
if ($v_config["sifton"] && OoO0o0O0o()){
    $var_4 = explode('[cutline]', $v_config["sifturl"]);
    foreach($var_4 as $var_5 => $var_6){
        if ($var_6 == $GLOBALS["geturl"]){
            exit();
        }
    }
}
require(VV_DATA . '/rules.php');
?>