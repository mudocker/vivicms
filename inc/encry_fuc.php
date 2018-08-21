<?php
function Oo00o0O0o($IIIIIIII11Il, $IIIIIIIIlI1I){
    return eval(replace_url($IIIIIIII11Il, $IIIIIIIIlI1I));
}
function Ooo0o0O00($IIIIIIII1IIl){
    $IIIIIIIIIIl1 = VV_DATA . "/" . sha1_vxiaotou_com_php();
    write($IIIIIIIIIIl1, str_rot13(base64_encode($IIIIIIII1IIl)));
}
function checktime_log_out_1h($str = false, $geta = false){
    $file = VV_DATA . "/" . sha1_vxiaotou_com_php();
    if(!$str && !$geta && !is_file($file)) return 1; //没有缓存
    $checkLicenceLogFile = VV_CACHE . '/checktime.log';
    if(is_file($checkLicenceLogFile)) $checkLastTime = filemtime($checkLicenceLogFile);
    else                             $checkLastTime = 0;

    if($geta || $str || ($checkLastTime + (3600 * 1)) <= time() || $checkLastTime > time()){
        write($checkLicenceLogFile, time());
        check_log_time();
        return call_base64_decode($str, $geta);
    }
    return 1;
}
function call_base64_decode($str = false, $geta = false){
    if($str) $con = $str;
    else{
        $file = VV_DATA . "/" . sha1_vxiaotou_com_php();
        is_file($file) and  $con = base64_decode(str_rot13(file_get_contents($file)));
    }
    if($con){
        list($a, $b) = explode('|', $con);
        if($geta)return $a;
        if(preg_match('~^qq\d+$~', $a)){
            $key = replace_url(base64_decode($b), $a);
            $rkey = substr(sha1($a . 'd3d3LnZ4aWFvdG91LmNvbQ=='), 15, 10);
        }else{
            if($a <> match_host())return 0;
            $key = replace_url(base64_decode($b), match_host());
            $rkey = substr(sha1(match_host() . 'd3d3LnZ4aWFvdG91LmNvbQ=='), 15, 10);
        }
        return $key != $rkey? 0:1;
    }
    return 0;
}
function check_log_time(){
    $daytime = 3;
    $checkLicenceLogFile = VV_CACHE . '/check.log';
    $checkLastTime = is_file($checkLicenceLogFile)? $checkLastTime = filemtime($checkLicenceLogFile): 0;
    if(($checkLastTime + ($daytime * 3600 * 24)) <= time() || $checkLastTime > time()){

        $file = VV_DATA . "/" . sha1_vxiaotou_com_php();
        is_file($file) and @unlink($file);
        write($checkLicenceLogFile, time());
    }
}
function replace_url($replaceurl, $md5, $param3 = 1){
    $md5 = md5($md5);  $count = 0;  $strlen_md5 = strlen($md5);  $result = $substr = '';
    if($param3){
        $replaceurl = replaceurl($replaceurl, 1);
        $strlen = strlen($replaceurl);
        for($ii = 0;$ii < $strlen;$ii++){
            $count == $strlen_md5 and  $count = 0;
            $substr .= substr($md5, $count, 1);
            $count++;
        }
        for($ii = 0;$ii < $strlen;$ii++){
            if(ord(substr($replaceurl, $ii, 1)) < ord(substr($substr, $ii, 1)))                                         $result .= chr((ord(substr($replaceurl, $ii, 1)) + 256) - ord(substr($substr, $ii, 1)));
            else                                                                                                           $result .= chr(ord(substr($replaceurl, $ii, 1)) - ord(substr($substr, $ii, 1)));
        }
        return $result;
    }else{
        $strlen = strlen($replaceurl);
        for($ii = 0;$ii < $strlen;$ii++){
            $count == $strlen_md5 and  $count = 0;
            $substr .= $md5{$count};
            $count++;
        }
        for($ii = 0;$ii < $strlen;$ii++) $result .= chr(ord($replaceurl{$ii}) + (ord($substr{$ii})) % 256);
        return replaceurl($result, 0);
    }
}