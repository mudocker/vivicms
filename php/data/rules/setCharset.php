<?php

namespace md\data\rules;
use md\data\BaseGlobal;

class setCharset extends BaseGlobal {

    /**
     * convert_QUERY_STRING_charset constructor.
     */
    public function __construct()
    {

        $config=  $this->caiji_config;
        $QS=&$_SERVER['QUERY_STRING'];
        list($QS,) = explode('#', $QS);

        $QS = convert_query($QS, $config['charset']);

        $search=SCRIPT == 'search' && $config['search_charset'];
        $this->charset = $config[ $search?'search_charset':'charset'];
    }
}





