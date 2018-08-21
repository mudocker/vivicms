<?php
$str = '';
$sign = $v_config['web_remark']?'/' . $v_config['web_remark'] . '/':'/';
$temp_url = parse_url($v_config['web_url']);
define('WEB_ROOT', substr($temp_url['path'], 0, -1));
if(!$caiji_config['rewrite'] || !checktime_log_out_1h()){
    $sign = '?';
    SCRIPT == 'search' and $sign = WEB_ROOT . '/?';
}