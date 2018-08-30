<?php

namespace md\data\rules;
use md\data\BaseGlobal;

class getTargetRootUrl extends BaseGlobal {
     function __construct(){
        $this->getServerUrl();
        $this->getServerUrl2();
        $this->addPort();
    }

    function  getServerUrl(){
        $this->server_url = $this->scheme . '://' . $this->host;
    }
    function  getServerUrl2(){
        $this->server_url2     = '//' . $this->host;
    }
    function getPort(){
      return isset($this->port)?$this->port:'';
    }
    function addPort(){
        if(!($port=$this->getPort())) return;
        $this->server_url =  $this->server_url . ':' . $port;
        $this->server_url2 =  $this->server_url2 . ':' . $port;
    }




    function __get($name){
        $value=  parent::__get($name);
        (null===$value )and $value=isset( $this->parse_url[$name])? $this->parse_url[$name]:null;
        return $value;
    }


}
