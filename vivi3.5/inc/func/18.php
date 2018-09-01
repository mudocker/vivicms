<?php
function debug_flush(){
    global $var_1;
    global $v_config;
    $GLOBALS["debug"][] = '程序运行总共用时：' . round((debug_time() - RUN_TIME), 4) . 's';
    $GLOBALS["debug"][] = '内存开销：' . ((memory_get_usage() - $GLOBALS["_start_memory"]) / 1024) . ' kb';
    if($v_config["web_debug"] == 'on'){
        echo echo_debug($GLOBALS["debug"]);
    }
}
function reset_domain(){
    global $var_1;
    global $v_config, $caiji_config;
    $var_53 = glob(VV_DATA . '/config/*.php');
    $var_347 = $var_202 = array();
    if($var_53){
        foreach($var_53 as $var_5 => $var_6){
            $var_32 = require_once($var_6);
            if($var_32 === true){
                $var_32 = $caiji_config;
            }
            if($var_32["web_domains"]){
                if($var_32["web_close"] != 'on'){
                    $var_348 = explode(',', $var_32["web_domains"]);
                    foreach($var_348 as $var_47 => $var_48){
                        $var_202[] = array("domain" => $var_48, "name" => $var_32["web_name"]);
                    }
                }
                $var_347[$var_32["web_domains"]] = intval(str_replace('.php', "", basename($var_6)));
            }
        }
    }
    arr2file(VV_DATA . '/domain_link.php', $var_202);
    arr2file(VV_DATA . '/domain_config.php', $var_347);
}
function _base64_encode($var_32){
    global $var_1;
    return str_rot13(rtrim(strtr(base64_encode($var_32), '+/', '!;'), '='));
}
?>