<?php
plus_run('before_cache');
$openCacheAndTimeout=$v_config['cacheon'] && checktime_log_out_1h();
$openCacheAndTimeout and saveCache($cachefile);



