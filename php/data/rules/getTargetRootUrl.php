<?php

namespace md\data\rules;
use md\data\BaseGlobal;

class getTargetRootUrl extends BaseGlobal {
     function __construct(){
        $this->server_url = $this->parse_url['scheme'] . '://' . $this->parse_url['host'];
        $this->server_url2     = '//' . $this->parse_url['host'];
        $this->addPort();
    }
    function addPort(){
        $port = isset($this->parse_url['port'])?$this->parse_url['port']:'';
        if(!$port) return;
        $this->server_url =  $this->server_url . ':' . $port;
        $this->server_url2 =  $this->server_url2 . ':' . $port;
    }
}
