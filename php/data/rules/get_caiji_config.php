<?php
namespace md\data\rules;

use md\data\BaseGlobal;

class get_caiji_config extends BaseGlobal {


     function __construct()
    {


        $this->collectid =  $this->v_config['collectid'];
        $this->yulanCollectid();
        $this->getCollectidFromCookie();
     empty($this->caiji_config ) and    $this->caiji_config  = require(VV_CONFIG . "/{$this->collectid}.php");
    }

    function getCollectidFromCookie(){
        if($_COOKIE['collectid'] == '')return;
        $this->collectid = intval($_COOKIE['collectid']);
        $this->v_config['cacheon'] = false;
    }
    function yulanCollectid(){
        $this->ac    = isset($_GET['ac'])?$_GET['ac']:'';
        if( $this->ac != 'yulan')return;
        $this->collectid = intval(@$_GET['collectid']);
        $this->v_config['cacheon'] = false;
    }



}