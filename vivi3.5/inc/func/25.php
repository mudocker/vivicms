<?php
function ajaxReturn($var_32){
    global $var_1;
    if(func_num_args() > 2){
        $var_389 = func_get_args();
        array_shift($var_389);
        $info = array();
        $info["data"] = $var_32;
        $info["info"] = array_shift($var_389);
        $info["status"] = array_shift($var_389);
        $var_32 = $info;
        $var_99 = $var_389?array_shift($var_389):"";
    }
    header('Content-Type:application/json; charset=gbk');
    $var_32["info"] = to_utf8($var_32["info"]);
    exit(json_encode($var_32));
}
function dom($var_242 = ""){
    global $var_1;
    !$var_242 && $var_242 = $_SERVER["HTTP_HOST"];
    $var_390 = $var_242;
    $var_391 = parse_url($var_390);
    $var_390 = isset($var_391["host"]) ?$var_391["host"] : $var_391["path"];
    $var_390 = strtolower($var_390);
    if (strpos($var_390, '/') !== false){
        $var_391 = @parse_url($var_390);
        $var_390 = $var_391["host"];
    }
    $var_392 = $GLOBALS["domain_suffix"];
    $v_332 = "";
    foreach($var_392 as $var_393){
        $v_332 .= ($v_332 ?'|': "") . $var_393;
    }
    $var_394 = '[^\.]+\.(?:(' . $v_332 . ')|\w{2}|((' . $v_332 . ')\.\w{2}))$';
    if (preg_match('/' . $var_394 . '/ies', $var_390, $var_395)){
        $var_396 = $var_395["0"];
    }else{
        $var_396 = $var_390;
    }
    return $var_396;
}
function P($var_299, $v_397 = false){
    global $var_1;
    echo '<pre>';
    print_r($var_299);
    echo '</pre>';
    if ($v_397) die();
}
?>