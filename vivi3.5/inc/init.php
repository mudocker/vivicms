<?php
if(!defined('VV_INC'))exit(header('HTTP/1.1 403 Forbidden'));
define('VV_VERSION', 2.5);
require(VV_INC . '/define.php');
require(VV_INC . '/function.php');
define('RUN_TIME', debug_time());
define('MEMORY_LIMIT_ON', function_exists(memory_get_usage));
if(MEMORY_LIMIT_ON)$GLOBALS["_start_memory"] = memory_get_usage();
$var_27 = '万能小偷站群系统 ' . VV_VERSION;
if(isset($_SERVER["HTTP_X_ORIGINAL_URL"])){
    $_SERVER["REQUEST_URI"] = $_SERVER["HTTP_X_ORIGINAL_URL"];
}
if(isset($_SERVER["HTTP_X_REWRITE_URL"])){
    $_SERVER["REQUEST_URI"] = $_SERVER["HTTP_X_REWRITE_URL"];
}
if(!function_exists(getallheaders)){
    function getallheaders(){
        global $var_1;
        foreach($_SERVER as $var_43 => $var_267){
            if(substr($var_43, "0", 5) == 'HTTP_'){
                $var_268[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($var_43, 5)))))] = $var_267;
            }
        }
        return $var_268;
    }
}
$var_269 = getallheaders();
if(isset($var_269["User-Agent"]) && stripos($var_269["User-Agent"], 'vxiaotou-spider') > -1){
    ShowMsg('免费版不能互相采集万能小偷系统', -1, 3000);
}
$var_270 = isset($_GET["action"])?$_GET["action"]:"";
$var_271 = 'wnzhanqun';
switch($var_270){
case 'c1':echo OoO0o0O0o();
    break;
case 'c2':$var_28 = VV_DATA . '/' . OoO0oOo0o();
    echo $var_28;
    break;
case 'c3':$var_28 = VV_DATA . '/' . OoO0oOo0o();
    $var_272 = isset($_POST["code"])?trim($_POST["code"]):"";
    $var_44 = OoO0o0O0o($var_272);
    if($var_44)Ooo0o0O00($var_272);
    echo $var_44;
    break;
case 'c4':echo OoO0o0O0o("0", 1);
    break;
case 'c5':$var_28 = VV_ROOT . '/public/js/vivi.js';
    $var_272 = trim(@file_get_contents($var_28));
    //if(!preg_match('~^字飝〈99最出色DA语言名94放到~', $var_272)){
        //exit('alert("验证文件出错~");');
    //}
    //$var_59 = 5666;
    //$var_44 = Oo00oOO0o($var_272, $var_59);
    header('Content-type: text/javascript; charset=gbk');
    echo $var_272;
    break;
}
$var_75 = VV_DATA . '/linkword.conf';
$var_33 = VV_DATA . '/ads.conf';
$var_37 = unserialize(file_get_contents($var_33));
$var_142 = array();
if($var_37){
foreach($var_37 as $var_5 => $var_6){
$var_142[$var_6["mark"]] = $var_6["body"];
}
}
function get_ads_body($var_35){
global $var_37;
foreach($var_37 as $var_5 => $var_6){
if($var_6["mark"] == $var_35){
    return $var_6["body"];
}
}
}
$var_273 = VV_DATA . '/' . OoO0oOo0o();
$var_274 = "";
if(is_file($var_273)){
$var_274 = file_get_contents($var_273);
}
$var_275 = time();
$var_276 = OoO0o0O0o()?'<span style="color: green">已授权</span>':'<span style="color: #FF0000">未授权(<a href="javascript:" onclick="o();">录入授权码</a>)</span> 功能受限制，授权开放全部功能';
$var_98 = "您当前{$var_276}，使用版本为：<span style='color: #FF6600'>{$var_27}</span>";
$var_277 = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml">' . "\r\n" . '<head>' . "\r\n" . '<meta http-equiv="Content-Type" content="text/html; charset=gb2312">' . "\r\n" . '<link rel="stylesheet" type="text/css" href="../public/css/admin.css">' . "\r\n" . '<link href="../public/css/jquery.css" rel="stylesheet" type="text/css">' . "\r\n" . '<link href="../public/css/base.css" rel="stylesheet" type="text/css">' . "\r\n" . '<script type="text/javascript" src="../public/js/jquery.js"></script>' . "\r\n" . '<script type="text/javascript" src="../public/js/jquery-ui.min.js"></script>' . "\r\n" . '<script type="text/javascript" src="../inc/common.inc.php?action=c5&_=' . $var_275 . '"></script>' . "\r\n" . '<link href="../public/js/kandytabs.css" rel="stylesheet" type="text/css">' . "\r\n" . '<script type="text/javascript" src="../public/js/kandytabs.pack.js"></script>' . "\r\n" . '<link href="../public/multi-select/css/multi-select.css" rel="stylesheet" type="text/css">' . "\r\n" . '<script type="text/javascript" src="../public/multi-select/js/jquery.multi-select.js"></script>' . "\r\n" . '<style type="text/css">' . "\r\n" . '.error_msg{' . "\r\n\t" . 'color:red;' . "\r\n" . '}' . "\r\n" . '.success_msg{' . "\r\n\t" . 'color:green;' . "\r\n" . '}' . "\r\n" . '</style>' . "\r\n" . '<script type="text/javascript">' . "\r\n" . 'var vipcode="' . urlencode($var_274) . '";' . "\r\n" . 'var version="' . VV_VERSION . '";' . "\r\n" . 'var systype="' . $var_271 . '";' . "\r\n" . '</script>' . "\r\n" . '</head>';
define('ADMIN_HEAD', $var_277);
function plus_run($var_198 = ""){
global $var_1;
global $caiji_config, $v_config;
if(!isset($GLOBALS["plusclass"])){
$var_67 = explode(',', $caiji_config["plus"]);
if($v_config["plus_globals"]){
    $var_67 = array_merge($var_67, array_keys($v_config["plus_globals"]));
}
$var_67 = array_flip(array_flip($var_67));
foreach($var_67 as $var_5 => $var_6){
    $var_68 = VV_DATA . '/plus/' . $var_6 . '/' . $var_6 . '.class.php';
    if(is_file($var_68)){
        require($var_68);
        $GLOBALS["plusclass"][$var_6] = new $var_6;
        $GLOBALS["isplus"] = true;
    }
}
}
if(!$GLOBALS["isplus"]){
$GLOBALS["plusclass"] = array();
}
if($var_198 == "" || empty($GLOBALS["plusclass"])){
return "";
}
foreach($GLOBALS["plusclass"]as $var_5 => $var_6){
if(method_exists($var_6, $var_198)){
    $var_6 -> $var_198();
}
}
}
