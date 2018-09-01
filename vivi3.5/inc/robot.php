<?php
if (!defined('VV_INC')) exit(header('HTTP/1.1 403 Forbidden'));
if($v_config["robotlogon"] !== "0"){
    $var_278 = $_SERVER ["SERVER_NAME"];
    $var_279 = $_SERVER ["SERVER_PORT"];
    $var_280 = $_SERVER ["REMOTE_ADDR"];
    $var_281 = 'http://' . $_SERVER ["HTTP_HOST"] . get_thisurl();
    $var_282 = 'http://' . $var_278;
    If ($var_279 != 80){
        $var_282 = $var_282 . ':' . $var_279;
    }else{
        $var_282 = $_SERVER ["HTTP_REFERER"];
    }
    $var_283 = $var_282;
    $var_284 = $_SERVER ["HTTP_USER_AGENT"];
    $var_285 = strtolower($var_284);
    $var_286 = "";
    if(strpos($var_285, 'http://') > -1 && preg_match('#bot|spider|crawl|nutch|lycos|robozilla|slurp|search|seek|archive#i', $var_285)){
        $var_286 = '其它蜘蛛';
    }
    if (stripos($var_285, 'googlebot') > - 1){
        $var_286 = 'Google';
    }
    if (stripos($var_285, 'mediapartners-google') > - 1){
        $var_286 = 'Google Adsense';
    }
    if (stripos($var_285, 'facebook') > - 1 || stripos($var_285, 'Facebot') > - 1){
        $var_286 = 'facebook';
    }
    if (stripos($var_285, 'baiduspider') > - 1){
        $var_286 = 'Baidu';
    }
    if (stripos($var_285, '360spider') > - 1){
        $var_286 = '360搜索';
    }
    if (stripos($var_285, 'soso') > - 1){
        $var_286 = 'soso';
    }
    if (stripos($var_285, 'sogou') > - 1){
        $var_286 = 'Sogou';
    }
    if (stripos($var_285, 'yahoo') > - 1){
        $var_286 = 'Yahoo!';
    }
    if (stripos($var_285, 'msn') > - 1){
        $var_286 = 'MSN';
    }
    if (stripos($var_285, 'ia_archiver') > - 1){
        $var_286 = 'Alexa';
    }
    if (stripos($var_285, 'iaarchiver') > - 1){
        $var_286 = 'Alexa';
    }
    if (stripos($var_285, 'sohu') > - 1){
        $var_286 = 'Sohu';
    }
    if (stripos($var_285, 'sqworm') > - 1){
        $var_286 = 'AOL';
    }
    if (stripos($var_285, 'yodaoBot') > - 1){
        $var_286 = 'Yodao';
    }
    if (stripos($var_285, 'iaskspider') > - 1){
        $var_286 = '新浪爱问';
    }
    if (stripos($var_285, 'Yisouspider') > - 1){
        $var_286 = '神马搜索';
    }
    if($v_config["ban_zhizhu_on"] && $v_config["ban_zhizhu_list"]){
        $v_config["ban_zhizhu_list"] = explode(',', $v_config["ban_zhizhu_list"]);
        foreach($v_config["ban_zhizhu_list"] as $var_5 => $var_6){
            if(stripos($var_285, $var_6) > -1 || ($var_6 == 'other' && $var_286 == '其它蜘蛛')){
                exit(header('HTTP/1.1 403 Forbidden'));
            }
        }
    }
    $var_287 = date('Y-m-d H:i:s');
    define('IP_FILE', VV_DATA . '/zhizhu.txt');
    $var_29 = getip() . '---' . $var_286 . '---' . $var_281 . '---' . $var_287;
    if(SCRIPT == 'item' && !empty($var_286)) exit(header('HTTP/1.1 403 Forbidden'));
    if (!empty($var_286) && !is_file(IP_FILE)){
        write(IP_FILE, $var_29);
    }else if (!empty($var_286) && is_file(IP_FILE)){
        $var_66 = file(IP_FILE);
        $var_102 = count($var_66);
        $var_66 = array_slice($var_66, "0", 30000);
        $var_288 = $var_29 . "\r\n" . implode("", $var_66);
        write(IP_FILE, $var_288);
    }
}
function get_thisurl(){
    global $var_1;
    if (!empty($_SERVER["REQUEST_URI"])){
        $var_289 = $_SERVER["REQUEST_URI"];
        $var_290 = $var_289;
    }else{
        $var_289 = $_SERVER["PHP_SELF"];
        if (empty($_SERVER["QUERY_STRING"])){
            $var_290 = $var_289;
        }else{
            $var_290 = $var_289 . '?' . $_SERVER["QUERY_STRING"];
        }
    }
    return $var_290;
}
?>