<?php
function echo_debug($var_66){
    global $var_1;
    return '<div id="vxiaotou_debug" style="margin:0;width:auto;text-align:left;border:1px dashed #ddd;background: #f8f8f8;padding:10px;font-size:12px;"><div style="color:#aaa;"><span style="font-weight:700;font-size:13px;">╣Вйтпео╒</span><span style="float:right;">vxiaotou.com</div><div style="color:#666;line-height:20px;padding:5px 0;margin-top:5px;border-top:1px dashed #ddd;">' . implode('<br>', $var_66) . '</div></div><br>';
}
function realurlcode($v_332){
    global $var_1;
    return urldecode(str_replace('хf', '%', $v_332));
}
function is_resdomain($var_103){
    global $var_1;
    global $caiji_config;
    if(preg_match('~^data:image/~', $var_103)){
        return false;
    }
    if(!$caiji_config["resdomain"]) return false;
    $var_375 = explode(',', $caiji_config["resdomain"]);
    $var_7 = parse_url($var_103);
    foreach($var_375 as $var_5 => $var_6){
        $var_6 = trim($var_6);
        if($var_6 == "") continue;
        $var_6 = str_replace('.', '\.', $var_6);
        $var_6 = str_replace('*', '([\w-]+)', $var_6);
        if(preg_match('~' . $var_6 . '~i', $var_7["host"])){
            return true;
        }
    }
    return false;
}
?>