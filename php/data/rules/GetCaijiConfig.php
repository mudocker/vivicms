<?php
namespace md\data\rules;

use md\data\BaseGlobal;

class GetCaijiConfig extends BaseGlobal {


     function __construct()
    {
        $collectid=&$this->collectid;
        $v_config=&  $this->v_config;
        $this->ac    = isset($_GET['ac'])?$_GET['ac']:'';
        $collectid = $v_config['collectid'];
        if( $this->ac == 'yulan'){
            $collectid = intval(@$_GET['collectid']);
            $v_config['cacheon'] = false;
        }else if($_COOKIE['collectid'] != ''){
            $collectid = intval($_COOKIE['collectid']);
            $v_config['cacheon'] = false;
        }

        $this->caiji_config  = require(VV_DATA . "/config/{$collectid}.php");
    }
}