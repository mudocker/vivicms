<?php
function get_fullurl($v_417, $v_418 = ""){
    global $var_1;
    !$v_418 && $v_418 = $GLOBALS["collect_baseurl"];
    if(!$v_418) return $v_417;
    $var_419 = parse_url($v_418);
    if(substr($v_417, "0", 1) == '?'){
        $v_417 = $var_419["path"] . $v_417;
    }
    $var_420 = parse_url($v_417);
    if(isset($var_420["scheme"])){
        return $v_417;
    }
    if(stripos($var_419["path"], '.') === false && stripos($var_419["path"], '?') === false) $var_419["path"] .= '/1';
    $var_103 = $var_419["scheme"] . '://' . $var_419["host"];
    if(substr($var_420["path"], "0", 1) == '/'){
        $var_241 = $var_420["path"];
    }else{
        $var_241 = dirname($var_419["path"]) . '/' . $var_420["path"];
    }
    $var_421 = array();
    $var_422 = explode('/', $var_241);
    if(!$var_422["0"]){
        $var_421[] = "";
    }
    foreach ($var_422 AS $var_59 => $var_52){
        if ($var_52 == '..'){
            if (end($var_421) == '..'){
                $var_421[] = '..';
            }elseif(!array_pop($var_421)){
                $var_421[] = '..';
            }
        }elseif($var_52 && $var_52 != '.'){
            $var_421[] = $var_52;
        }
    }
    if(!end($var_422)){
        $var_421[] = "";
    }
    $var_103 .= implode('/', $var_421);
    $var_103 = str_replace('\\', '/', $var_103);
    $var_103 = preg_replace('~([\w]+)/{2,}~', '\1/', $var_103);
    if(isset($var_420["query"])) $var_103 .= '?' . $var_420["query"];
    return $var_103;
}
function run_time($v_423 = false){
    global $var_1;
    static $var_424 = 0;
    if ($v_423){
        $var_424 = microtime(true);
    }else{
        return sprintf('%.5f', microtime(true) - $var_424);
    }
}
function display($var_134, $var_32){
    global $var_1;
    global $v_config, $caiji_config, $themedir;
    require(VV_INC . '/vivi_template.class.php');
    $var_425 = new template;
    $var_425 -> compile_check = true;
    $var_425 -> plugins_dir = VV_INC . '/tpltags/';
    $var_425 -> template_dir = $themedir;
    $var_425 -> compile_dir = VV_CACHE . '/tplcache/' . $caiji_config["theme_dir"];
    $var_425 -> cache_dir = VV_CACHE;
    $var_425 -> assign($var_32);
    $var_425 -> display($var_134);
}
?>