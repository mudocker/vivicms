<?php
use md\inc\caiji;
require './vendor/autoload.php';
define('SCRIPT','font');
$caiji = new caiji();
$v_config=require(VV_DATA."/config.php");
require(VV_INC."/robot.php");
getCollectidCaijiConfig($collectid,$caiji_config);
getUrl('fontdomain');
require("rules.php");