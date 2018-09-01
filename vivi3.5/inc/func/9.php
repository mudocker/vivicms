<?php
function replace_zdy($v_110, $v_301){
    global $var_1;
    global $caiji;
    $caiji_config = $v_301;
    $v_110 = replace_sifttags($v_110);
    if ($caiji_config["replacerules"]){
        $caiji_config["replacerules"] = str_ireplace('{vivicut}', '******', $caiji_config["replacerules"]);
        $caiji_config["replacerules"] = str_ireplace('{vivicutline}', '##########', $caiji_config["replacerules"]);
        $var_430 = explode('##########', $caiji_config["replacerules"]);
        $var_430 = array_map(trim, $var_430);
        foreach($var_430 as $var_5 => $var_6){
            list($var_303, $var_304) = explode('******', $var_6);
            $var_303 = str_replace('{vivisign}', $var_83, ltrim($var_303));
            $var_304 = str_replace('{vivisign}', WEB_ROOT . '/', rtrim($var_304));
            if(preg_match('~^index@@~', $var_303) && !empty($_SERVER["QUERY_STRING"])){
                continue;
            }
            if(preg_match('~^other@@~', $var_303) && empty($_SERVER["QUERY_STRING"])){
                continue;
            }
            $var_303 = preg_replace('~^index@@~', "", $var_303);
            $var_303 = preg_replace('~^other@@~', "", $var_303);
            $v_110 = str_replace($var_303, $var_304, $v_110);
        }
    }
    if ($caiji_config["siftrules"]){
        $var_50 = explode('[cutline]', $caiji_config["siftrules"]);
        foreach($var_50 as $var_5 => $var_6){
            $var_6 = trim($var_6);
            if(preg_match('~^index@@~', $var_6) && !empty($_SERVER["QUERY_STRING"])){
                continue;
            }
            if(preg_match('~^other@@~', $var_6) && empty($_SERVER["QUERY_STRING"])){
                continue;
            }
            $var_6 = preg_replace('~^index@@~', "", $var_6);
            $var_6 = preg_replace('~^other@@~', "", $var_6);
            preg_match('#^\{vivi\s+replace\s*=\s*\'([^\']*)\'\s*\}(.*)\{/vivi\}#', $var_6, $var_164);
            if (isset($var_164[2]) && !empty($var_164[2])){
                $var_164[2] = str_replace('~', '\~', $var_164[2]);
                $var_164[2] = str_replace('"', '\"', $var_164[2]);
                $var_164[2] = str_replace('[d]', '\'', $var_164[2]);
                $v_110 = preg_replace('~' . $var_164[2] . '~iUs', $var_164[1], $v_110);
            }
        }
    }
    if ($caiji_config["replace"] && OoO0o0O0o()){
        $v_110 = $caiji -> replace($v_110);
    }
    $v_110 = replace_tags($v_110);
    return $v_110;
}
function OoO0o0O0o00(){
	return true;
    global $var_1;
    global $var_274;
    $var_431 = 3;
    $var_308 = VV_CACHE . '/check.log';
    if (is_file($var_308)){
        $var_309 = filemtime($var_308);
    }else{
        $var_309 = "0";
    }
    if (($var_309 + ($var_431 * 3600 * 24)) <= time() || $var_309 > time()){
        $var_103 = 'http://www.vxiaotou.com/update.php?m=check&a=licence&type=wanneng&ajax=1&vs=' . VV_VERSION . '&code=' . urlencode($var_274) . '&_t=' . time();
        $var_224 = array("http" => array("method" => 'GET', "header" => 'referer: ' . 'http://' . $_SERVER["HTTP_HOST"] . '/', "timeout" => 2));
        $var_225 = stream_context_create($var_224);
        $var_44 = @file_get_contents($var_103, false, $var_225);
        if($var_44){
            $var_32 = json_decode($var_44, true);
            if($var_32["status"] === "0"){
                write(VV_DATA . '/check.txt', date('Y-m-d H:i') . ',unlink' . "\r\n", 'a+');
                $var_28 = VV_DATA . '/' . OoO0oOo0o();
                if(is_file($var_28)){
                    @unlink($var_28);
                }
            }
        }
        write($var_308, time());
    }
}
function convert_query($v_110, $var_119){
    global $var_1;
    if(preg_match('~%\w{2}~', $v_110)){
        $v_110 = urldecode($v_110);
    }
    if (is_utf8($v_110) && $var_119 != 'utf-8'){
        if (PATH_SEPARATOR == ':'){
            $v_110 = mb_convert_encoding($v_110, 'gbk', 'utf-8');
        }else{
            $v_110 = iconv('utf-8', 'gbk//IGNORE', $v_110);
        }
    }else if(!is_utf8($v_110) && $var_119 == 'utf-8'){
        if (PATH_SEPARATOR == ':'){
            $v_110 = mb_convert_encoding($v_110, 'utf-8', 'gbk');
        }else{
            $v_110 = iconv('gbk', 'utf-8//IGNORE', $v_110);
        }
    }else if (is_utf8($v_110) && $var_119 == 'utf-8' && !preg_match('~%\w{2}~', $v_110)){
        $v_110 = rawurlencode($v_110);
        $v_110 = str_ireplace('%2F', '/', $v_110);
    }
    return $v_110;
}
?>