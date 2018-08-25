<?php

namespace md\data\rules;

class urlencode{

    /**
     * urlencode constructor.
     */
    public function __construct()
    {

        $v_config=&$GLOBALS['v_config'];
        if($v_config['web_urlencode'] && $_SERVER['QUERY_STRING']){
            list($_SERVER['QUERY_STRING'],) =    explode('?', $_SERVER['QUERY_STRING']);
            $_SERVER['QUERY_STRING'] =           preg_replace('~\.(jpg|css|js|' . $v_config['web_urlencode_suffix'] . ')$~i', '', $_SERVER['QUERY_STRING']);
            $_SERVER['QUERY_STRING'] =           decode_id($_SERVER['QUERY_STRING']);
        }
    }
}


