<?php
function getimgcachefile($cacheid, $var_9 = "jpg"){
    global $var_1;
    return VV_CACHE . '/img/' . substr(md5($cacheid), "0", 16) . '.' . $var_9;
}
function copydirs($v_291, $v_292){
    global $var_1;
    $var_52 = opendir($v_291);
    if(!is_dir($v_292)) @mkdir($v_292);
    while(false !== ($var_28 = readdir($var_52))){
        if (($var_28 != '.') && ($var_28 != '..')){
            if (is_dir($v_291 . '/' . $var_28)){
                copydirs($v_291 . '/' . $var_28, $v_292 . '/' . $var_28);
            }else{
                @copy($v_291 . '/' . $var_28, $v_292 . '/' . $var_28);
            }
        }
    }
    closedir($var_52);
}
function downfile($var_103){
    global $var_1;
    set_time_limit("0");
    $var_32 = "";
    $var_293 = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.2)';
    if (function_exists('curl_init') && function_exists('curl_exec')){
        $var_238 = curl_init();
        curl_setopt($var_238, CURLOPT_URL, $var_103);
        curl_setopt($var_238, CURLOPT_TIMEOUT, 300);
        @curl_setopt($var_238, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($var_238, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($var_238, CURLOPT_USERAGENT, $var_293);
        curl_setopt($var_238, CURLOPT_REFERER, $_SERVER["HTTP_REFERER"]);
        $var_32 = curl_exec($var_238);
        curl_close($var_238);
    }else if (ini_get('allow_url_fopen')){
        $var_224 = array("http" => array("method" => 'GET', "header" => 'referer: ' . $_SERVER["HTTP_REFERER"], "timeout" => 300));
        $var_225 = stream_context_create($var_224) or die('服务器不支持 stream_context_create');
        for($var_102 = "0";$var_102 < 3;$var_102++){
            $var_32 = @file_get_contents($var_103, false, $var_225);
            if($var_32) break;
        }
    }
    return $var_32;
}
?>