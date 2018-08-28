<?php require_once("data.php");
$v_config = require_once("../data/config.php");
require_once("checkAdmin.php");
 header("Cache-Control:no-stroe,no-cache,must-revalidate,post-check=0,pre-check=0");
require_once 'tmp_header.php';
echo ADMIN_HEAD;
?>
<body>
<?php 
echo 'disabled';
/*
$vv = $_GET['t'];
switch($vv){
case "updatenow":updatenow();
    break;
case "update":update($upname);
    break;
}
*/
?>