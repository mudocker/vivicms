<?php
function getalljs($html){
    global $var_1;
    $var_295 = '~(<script\s+[^>]+>)~iUs';
    preg_match_all($var_295, $html, $var_164);
    $var_368 = array();
    if($var_164){
        foreach($var_164[1] as $var_5 => $var_6){
            if(preg_match('~src\s*=\s*(["|\']?)\s*([^"\'\s>\\]+)\s*\1~i', $var_6, $var_369)){
                $var_368[] = $var_369[2];
            }
        }
        $var_368 = array_unique($var_368);
    }
    sort($var_368);
    return $var_368;
}
function get_from_url($var_103){
    global $var_1;
    global $caiji_config;
    $var_7 = parse_url($var_103);
    if(!preg_match('~\.' . preg_quote($caiji_config["my_domain"]) . '$~', $_SERVER["HTTP_HOST"])){
        return $var_103;
    }
    if('www.' . $caiji_config["from_domain"] == $_SERVER["HTTP_HOST"]){
        return $var_103;
    }
    $var_241 = preg_replace('~https?://[^/]+/?~i', "", $var_103);
    $var_370 = explode("\n", $caiji_config["domain_rules"]);
    foreach($var_370 as $var_5 => $var_6){
        $var_6 = trim($var_6);
        if($var_6 == '*'){
            $var_371 = preg_replace('~\.' . preg_quote($caiji_config["my_domain"]) . '$~', "", $_SERVER["HTTP_HOST"]);
            $var_103 = $var_7["scheme"] . '://' . $var_371 . '.' . $caiji_config["from_domain"] . '/' . $var_241;
            $GLOBALS["is_fanurl"] = true;
            break;
        }
        list($var_371, $var_372, $GLOBALS["fan_title"], $GLOBALS["fan_keywords"], $GLOBALS["fan_description"]) = explode('----', $var_6);
        if($_SERVER["HTTP_HOST"] == ($var_372 . '.' . $caiji_config["my_domain"])){
            $var_103 = $var_7["scheme"] . '://' . $var_371 . '.' . $caiji_config["from_domain"] . '/' . $var_241;
            $GLOBALS["is_fanurl"] = true;
            break;
        }
    }
    return $var_103;
}
function getDirSize($v_298){
    global $var_1;
    if ($var_300 = opendir($v_298)){
        while (($var_373 = readdir($var_300)) !== false){
            if ($var_373 != '.' && $var_373 != '..'){
                if (!isset($var_374)) $var_374 = "0";
                if (is_dir("$v_298/$var_373")){
                    $var_374 += getDirSize("$v_298/$var_373");
                }else{
                    $var_374 += filesize("$v_298/$var_373");
                }
            }
        }
    }
    closedir($var_300);
    return $var_374;
}
?>