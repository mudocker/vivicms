<?php
$GLOBALS['debug'][] = '���������ܹ���ʱ��' . round((debug_time() - RUN_TIME), 4) . 's';
$GLOBALS['debug'][] = '�ڴ濪����' . ((memory_get_usage() - $GLOBALS['_start_memory']) / 1024) . ' kb';
$v_config['web_debug'] == "on" and  echo_debug($GLOBALS['debug']);