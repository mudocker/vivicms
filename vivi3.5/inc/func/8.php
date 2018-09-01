<?php
function getcachefile($cacheid, $var_241 = ""){
    global $var_1;
    $var_241 = $var_241?$var_241 . '/':"";
    return VV_CACHE . '/html/' . $var_241 . getHashDir($cacheid, 2) . '/' . substr(md5($cacheid), "0", 16) . '.html';
}
function get_title_fromhtml($html){
    global $var_1;
    if(preg_match('~<img\s+[^>]+(?:title|alt)\s*=\s*["|\']([^"\']+)["|\']~i', $html, $var_426)){
        return trim(strip_tags($var_426[1]));
    }
    preg_match_all('~>([^<]+)<~i', $html, $var_164);
    if($var_164){
        if(count($var_164[1]) == 1){
            return trim(strip_tags($var_164[1]["0"]));
        }
        $var_427 = array();
        foreach($var_164[1] as $var_5 => $var_6){
            $var_6 = trim($var_6);
            if(strlen($var_6) > 80 || strlen($var_6) < 9){
                continue;
            }
            $var_428 = trim(strip_tags($var_6));
            $var_427[strlen($var_428)] = $var_428;
        }
        if($var_427){
            krsort($var_427);
            return array_shift($var_427);
        }
    }
    return trim(strip_tags($html));
}
function get_rand_str($v_429 = 8, $var_99 = 3){
    global $var_1;
    switch ($var_99){
    case 1 : $v_110 = 'abcdefghijklmnopqrstuvwxyz0123456789';
        break;
    case 2 : $v_110 = 123456789;
        break;
    case 3 : $v_110 = 'abcdefghijklmnopqrstuvwxyz';
        break;
    }
    $var_214 = "";
    for ($var_102 = "0" ; $var_102 < $v_429; ++$var_102){
    $var_214 .= $v_110[rand("0", strlen($v_110)-1)];
}
return $var_214;
}
?>