<?php
$temp = array();
if(!empty($_POST)){
    foreach($_POST as $k => $vo){
        $k = convert_query($k, $charset);
        $temp[$k] = convert_query($vo, $charset);
    }
}
$_POST = $temp;
$temp =array();
foreach($_GET as $k => $vo){
    $k = convert_query($k, $charset);
    $temp[$k] = convert_query($vo, $charset);
}
$_GET = $temp;