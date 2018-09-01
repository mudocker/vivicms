<?php
function getcsscachefile($cacheid, $var_241 = ""){
    global $var_1;
    $var_241 = $var_241?$var_241 . '/':"";
    return VV_CACHE . '/css/' . $var_241 . getHashDir($cacheid, 2) . '/' . substr(md5($cacheid), "0", 16) . '.css';
}
function thisurl(){
    global $var_1;
    if (!empty($_SERVER["REQUEST_URI"])){
        $var_289 = $_SERVER["REQUEST_URI"];
        $var_290 = $var_289;
    }else{
        $var_289 = $_SERVER["PHP_SELF"];
        if (empty($_SERVER["QUERY_STRING"])){
            $var_290 = $var_289;
        }else{
            $var_290 = $var_289 . '?' . $_SERVER["QUERY_STRING"];
        }
    }
    $var_401 = $_SERVER["SERVER_PORT"] == 443 ? 'https://' : 'http://';
    return $var_401 . $_SERVER["HTTP_HOST"] . $var_290;
}
function is_fanurl($var_103){
    global $var_1;
    global $caiji_config;
    static $var_66;
    if(isset($var_66[$var_103])){
        return $var_66[$var_103];
    }
    if(!preg_match('~^(https|http):~i', $var_103)){
        $var_66[$var_103] = false;
        return false;
    }
    $var_7 = parse_url($var_103);
    if('www.' . $caiji_config["from_domain"] == $var_7["host"]){
    }
    if(!preg_match('~\.' . preg_quote($caiji_config["from_domain"]) . '$~', $var_7["host"])){
        $var_66[$var_103] = false;
        return false;
    }
    $var_370 = explode("\n", $caiji_config["domain_rules"]);
    $var_402 = false;
    foreach($var_370 as $var_5 => $var_6){
        $var_6 = trim($var_6);
        if($var_6 == '*'){
            $var_372 = preg_replace('~\.' . preg_quote($caiji_config["from_domain"]) . '$~', "", $var_7["host"]);
            $var_402 = true;
            break;
        }
        list($var_371, $var_372) = explode('----', $var_6);
        if($var_7["host"] == ($var_371 . '.' . $caiji_config["from_domain"])){
            $var_402 = true;
            break;
        }
    }
    if($var_402){
        $var_66[$var_103] = $var_372 . '.' . $caiji_config["my_domain"];
        return $var_66[$var_103];
    }
    $var_66[$var_103] = false;
    return false;
}
?>