<?php
$from_url = $caiji_config['from_url'];
$isouturl = false;
if(isset($GLOBALS['geturl'])){
    $from_url = $GLOBALS['geturl'];
    $isouturl = true;
}
if($ac == 'yulan'){
    isset($_GET['url']) and  $caiji_config['from_url'] = $_GET['url'];
    $GLOBALS['geturl'] = $caiji_config['from_url'];
}
define('ISOUTURL', $isouturl);
$parse_url = parse_url($from_url);