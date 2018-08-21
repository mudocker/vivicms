<?php
$GLOBALS['debug'][] = '程序运行总共用时：' . round((debug_time() - RUN_TIME), 4) . 's';
$GLOBALS['debug'][] = '内存开销：' . ((memory_get_usage() - $GLOBALS['_start_memory']) / 1024) . ' kb';
$v_config['web_debug'] == "on" and  echo_debug($GLOBALS['debug']);