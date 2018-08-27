<?php
namespace md\data\rules;
use md\data\BaseGlobal;


class getImgDomain  {


    public function __construct()
    {


        $this->resdomain = $this->resdomain?$this->resdomain:$this->other_imgurl;
    }






    function __set($name, $value){
        $GLOBALS['caiji_config'][$name]=$value;
    }


    function __get($name){
        return isset($GLOBALS['caiji_config'][$name])?$GLOBALS['caiji_config'][$name]:null;
    }
}


