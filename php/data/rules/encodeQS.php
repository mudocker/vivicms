<?php

namespace md\data\rules;

use md\data\BaseServer;

class encodeQS extends BaseServer {
    public function __construct()
    {

            $v_config=&$GLOBALS['v_config'];
            if (!$v_config['web_urlencode'])return;
            if (!$this->QUERY_STRING)return;
            list($this->QUERY_STRING,) =    explode('?', $this->QUERY_STRING);
            $this->QUERY_STRING         =    preg_replace('~\.(jpg|css|js|' . $v_config['web_urlencode_suffix'] . ')$~i', '', $this->QUERY_STRING);
            $this->QUERY_STRING         =    decode_id($this->QUERY_STRING);

    }


}


