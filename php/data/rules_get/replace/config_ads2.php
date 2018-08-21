<?php
if($config_ads2) foreach($config_ads2 as $k => $vo) $GLOBALS['html'] = str_ireplace('{ad.' . $k . '}', $vo, $GLOBALS['html']);

$config_ads2['top'] and  $topad = '<p align=center>' . $config_ads2['top'] . '</p>';

$config_ads2['bottom'] and  $bottomad = '<p align=center>' . $config_ads2['bottom'] . '</p>';