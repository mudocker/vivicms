<?php
define('MEMORY_LIMIT_ON', function_exists('memory_get_usage'));
if(MEMORY_LIMIT_ON)$GLOBALS['_start_memory'] = memory_get_usage();