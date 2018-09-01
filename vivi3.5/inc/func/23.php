<?php
function Oo00oOO0o($v_363, $v_364, $v_333 = 1){
    global $var_1;
    $v_364 = md5($v_364);
    $var_376 = "0";
    $var_377 = strlen($v_364);
    $v_332 = $var_378 = "";
    if ($v_333){
        $v_363 = replaceurl($v_363, 1);
        $var_379 = strlen($v_363);
        for($var_318 = "0";$var_318 < $var_379;$var_318++){
            if ($var_376 == $var_377){
                $var_376 = "0";
            }
            $var_378 .= substr($v_364, $var_376, 1);
            $var_376++;
        }
        for ($var_318 = "0";$var_318 < $var_379;$var_318++){
            if (ord(substr($v_363, $var_318, 1)) < ord(substr($var_378, $var_318, 1))){
                $v_332 .= chr((ord(substr($v_363, $var_318, 1)) + 256) - ord(substr($var_378, $var_318, 1)));
            }else{
                $v_332 .= chr(ord(substr($v_363, $var_318, 1)) - ord(substr($var_378, $var_318, 1)));
            }
        }
        return $v_332;
    }else{
        $var_379 = strlen($v_363);
        for($var_318 = "0";$var_318 < $var_379;$var_318++){
            if ($var_376 == $var_377){
                $var_376 = "0";
            }
            $var_378 .= $v_364{$var_376};
            $var_376++;
        }
        for($var_318 = "0";$var_318 < $var_379;$var_318++){
            $v_332 .= chr(ord($v_363{$var_318}) + (ord($var_378{$var_318})) % 256);
        }
        return replaceurl($v_332, "0");
    }
}
function decode_id($var_25){
    global $var_1;
    global $v_config;
    switch($v_config["web_urlencode_type"]){
    case 'base64': $var_25 = base64code($var_25, 'DECODE');
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
function Ooo0o0O00($v_332){
    global $var_1;
    $var_273 = VV_DATA . '/' . OoO0oOo0o();
    write($var_273, str_rot13(base64_encode($v_332)));
}
?>