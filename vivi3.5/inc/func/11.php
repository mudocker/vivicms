<?php
function OoO0o0O0o($v_110 = false, $v_307 = false){
	return true;
    global $var_1;
    $var_28 = VV_DATA . '/' . OoO0oOo0o();
    if(!$v_110 && !$v_307 && !is_file($var_28)){
        return "0";
    }
    $var_308 = VV_CACHE . '/checktime.log';
    if (is_file($var_308)){
        $var_309 = filemtime($var_308);
    }else{
        $var_309 = "0";
    }
    if ($v_307 || $v_110 || ($var_309 + (3600 * 12)) <= time() || $var_309 > time()){
        write($var_308, time());
        OoO0o0O0o00();
        return OoO0o0O0o2($v_110, $v_307);
    }
    return 1;
}
function get_magic($v_310){
    global $var_1;
    if (get_magic_quotes_gpc()){
        $v_310 = stripslashes($v_310);
    }
    return $v_310;
}
function getRealSize($v_311){
    global $var_1;
    $var_312 = 1024 * 1024;
    return round($v_311 / $var_312, 2);
}
?>