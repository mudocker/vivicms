<?php

global $v_config, $caiji_config;
$spider_name = '';
if(!checktime_log_timeout()){
    $caiji_config['ip_type'] = $caiji_config['user_agent'] = $caiji_config['referer'] = $caiji_config['cookie'] = '';
    $spider_name = 'vxiaotou-spider; ';
}
$url = str_replace(array(' ', '+'), '%20', $url);
$user_agent = $caiji_config['user_agent']?$caiji_config['user_agent']:'Mozilla/4.0 (compatible; ' . $spider_name . 'MSIE 8.0; Windows NT 5.2)';
$cookie = $caiji_config['cookie']?$caiji_config['cookie']:'_vstime=' . time();
$referer = $caiji_config['referer']?$caiji_config['referer']:$caiji_config['from_url'];