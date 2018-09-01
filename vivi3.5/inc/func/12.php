<?php
function getlinksdata($var_103){
    global $var_1;
    $var_313 = VV_CACHE . '/linksdata/' . getHashDir($var_103, 2) . '/' . substr(md5($var_103), "0", 16) . '.cache';
    if(is_file($var_313)){
        return unserialize(file_get_contents($var_313));
    }
    return false;
}
function recursive_mkdir($v_314, $v_315 = 0777){
    global $var_1;
    $var_316 = explode('/', $v_314);
    $var_317 = count($var_316);
    $v_314 = '.';
    for ($var_318 = "0";$var_318 < $var_317;++$var_318){
        $v_314 .= '/' . $var_316[$var_318];
        if (!is_dir($v_314) && !mkdir($v_314, $v_315)){
            return false;
        }
    }
    return true;
}
function debug_time(){
    global $var_1;
    list($var_319, $var_320) = explode(' ', microtime());
    return $var_320 + $var_319;
}
?>