<?php
function getjscachefile($cacheid, $var_241 = ""){
    global $var_1;
    $var_241 = $var_241?$var_241 . '/':"";
    return VV_CACHE . '/js/' . $var_241 . getHashDir($cacheid, 2) . '/' . substr(md5($cacheid), "0", 16) . '.js';
}
function display_404(){
    global $var_1;
    global $v_config, $caiji_config;
    if(!$v_config["web_404_url"]){
        return false;
    }
    $var_134 = VV_ROOT . '/' . trim($v_config["web_404_url"], '/');
    if(!$v_config["web_404_type"] || $v_config["web_404_type"] == 'jump'){
        header('HTTP/1.1 404 Not Found');
        header('Location: ' . $v_config["web_404_url"]);
    }else if($v_config["web_404_type"] == 'display' && is_file($var_134)){
        display($var_134, $v_config);
    }
    exit;
}
function encode_id($var_25){
    global $var_1;
    global $v_config;
    switch($v_config["web_urlencode_type"]){
    case 'base64': $var_25 = base64code($var_25);
        break;
    case strrev: $var_25 = strrev($var_25);
        break;
    case str_rot13: $var_25 = str_rot13($var_25);
        break;
    case 'jiandan': $var_25 = str_replace(array('/', '-', '|', '@'), array('|', '@', '-', '/'), $var_25);
        break;
    }
    return $var_25;
}
?>