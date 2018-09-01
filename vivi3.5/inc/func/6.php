<?php
function banip(){
    global $var_1;
    $var_273 = VV_DATA . '/banip.conf';
    $var_412 = @file_get_contents($var_273);
    if ($var_412){
        $var_413 = str_replace(array("\r\n", "\r", "\n"), '|||', $var_412);
        $var_331 = $_SERVER["REMOTE_ADDR"];
        $var_413 = explode('|||', $var_413);
        foreach($var_413 as $var_340){
            $var_393 = str_replace(array('*', '.'), array('\d+', '\.'), $var_393);
            if (preg_match('/^' . $var_340 . '$/', $var_331)){
                die('Your IP banned access!');
            }
        }
    }
}
function is_utf8_old($v_110){
    global $var_1;
    $var_414 = strlen($v_110);
    for($var_102 = "0"; $var_102 < $var_414; $var_102++){
        $var_415 = ord($v_110[$var_102]);
        if ($var_415 > 128){
            if (($var_415 > 247)) return false;
            elseif ($var_415 > 239) $var_416 = 4;
            elseif ($var_415 > 223) $var_416 = 3;
            elseif ($var_415 > 191) $var_416 = 2;
            else return false;
            if (($var_102 + $var_416) > $var_414) return false;
            while ($var_416 > 1){
                $var_102++;
                $var_152 = ord($v_110[$var_102]);
                if ($var_152 < 128 || $var_152 > 191) return false;
                $var_416--;
            }
        }
    }
    return true;
}
function replace_sifttags($v_110){
    global $var_1;
    global $caiji_config;
    if (!$v_110 || !$caiji_config["siftags"] || !is_array($caiji_config["siftags"])){
        return $v_110;
    }
    if (in_array('iframe', $caiji_config["siftags"]))$v_110 = preg_replace('/<(iframe.*?)>(.*?)<(\/iframe.*?)>/si', "", $v_110);
    if (in_array(object, $caiji_config["siftags"]))$v_110 = preg_replace('/<(object.*?)>(.*?)<(\/object.*?)>/si', "", $v_110);
    if (in_array('script', $caiji_config["siftags"]))$v_110 = preg_replace('/<(script.*?)>(.*?)<\/script>/si', "", $v_110);
    if (in_array('form', $caiji_config["siftags"]))$v_110 = preg_replace('~<(|/)form([^>]*)>~i', "", $v_110);
    if (in_array('input', $caiji_config["siftags"]))$v_110 = preg_replace('~<input([^>]*)>~i', "", $v_110);
    if (in_array('textarea', $caiji_config["siftags"]))$v_110 = preg_replace('/<(textarea.*?)>(.*?)<\/textarea>/si', "", $v_110);
    if (in_array('botton', $caiji_config["siftags"]))$v_110 = preg_replace('/<(botton.*?)>(.*?)<\/botton>/si', "", $v_110);
    if (in_array('select', $caiji_config["siftags"]))$v_110 = preg_replace('/<(select.*?)>(.*?)<\/select>/si', "", $v_110);
    if (in_array('div', $caiji_config["siftags"]))$v_110 = preg_replace('~<(|/)div([^>]*)>~i', "", $v_110);
    if (in_array('table', $caiji_config["siftags"]))$v_110 = preg_replace('~<(|/)table([^>]*)>~i', "", $v_110);
    if (in_array('tr', $caiji_config["siftags"]))$v_110 = preg_replace('~<(|/)tr([^>]*)>~i', "", $v_110);
    if (in_array('td', $caiji_config["siftags"]))$v_110 = preg_replace('~<(|/)td([^>]*)>~i', "", $v_110);
    if (in_array('th', $caiji_config["siftags"]))$v_110 = preg_replace('~<(|/)th([^>]*)>~i', "", $v_110);
    if (in_array('span', $caiji_config["siftags"]))$v_110 = preg_replace('~<(|/)span([^>]*)>~i', "", $v_110);
    if (in_array('img', $caiji_config["siftags"]))$v_110 = preg_replace('~<img([^>]+)>~i', "", $v_110);
    if (in_array('font', $caiji_config["siftags"]))$v_110 = preg_replace('~<(|/)font([^>]*)>~i', "", $v_110);
    if (in_array('a', $caiji_config["siftags"]))$v_110 = preg_replace('~<(|/)a([^>]*)>~i', "", $v_110);
    if (in_array('html', $caiji_config["siftags"]))$v_110 = preg_replace('~<(|/)html([^>]*)>~i', "", $v_110);
    if (in_array('style', $caiji_config["siftags"]))$v_110 = preg_replace('/<(style.*?)>(.*?)<\/style>/si', "", $v_110);
    return $v_110;
}
?>