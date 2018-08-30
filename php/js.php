<?php

use md\inc\caiji;
require './vendor/autoload.php';
define('SCRIPT','js');
$caiji = new caiji();
$v_config=require(VV_DATA."/config.php");
require(dirname(__FILE__)."/inc/robot.php");
getCollectidCaijiConfig($collectid,$caiji_config);
getUrl('jsdomain');
$GLOBALS['content_type']=='text/javascript';
require("rules.php");
?>