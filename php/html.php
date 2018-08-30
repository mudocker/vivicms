<?php
use md\inc\caiji;
define('SCRIPT','html');
require './vendor/autoload.php';
$caiji = new caiji();
$v_config=require(VV_DATA."/config.php");
require(dirname(__FILE__)."/inc/robot.php");
getCollectidCaijiConfig($collectid,$caiji_config);
getUrl('htmldomain','other_url');
$GLOBALS['content_type']=='text/html';
require("rules.php");
?>