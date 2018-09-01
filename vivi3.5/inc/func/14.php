<?php
function arr2file($var_273, $var_299){
    global $var_1;
    if (is_array($var_299)){
        $var_323 = var_export($var_299, true);
    }else{
        $var_323 = $var_299;
    }
    return write($var_273, '<?php' . "\r\n" . 'return ' . $var_323 . ';' . "\r\n" . '?>');
}
function getallimg($html){
    global $var_1;
    global $var_324, $caiji_config, $var_171;
    $var_295 = '~(<img\s+[^>]+>)~iUs';
    preg_match_all($var_295, $html, $var_164);
    $var_325 = array();
    if($var_164){
        foreach($var_164[1] as $var_5 => $var_6){
            if($caiji_config["img_delay_name"]){
                $var_326 = explode(',', $caiji_config["img_delay_name"]);
                foreach($var_326 as $var_47 => $var_327){
                    if(preg_match('~' . $var_327 . '\s*=\s*(["|\']?)\s*([^"\'\s>]+)\s*\1~i', $var_6, $var_328)){
                        $var_325[] = $var_328[2];
                        continue 2;
                    }
                }
            }
            if(preg_match('~src\s*=\s*(["|\']?)\s*([^"\'\s>\\]+)\s*\1~i', $var_6, $var_328)){
                $var_325[] = $var_328[2];
            }
        }
        $var_325 = array_unique($var_325);
    }
    if($var_325 && ISOUTURL){
        foreach($var_325 as $var_5 => $var_6){
            $var_325[$var_5] = get_fullurl($var_6, $var_324);
        }
    }
    sort($var_325);
    return $var_325;
}
function abcdefg(){
    global $var_1;
    return true;
}
?>