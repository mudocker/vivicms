<?php
require(dirname(__FILE__) . '/inc/common.inc.php');
require(dirname(__FILE__) . '/inc/caiji.class.php');
$v_config = require(VV_DATA . '/config.php');
require(dirname(__FILE__) . '/inc/robot.php');
if(isset($_GET["code"]) && $_GET["code"]){
    $GLOBALS["geturl"] = base64_decode(strrev(rawurldecode($_GET["code"])));
    $var_2 = isset($_GET["tid"])?$_GET["tid"]:"";
}else if($_SERVER["QUERY_STRING"]){
    list($var_3,) = explode('?', $_SERVER["QUERY_STRING"]);
    list($var_3,) = explode('&', $_SERVER["QUERY_STRING"]);
    list($var_2, $GLOBALS["geturl"]) = explode('|', decode_source($var_3));
}else{
    exit('err');
}
$var_2 = (int)$var_2;
if(!$var_2){
    exit('err2');
}
$caiji_config = require(VV_DATA . "/config/{$var_2}.php");
if(!is_resdomain($GLOBALS["geturl"])){
    exit('err3');
}
$var_7 = parse_url($GLOBALS["geturl"]);
$var_8 = substr(basename($var_7["path"]), -4, 4);
$var_9 = str_replace('.', "", $var_8);
if($caiji_config["web_debug"] == 'on' && @$_GET["debug"] == true){
    $GLOBALS["geturl"] = str_replace('?debug=true', "", $GLOBALS["geturl"]);
}else{
    if(in_array($var_9, array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'ttf', 'ico'))){
        header("Content-Type: image/{$var_9}; charset=UTF-8");
    }else{
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($var_7["path"]) . ';');
    }
}
if ($v_config["sifton"] && OoO0o0O0o()){
    $var_4 = explode('[cutline]', $v_config["sifturl"]);
    foreach($var_4 as $var_5 => $var_6){
        if ($var_6 == $GLOBALS["geturl"]){
            header('Content-type: image/png');
            exit();
        }
    }
}
$cacheid = md5($GLOBALS["geturl"]);
$cachefile = getimgcachefile($cacheid, $var_9);
$var_10 = $v_config["imgcachetime"];
define('VV_PLUS', true);
$GLOBALS["isplus"] = false;
plus_run('init');
plus_run('before_get_img');
$var_11 = true;
if($caiji_config["collect_close"]){
    if(is_file($cachefile)){
        $var_11 = false;
    }else{
        exit('not file');
    }
}
if (($v_config["imgcache"] || $caiji_config["collect_close"]) && OoO0o0O0o()){
    if($var_11 && !is_file($cachefile) || (@filemtime($cachefile) + ($var_10 * 3600)) <= time()){
        run_time(true);
        $var_12 = $caiji -> geturl($GLOBALS["geturl"]);
        $GLOBALS["debug"][] = '使用缓存：否';
        $GLOBALS["debug"][] = '采集用时：' . run_time() . 's';
        plus_run('before_cache_img');
        if($var_10 && !empty($var_12)){
            write($cachefile, $var_12);
        }
    }else{
        $var_12 = file_get_contents($cachefile);
        $GLOBALS["debug"][] = '使用缓存：是';
        $GLOBALS["debug"][] = '缓存路径：' . $cachefile;
    }
    echo $var_12;
    if($caiji_config["web_debug"] == 'on'){
        echo "\r\n" . '/*---调试信息 start---' . "\r\n" . implode("\r\n", $GLOBALS["debug"]) . "\r\n" . '---调试信息 end---*/' . "\r\n";
    }
}else{
    header("Location: {$GLOBALS["geturl"]}");
    exit;
}
