<?php
function regxcut($var_295, $v_110){
    global $var_1;
    if(preg_match('~' . $var_295 . '~iUs', $v_110, $var_164)){
        return trim($var_164[1]);
    }
    return false;
}
if(!function_exists(get_page)){
    function get_page($v_380, $v_381, $var_103, $v_382 = 5, $v_383 = false){
        global $var_1;
        if($v_381 < 2) return false;
        $var_384 = "";
        $var_384 .= ($v_380 > 1)? '<a href="' . str_replace('{!page!}', 1, $var_103) . '">首页</a><a href="' . str_replace('{!page!}', ($v_380-1), $var_103) . '">上一页</a>': "";
        for($var_102 = $v_380 - $v_382, $var_102 > 1 || $var_102 = 1, $var_385 = $v_380 + $v_382, $var_385 < $v_381 || $var_385 = $v_381;$var_102 < $var_385 + 1;$var_102++){
            $var_384 .= ($var_102 == $v_380)?'<span>' . $var_102 . '</span>':'<a href="' . str_replace('{!page!}', $var_102, $var_103) . '">' . $var_102 . '</a>';
        }
        $var_384 .= ($v_380 < $v_381 && $v_381 > $v_382)? '<i>...</i><a href="' . str_replace('{!page!}', $v_381, $var_103) . '">' . $v_381 . '</a><a href="' . str_replace('{!page!}', ($v_380 + 1), $var_103) . '">下一页</a>': "";
        if (!empty($v_383)){
            $var_384 .= '&nbsp;<input type="input" name="page"/><input type="button" value="跳 转" onclick="' . $v_383 . '"/>';
        }
        return $var_384;
    }
}
function decode_source($v_110){
    global $var_1;
    return _base64_decode(strrev(rawurldecode($v_110)));
}
function is_themerule($var_103, $v_386){
    global $var_1;
    static $var_387 = array();
    static $var_388 = array();
    $var_137 = explode("\n", $v_386);
    $cacheid = md5($var_103 . implode("", $var_137));
    if(isset($var_387[$cacheid])){
        return $var_387[$cacheid];
    }
    foreach($var_137 as $var_5 => $var_6){
        if(!isset($var_388[$var_6])){
            $var_295 = trim($var_6);
            $var_295 = str_replace(array('{数字}', '{字母}', '{数字字母}', '{*}'), array('@数字@', '@字母@', '@数字字母@', '@x@'), $var_295);
            $var_295 = preg_quote($var_295);
            $var_295 = str_replace(array('@数字@', '@字母@', '@数字字母@', '@x@'), array('(\d+)', '([a-z,A-Z]+)', '([0-9,a-z,A-Z]+)', '(.*)'), $var_295);
            $var_388[$var_6] = $var_295;
        }
        $var_146 = $var_103;
        if(preg_match('~^https?\\://~', $var_388[$var_6]) && !preg_match('~^https?://~i', $var_146)){
            preg_match('~^(https?://[^/]+/)~', $GLOBALS["geturl"], $var_164);
            $var_146 = $var_164[1] . ltrim($var_146, '/');
        }else if(!preg_match('~^https?\\://~', $var_388[$var_6]) && preg_match('~^https?://~i', $var_146)){
            preg_match('~^(https?://[^/]+/)~', $GLOBALS["geturl"], $var_164);
            $var_146 = str_replace($var_164[1], '/', $var_146);
        }
        if(preg_match('~^' . $var_388[$var_6] . '$~', $var_146)){
            $var_387[$cacheid] = true;
            return true;
        }
    }
    $var_387[$cacheid] = false;
    return false;
}
?>