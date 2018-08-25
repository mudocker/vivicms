<?php

$file = VV_DATA . '/config/' . $id . '.php';
if(is_file($file)){
    $caiji_config = require_once($file);
    $config = array_merge($caiji_config, $config);
}
$config = array_merge($config, array('siftags' => @$_POST['siftags'], 'time' => time()));