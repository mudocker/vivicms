<?php
$temp = [];
if(!empty($_POST)){
    foreach($_POST as $k => $vo){
        $k = convert_query($k, $charset);
        $temp[$k] = convert_query($vo, $charset);
    }
}
$_POST = $temp;
$temp = [];
foreach($_GET as $k => $vo){
    $k = convert_query($k, $charset);
    $temp[$k] = convert_query($vo, $charset);
}
$_GET = $temp;