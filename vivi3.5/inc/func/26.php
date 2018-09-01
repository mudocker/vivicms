<?php
function write($v_314, $v_363, $v_398 = "w"){
    global $var_1;
    mkdirs(dirname($v_314));
    if (is_file($v_314) && !is_writable($v_314)){
        return false;
    }
    if ($v_398 == 'w'){
        return file_put_contents($v_314, $v_363);
    }
    $var_399 = fopen($v_314, $v_398);
    flock($var_399, 2);
    $var_400 = fwrite($var_399, $v_363);
    fclose($var_399);
    return $var_400;
}
function isgoodurl($var_103){
    global $var_1;
    if(preg_match('~^(magnet|ed2k|thunder|ftp|javascript|https|http|file|mailto|data|#):~i', $var_103)){
        return false;
    }
    return true;
}
?>