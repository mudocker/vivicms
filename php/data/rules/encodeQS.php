<?php

namespace md\data\rules;

use md\data\BaseServer;

class encodeQS extends BaseServer {
     function __construct()
    {

            $v_config=&$GLOBALS['v_config'];
            if (!$v_config['web_urlencode'])return;
            if (!$this->QUERY_STRING)return;
            $QS=&$this->QUERY_STRING;
            list($QS,) =    explode('?', $QS);
            $QS         =    preg_replace('~\.(jpg|css|js|' . $v_config['web_urlencode_suffix'] . ')$~i', '', $QS);
            $QS         =    decode_id($QS);

    }


}


