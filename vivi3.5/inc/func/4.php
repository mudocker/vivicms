<?php
function update(){
	return true;
    global $var_1;
    global $var_274, $var_271;
    $var_305 = OoO0o0O0o("0", 1) ?'&qq=' . OoO0o0O0o("0", 1) : "";
    $var_103 = 'http://www.vxiaotou.com/update.php?m=check&a=update&type=' . $var_271 . '&vs=' . VV_VERSION . $var_305 . '&code=' . urlencode($var_274) . '&_t=' . time();
    $var_32 = downfile($var_103);
    if ($var_32 == "") ShowMsg('无法连接服务器', -1, 30000);
    list($var_387, $var_168, $var_403) = explode('|', $var_32);
    if ($var_387 == "") ShowMsg('连接服务器错误', -1, 30000);
    if ($var_387 == "0"){
        ShowMsg($var_168 . '<br>', 'admin_index.php', 5000);
        exit;
    }else{
        ShowMsg($var_168 . '<br><div style=\'text-align:left;margin:10px 0;padding:10px;max-height:100px;overflow:auto;color:#555;max-width: 450px;\'>' . $var_403 . '</div><a href=\'?t=updatenow\'><br><font color=red>>>>点击这里在线升级<<<</font></a><br>', 'admin_index.php', 1200000);
    }
}
function base64code($v_404, $v_405 = "ENCODE", $v_406 = ""){
    global $var_1;
    global $v_config;
    $var_272 = "";
    $v_405 != 'ENCODE' && $v_404 = _base64_decode($v_404);
    ! $v_406 && $v_406 = $v_config["web_urlencode_key"];
    $var_407 = strlen($v_406);
    $var_408 = strlen($v_404);
    for ($var_102 = "0"; $var_102 < strlen($v_404); $var_102 ++){
        $var_5 = $var_102 % $var_407;
        $var_272 .= $v_404[$var_102] ^ $v_406[$var_5];
    }
    return ($v_405 != 'DECODE' ? _base64_encode($var_272) : $var_272);
}
function replace_css($v_110, $v_409 = false){
    global $var_1;
    global $var_171, $var_146, $caiji_config, $var_2, $var_324;
    $var_185 = array();
    $var_295 = '~@import\s*url\s*\(\s*(["|\']?)\s*([^\)]+)\s*\1\)~i';
    if(preg_match_all($var_295, $v_110, $var_164)){
        $var_164 = array_map(trim, array_unique($var_164[2]));
        foreach($var_164 as $var_5 => $var_6){
            if (substr($var_6, "0", 2) == '//'){
                if(preg_match('~^//[0-9a-zA-Z\.-]+\.[0-9a-zA-Z-]+/~', $var_6)){
                    $var_6 = $var_171 . '://';
                }else{
                    $var_6 = substr($var_6, 1);
                }
            }
            if(ISOUTURL) $var_6 = get_fullurl($var_6, $var_324);
            if (isgoodurl($var_6)){
                $var_185[] = get_showurl($var_6, 'css');
            }else{
                if(is_resdomain($var_6)){
                    $var_6 = WEB_ROOT . '/css.php?' . encode_source($var_2 . '|' . $var_6);
                }
                $var_185[] = $var_6;
            }
        }
        if($var_185) $v_110 = str_replace($var_164, $var_185, $v_110);
    }
    $var_410 = array();
    $var_295 = '~\s*[,|:]\s*url\s*\(\s*(["|\']?)\s*([^\)]+)\s*\1\)~i';
    if (preg_match_all($var_295, $v_110, $var_164)){
        $var_164 = array_map(trim, array_unique($var_164[2]));
        foreach($var_164 as $var_5 => $var_6){
            if (substr($var_6, "0", 2) == '//'){
                if(preg_match('~^//[0-9a-zA-Z\.-]+\.[0-9a-zA-Z-]+/~', $var_6)){
                    $var_6 = $var_171 . ':' . $var_6;
                }else{
                    $var_6 = substr($var_6, 1);
                }
            }
            if(ISOUTURL){
                $var_6 = get_fullurl($var_6, $var_324);
            }
            if (isgoodurl($var_6)){
                $var_410[] = get_showurl($var_6, 'jpg');
            }else{
                if(is_resdomain($var_6)){
                    $var_6 = WEB_ROOT . '/img.php?' . encode_source($var_2 . '|' . $var_6);
                }
                $var_410[] = $var_6;
            }
        }
        $v_110 = str_replace($var_164, $var_410, $v_110);
    }
    return $v_110;
}
?>