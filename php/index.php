<?php
use md\inc\caiji;
require './vendor/autoload.php';
define('SCRIPT','index');
$caiji = new caiji();
$v_config=require(VV_DATA."/config.php");
require(dirname(__FILE__)."/inc/robot.php");
getCollectidCaijiConfig($collectid,$caiji_config);
getUrl('htmldomain','from_url');
require("rules.php");
