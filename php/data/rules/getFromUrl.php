<?php
namespace md\data\rules;

use md\data\BaseGlobal;

class getFromUrl extends BaseGlobal {

    public function __construct()
    {
        $this->iniParam();
        $this->setFromUrl();
        $this->yulan_geturl();

    }
















    private $isouturl;

    function iniParam(){
        $this->isouturl = false;
        $this->from_url=$this->caiji_config['from_url'];
    }

    function setFromUrl(){
        if(!isset($this->geturl))return;
        $this->from_url= $this->geturl;
        $this->isouturl = true;
    }

    function yulan_geturl(){

        if($this->ac != 'yulan')return
        isset($_GET['url']) and   $this->caiji_config['from_url'] = $_GET['url'];
        $this->geturl =  $this->caiji_config['from_url'];
    }


}



