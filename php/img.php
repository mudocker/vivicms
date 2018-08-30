<?php
use md\inc\caiji;
require './vendor/autoload.php';
define('SCRIPT','img');
$caiji = new caiji();
$v_config=require(VV_DATA."/config.php");
require (VV_INC."/robot.php");
getCollectidCaijiConfig($collectid,$caiji_config);
getUrl('imgdomain','other_imgurl');
require("rules.php");