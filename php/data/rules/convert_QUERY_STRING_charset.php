<?php
list($_SERVER['QUERY_STRING'],) = explode('#', $_SERVER['QUERY_STRING']);
$_SERVER['QUERY_STRING'] = convert_query($_SERVER['QUERY_STRING'], $caiji_config['charset']);
$charset = (SCRIPT == 'search' && $caiji_config['search_charset'])?$caiji_config['search_charset']:$caiji_config['charset'];