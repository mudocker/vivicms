<?php
$ac = isset($_GET['ac'])?$_GET['ac']:'';
$collectid = $v_config['collectid'];
if($ac == 'yulan'){
    $collectid = intval(@$_GET['collectid']);
    $v_config['cacheon'] = false;
}else if($_COOKIE['collectid'] != ''){
    $collectid = intval($_COOKIE['collectid']);
    $v_config['cacheon'] = false;
}


$caiji_config = require(VV_DATA . "/config/{$collectid}.php");