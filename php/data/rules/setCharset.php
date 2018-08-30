<?php

namespace md\data\rules;
use md\data\BaseGlobal;

class setCharset extends BaseGlobal {


    public function __construct()
    {

        $config=  $this->caiji_config;
        $QS=&$_SERVER['QUERY_STRING'];
        list($QS,) = explode('#', $QS);
        $QS = convert_query($QS, $config['charset']);
        $this->charset = $config[SCRIPT == 'search' ?'search_charset':'charset'];
    }
}





