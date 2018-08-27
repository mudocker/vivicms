<?php


plus_run('before_cache');

$openCacheAndTimeout=$v_config['cacheon'] && checktime_log_timeout();
$openCacheAndTimeout and fSaveCache($cachefile);



