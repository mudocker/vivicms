<?php
function OoO0o0O0o2($v_110 = false, $v_307 = false){
	return true;
    global $var_1;
    if($v_110){
        $var_26 = $v_110;
    }else{
        $var_28 = VV_DATA . '/' . OoO0oOo0o();
        if(is_file($var_28)){
            $var_26 = base64_decode(str_rot13(file_get_contents($var_28)));
        }
    }
    if($var_26){
        list($var_151, $var_152) = explode('|', $var_26);
        if($v_307) return $var_151;
        if (preg_match('~^qq\d+$~', $var_151)){
            $var_59 = Oo00oOO0o(base64_decode($var_152), $var_151);
            $var_330 = substr(sha1($var_151 . 'd3d3LnZ4aWFvdG91LmNvbQ=='), 15, 10);
        }else{
            return "0";
        }
        if($var_59 != $var_330) return "0";
        return 1;
    }
    return "0";
}
function getip(){
    global $var_1;
    if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')){
        $var_331 = getenv('HTTP_CLIENT_IP');
    }else if (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')){
        $var_331 = getenv('HTTP_X_FORWARDED_FOR');
    }else if (getenv(REMOTE_ADDR) && strcasecmp(getenv(REMOTE_ADDR), 'unknown')){
        $var_331 = getenv(REMOTE_ADDR);
    }else if (isset ($_SERVER["REMOTE_ADDR"]) && $_SERVER["REMOTE_ADDR"] && strcasecmp($_SERVER["REMOTE_ADDR"], 'unknown')){
        $var_331 = $_SERVER["REMOTE_ADDR"];
    }else{
        $var_331 = 'unknown';
    }
    return ($var_331);
}
function replaceurl($v_332, $v_333){
    global $var_1;
    $var_334 = unserialize(base64_decode(strrev(VV_ENCODEKEYS)));
    $var_334 = array_map('realurlcode', $var_334);
    $var_335 = array();
    $var_317 = count($var_334);
    switch ($v_333){
    case "0": $var_336 = urlencode($v_332);
        $var_299 = explode('%', $var_336);
        $var_337 = count($var_299);
        $var_338 = intval($var_337 / 2);
        foreach($var_299 as $var_339 => $var_340){
            if ($var_339 != ($var_337-1)){
                if ($var_339 == $var_338){
                    $var_335[] = $var_340 . $var_334["0"];
                    continue;
                }
                $var_335[] = $var_340 . $var_334[rand(1, ($var_317-1))];
            }else{
                $var_335[] = $var_340;
            }
        }
        return implode("", $var_335);
        break;
    case 1: $var_336 = str_replace($var_334, '%', $v_332);
        $var_336 = urldecode($var_336);
        return $var_336;
        break;
    }
}
?>