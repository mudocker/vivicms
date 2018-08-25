<?php

namespace md\data\rules;
class get_url_charset{

    /**
     * convert_QUERY_STRING_charset constructor.
     */
    public function __construct()
    {

        $caiji_config= & $GLOBALS['caiji_config'];
        list($_SERVER['QUERY_STRING'],) = explode('#', $_SERVER['QUERY_STRING']);
        $_SERVER['QUERY_STRING'] = convert_query($_SERVER['QUERY_STRING'], $caiji_config['charset']);
         $GLOBALS['charset'] = (SCRIPT == 'search' && $caiji_config['search_charset'])?$caiji_config['search_charset']:$caiji_config['charset'];
    }
}





