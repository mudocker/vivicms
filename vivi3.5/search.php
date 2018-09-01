<?php
define('SCRIPT', 'search');
require(dirname(__FILE__) . '/inc/common.inc.php');
$v_config = require(VV_DATA . '/config.php');
if(is_file(VV_INC . '/function_diy.php')){
    require(VV_INC . '/function_diy.php');
}
require(dirname(__FILE__) . '/inc/caiji.class.php');
require(dirname(__FILE__) . '/inc/robot.php');
require(VV_DATA . '/rules.php');
?>