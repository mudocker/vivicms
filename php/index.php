<?php

use md\inc\caiji;
require './vendor/autoload.php';
define('SCRIPT','index');
require(dirname(__FILE__)."/inc/common.inc.php");
$v_config = require(VV_DATA . "/config.php");
is_file(VV_INC.'/function_diy.php') and  require(VV_INC.'/function_diy.php');
$caiji = new caiji();
require(dirname(__FILE__)."/inc/robot.php");
require(VV_DATA."/rules.php");
