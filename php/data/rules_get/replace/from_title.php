<?php
$titlearr = explode('*', $caiji_config['from_title']);
foreach($titlearr as $k => $vo) $GLOBALS['html'] = str_ireplace($vo, $v_config['web_name'], $GLOBALS['html']);
