<?php
function OoO0oOo0o(){
	return true;
    global $var_1;
    $var_29 = $_SERVER["SERVER_ADDR"];
    $var_222 = explode('.', $var_29);
    array_pop($var_222);
    $var_28 = md5(implode($var_222, '.') . 'licence_v') . '.key';
    if(is_file(VV_DATA . '/' . $var_28)){
        return $var_28;
    }
    $var_28 = md5(php_uname('a') . 'licence_v') . '.key';
    if(is_file(VV_DATA . '/' . $var_28) && is_writable(VV_DATA . '/' . $var_28)){
        return $var_28;
    }
    return md5(php_uname('a') . 'licence_v') . '.txt';
}
function get_all_link($html){
    global $var_1;
    global $caiji_config;
    $var_295 = '~(<a\s+[^>]+>.*</a>)~iUs';
    preg_match_all($var_295, $html, $var_164);
    $var_321 = array();
    $var_341 = array('-');
    if($caiji_config["theme_sifturl"]){
        $var_341 = explode("\n", $caiji_config["theme_sifturl"]);
        $var_341 = array_map(trim, $var_341);
    }
    if($var_164){
        foreach($var_164[1] as $var_5 => $var_6){
            if(preg_match('~href\s*=\s*(["|\']?)\s*([^"\'\s>\\]+)\1[^>]*>(.*)</a>~iUs', $var_6, $var_322)){
                if(preg_match('~^(javascript:|file:|mailto:|data:|#)~i', $var_322[2])){
                    continue;
                }
                $var_342 = true;
                if(preg_match('~^https?://~i', $var_322[2]) && !is_fanurl($var_322[2]) || $var_322[2] == '/'){
                    $var_342 = false;
                }
                $var_66 = array("url" => $var_322[2], "text" => trim($var_322[3]));
                $var_66["ispic"] = "0";
                $var_66["fromurl"] = get_fullurl($var_66["url"], $GLOBALS["geturl"]);
                if(in_array($var_66["fromurl"], $var_341)){
                    $var_342 = false;
                }
                $var_343 = md5($var_66["url"]);
                if(stripos($var_322[3], '<img') !== false){
                    $var_66["ispic"] = 1;
                    if($var_342){
                        if(!isset($GLOBALS["all_links_pic"][$var_343]) || strlen($GLOBALS["all_links_pic"][$var_343]["text"]) < strlen($var_66["text"])){
                            $var_147 = getallimg($var_66["text"]);
                            $var_66["litpic"] = $var_147["0"];
                            $var_66["title"] = get_title_fromhtml($var_66["text"]);
                            $GLOBALS["all_links_pic"][$var_343] = _unset($var_66, 'text');
                        }
                    }
                }else{
                    $var_66["title"] = trim(strip_tags($var_66["text"]));
                    if($var_342 && $var_66["title"]){
                        if(!isset($GLOBALS["all_links_text"][$var_343]) || strlen($GLOBALS["all_links_text"][$var_343]["title"]) < strlen($var_66["title"])){
                            $GLOBALS["all_links_text"][$var_343] = _unset($var_66, 'text');
                        }
                    }
                }
                $GLOBALS["allhref"][] = $var_66["url"];
                if(!isset($var_321[$var_343]) || strlen($var_321[$var_343]["text"]) < strlen($var_66["text"])){
                    $var_321[$var_343] = $var_66;
                }
            }
        }
        sort($GLOBALS["allhref"]);
    }
    return $var_321;
}
function test_write($v_344){
    global $var_1;
    $var_345 = '_vivi_test.txt';
    if(is_dir($v_344)){
        $v_344 = preg_replace('#\/$#', "", $v_344);
        $var_246 = @fopen($v_344 . '/' . $var_345, 'w');
        if (!$var_246){
            return false;
        }else{
            fclose($var_246);
            $var_346 = @unlink($v_344 . '/' . $var_345);
            if ($var_346) return true;
            else return false;
        }
    }else if(is_file($v_344)){
        return is_writable($v_344);
    }
    return false;
}
?>