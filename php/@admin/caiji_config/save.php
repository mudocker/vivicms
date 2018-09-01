<?php
if($ac == 'save'){
    $config = $_POST['con'];
    foreach($config as $k => $vo){
        if(is_array($config[$k]))       foreach($config[$k]as $kk => $vv) $config[$k][$kk] = to_utf8(get_magic(trim($vv)));
       else                             $config[$k] = to_utf8(get_magic(trim($config[$k])));
    }
    require_once("zdy_and_plug.php");

    require_once("siftrules_before.php");
    require_once("getConfig.php");
    require_once("saveConfigRet.php");
}