<?php
$zdy = $_POST['zdy'];
if($zdy){
    foreach($zdy as $k => $vo){
        foreach($vo as $kk => $vv){
            $zdy[$k][$kk] = utf2gbk(get_magic(trim($vv)));
            if(in_array($kk, array('name', 'ename')) && $zdy[$k][$kk] == '') unset($zdy[$k]);
        }
    }
}
$config['zdy'] = $zdy;
if($config['plus']) $config['plus'] = implode(',', $config['plus']);
else                 $config['plus'] = '';