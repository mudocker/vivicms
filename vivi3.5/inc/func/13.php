<?php
function utf2gbk($v_110){
    global $var_1;
    if (is_utf8($v_110)){
        if (PATH_SEPARATOR == ':'){
            $v_110 = mb_convert_encoding($v_110, 'gbk', 'utf-8');
        }else{
            $v_110 = iconv('utf-8', 'gbk//IGNORE', $v_110);
        }
    }
    return $v_110;
}
function _base64_decode($var_32){
    global $var_1;
    return base64_decode(str_pad(strtr(str_rot13($var_32), '!;', '+/'), strlen($var_32) % 4, '=', STR_PAD_RIGHT));
}
function getallhref($html){
    global $var_1;
    $var_295 = '~(<a\s+[^>]+>)~iUs';
    preg_match_all($var_295, $html, $var_164);
    $var_321 = array();
    if($var_164){
        foreach($var_164[1] as $var_5 => $var_6){
            if(preg_match('~href\s*=\s*(["|\']?)\s*([^"\'\s>\\]+)\s*\1~i', $var_6, $var_322)){
                $var_321[] = $var_322[2];
            }
        }
        $var_321 = array_unique($var_321);
    }
    sort($var_321);
    return $var_321;
}
?>