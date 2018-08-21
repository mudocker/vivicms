<?php
$data_cache_file = VV_DATA . "/" . sha1_vxiaotou_com_php();
$vipcode = '';
is_file($data_cache_file) and  $vipcode = file_get_contents($data_cache_file);