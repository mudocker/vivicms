<?php
namespace md\data\rules;

class WEB_ROOT{

    /**
     * WEB_ROOT constructor.
     */
    public function __construct()
    {


        $v_config=$GLOBALS['v_config'];
        $caiji_config=$GLOBALS['caiji_config'];
        $GLOBALS['sign']    = $v_config['web_remark']?'/' . $v_config['web_remark'] . '/':'/';
        $temp_url = parse_url($v_config['web_url']);
        define('WEB_ROOT', substr($temp_url['path'], 0, -1));
        if(!$caiji_config['rewrite'] || !checktime_log_out_1h()){
            $GLOBALS['sign'] = '?';
            SCRIPT == 'search' and  $GLOBALS['sign'] = WEB_ROOT . '/?';
        }
    }
}
