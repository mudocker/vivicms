<?php
use md\inc\caiji;
require './vendor/autoload.php';
define('SCRIPT','css');
$caiji = new caiji();
$v_config=require VV_DATA."/config.php";
require(VV_INC."/robot.php");
getCollectidCaijiConfig($collectid,$caiji_config);
getUrl('cssdomain');
$GLOBALS['content_type']=='text/css';
require("rules.php");
?>