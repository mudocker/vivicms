<?php
function replace_tags($v_110){
    global $var_1;
    global $var_169, $v_config;
    $v_110 = str_replace(array('{web_thisurl}', '{web_domain}'), array($var_169, $_SERVER["HTTP_HOST"]), $v_110);
    foreach($v_config as $var_5 => $var_6){
        $v_110 = str_replace('{' . $var_5 . '}', $var_6, $v_110);
    }
    return $v_110;
}
function to_utf8($v_110){
    global $var_1;
    if(!is_utf8($v_110)){
        if (PATH_SEPARATOR == ':'){
            $v_110 = mb_convert_encoding($v_110, 'utf-8', 'gbk');
        }else{
            $v_110 = iconv('gbk', 'utf-8//IGNORE', $v_110);
        }
    }
    return $v_110;
}
function is_utf8($v_329){
    global $var_1;
    if (trim($v_329) == "") return false;
    if (@preg_match('/^([' . chr(228) . '-' . chr(233) . ']{1}[' . chr(128) . '-' . chr(191) . ']{1}[' . chr(128) . '-' . chr(191) . ']{1}){1}/', $v_329) == true || @preg_match('/([' . chr(228) . '-' . chr(233) . ']{1}[' . chr(128) . '-' . chr(191) . ']{1}[' . chr(128) . '-' . chr(191) . ']{1}){1}$/', $v_329) == true || @preg_match('/([' . chr(228) . '-' . chr(233) . ']{1}[' . chr(128) . '-' . chr(191) . ']{1}[' . chr(128) . '-' . chr(191) . ']{1}){2,}/', $v_329) == true){
        if (is_utf8_old($v_329)) return true;
    }
    return false;
}
?>