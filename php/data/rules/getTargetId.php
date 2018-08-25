<?php
namespace md\data\rules;

class getTargetId{


     function __construct()
    {
        $collectid=&$GLOBALS['collectid'];
        $v_config=&  $GLOBALS['v_config'];
        $GLOBALS['ac']      = isset($_GET['ac'])?$_GET['ac']:'';
        $collectid = $v_config['collectid'];
        if(  $GLOBALS['ac']  == 'yulan'){
            $collectid = intval(@$_GET['collectid']);
            $v_config['cacheon'] = false;
        }else if($_COOKIE['collectid'] != ''){
            $collectid = intval($_COOKIE['collectid']);
            $v_config['cacheon'] = false;
        }

        $GLOBALS['caiji_config']   = require(VV_DATA . "/config/{$collectid}.php");
    }
}