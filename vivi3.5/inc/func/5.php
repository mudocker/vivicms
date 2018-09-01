<?php
function removedir($v_411){
    global $var_1;
    if (!is_dir($v_411)){
        return false;
    }
    $v_411 = rtrim($v_411, '/');
    $var_300 = @opendir($v_411);
    while (($var_273 = @readdir($var_300)) !== false){
        if ($var_273 != '.' && $var_273 != '..'){
            $v_298 = $v_411 . '/' . $var_273;
            is_dir($v_298) ?removeDir($v_298) : @unlink($v_298);
        }
    }
    closedir($var_300);
    return rmdir($v_411) ;
}
function savelinksdata($var_103){
    global $var_1;
    $var_313 = VV_CACHE . '/linksdata/' . getHashDir($var_103, 2) . '/' . substr(md5($var_103), "0", 16) . '.cache';
    $var_155 = array("all_links_text" => $GLOBALS["all_links_text"], "all_links_pic" => $GLOBALS["all_links_pic"],);
    write($var_313, serialize($var_155));
}
function get_showurl($var_241, $var_88 = ""){
    global $var_1;
    global $v_config;
    global $var_83;
    $var_241 = str_ireplace('http://' . $_SERVER["HTTP_HOST"] . '/', "", $var_241);
    if(!isgoodurl($var_103)){
        return $var_241;
    }
    if(substr($var_6, "0", 1) != '/' || substr($var_6, "0", 2) == './' || stripos($var_6, '..') !== false){
        $var_241 = get_fullurl($var_241, $GLOBALS["geturl"]);
        $var_241 = preg_replace('~^https?://[^/]+/~', "", $var_241);
    }
    $var_88 = $var_88?'.' . $var_88:"";
    if ($v_config["web_urlencode"]){
        $var_241 = encode_id($var_241) . $var_88;
    }
    return $var_83 . $var_241;
}
?>