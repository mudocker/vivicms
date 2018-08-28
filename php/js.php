<?php

use md\inc\caiji;
require './vendor/autoload.php';
define('SCRIPT','js');
require(dirname(__FILE__)."/inc/common.inc.php");
$caiji = new caiji();
$v_config=require(VV_DATA."/config.php");

require(dirname(__FILE__)."/inc/robot.php");


$collectid=(int)$v_config['collectid'];
!$collectid and  exit('err');

$caiji_config=require(VV_DATA."/config/{$collectid}.php");

require(VV_DATA."/rules.php");
?>