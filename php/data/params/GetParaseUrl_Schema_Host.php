<?php

namespace md\data\params;
use md\data\BaseGlobal;

class GetParaseUrl_Schema_Host extends BaseGlobal
{
    function __construct(){
     define('ISOUTURL', $this->isouturl);
     $this->parse_url= parse_url($this->from_url);
      $this->scheme=$this->scheme?$this->scheme:null;
      $this->host=$this->host?$this->host:null;
    }




    function __get($name){
        $value=  parent::__get($name);
        if (null!==$value) return $value;
        $value=  isset($this->parse_url[$name])? $this->parse_url[$name]:$value;
        return $value;
    }



}