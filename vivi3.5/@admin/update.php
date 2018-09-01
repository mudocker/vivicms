<?php
header('Cache-Control:no-stroe,no-cache,must-revalidate,post-check=0,pre-check=0');
require_once('data.php');
$v_config = require_once('../data/config.php');
require_once('checkAdmin.php');
echo ADMIN_HEAD; ;
echo '<body>' . "\r\n";
$var_48 = $_GET["t"];
switch($var_48){
case 'updatenow': updatenow();
    break;
case 'update': update($var_97);
    break;
}
?>