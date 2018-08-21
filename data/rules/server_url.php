<?php
$port = isset($parse_url['port'])?$parse_url['port']:'';
$server_url = $parse_url['scheme'] . '://' . $parse_url['host'];

$server_url2 = '//' . $parse_url['host'];
if($port){
    $server_url = $server_url . ':' . $port;
    $server_url2 = $server_url2 . ':' . $port;
}