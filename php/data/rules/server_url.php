<?php

namespace md\data\rules;
class server_url{

    /**
     * server_url constructor.
     */
    public function __construct()
    {
        $parse_url=& $GLOBALS['parse_url'];
        $port = isset($parse_url['port'])?$parse_url['port']:'';
        $GLOBALS['server_url'] = $parse_url['scheme'] . '://' . $parse_url['host'];
        $GLOBALS['server_url2']     = '//' . $parse_url['host'];
        if(!$port) return;
         $GLOBALS['server_url'] =  $GLOBALS['server_url'] . ':' . $port;
         $GLOBALS['server_url2'] =  $GLOBALS['server_url2'] . ':' . $port;

    }
}
