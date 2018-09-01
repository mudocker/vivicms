<?php
function _htmlspecialchars($v_110){
    global $var_1;
    static $var_294 = array("&" => "&amp;", "<" => "&lt;", ">" => "&gt;", "'" => "&#39;", "\"" => "&quot;");
    return strtr($v_110, $var_294);
}
function getallcss($html){
    global $var_1;
    $var_295 = '~(<link[^>]+>)~iUs';
    preg_match_all($var_295, $html, $var_164);
    $var_296 = array();
    if($var_164){
        foreach($var_164[1] as $var_5 => $var_6){
            if(!preg_match('~rel\s*=\s*(["|\']?)\s*stylesheet\s*\1~i', $var_6)){
                unset($var_164[1][$var_5]);
                continue;
            }
            if(preg_match('~href\s*=\s*(["|\']?)\s*([^"\'\s>\\]+)\s*\1~i', $var_6, $var_297)){
                $var_296[] = $var_297[2];
            }
        }
        $var_296 = array_unique($var_296);
    }
    sort($var_296);
    return $var_296;
}
function scandirs($v_298){
    global $var_1;
    $var_299 = array();
    if(!is_dir($v_298)){
        return false;
    }
    if (!function_exists(scandir)){
        $var_300 = @opendir($v_298);
        while (($var_299[] = @readdir($var_300)) !== false){
        }
        @closedir($var_300);
        $var_299 = array_filter($var_299);
    }else{
        $var_299 = @scandir($v_298);
    }
    return $var_299;
}
?>