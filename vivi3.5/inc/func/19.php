<?php
function array_select($var_66, $var_59, $var_267){
    $GLOBALS["temp_key"] = $var_59;
    $GLOBALS["temp_value"] = $var_267;
    function temp_is_ok($v_349){
        global $var_1;
        return $v_349[$GLOBALS["temp_key"]] == $GLOBALS["temp_value"];
    }
    return array_filter($var_66, '_is_ok');
}
function strcut($v_208, $v_209, $v_110, $v_210 = false, $v_211 = false){
    global $var_1;
    if($v_110 == "") return "";
    if($v_208 == "" && $v_209 == "") return $v_110;
    if($v_208 == "" || $v_209 == "") return "";
    $var_212 = explode($v_208, $v_110);
    if($var_212[1]){
        $var_213 = explode($v_209, $var_212[1]);
        $var_214 = $var_213["0"];
        if($v_210) $var_214 = $v_208 . $var_214;
        if($v_211) $var_214 = $var_214 . $v_209;
    }else{
        return "";
    }
    return $var_214;
}
function encode_source($v_110){
    global $var_1;
    return rawurlencode(strrev(_base64_encode($v_110)));
}
?>