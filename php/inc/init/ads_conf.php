<?php
$adsfile = VV_DATA . "/ads.conf";
$config_ads = unserialize(file_get_contents($adsfile));
$config_ads2 = [];
if($config_ads) foreach($config_ads as $k => $vo) $config_ads2[$vo['mark']] = $vo['body'];