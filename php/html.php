<?php
use md\inc\caiji;
require './vendor/autoload.php';
define('SCRIPT','html');
require(dirname(__FILE__)."/inc/common.inc.php");
$caiji = new caiji();
$v_config=require(VV_DATA."/config.php");
require(dirname(__FILE__)."/inc/robot.php");




require(VV_DATA."/rules.php");
?>