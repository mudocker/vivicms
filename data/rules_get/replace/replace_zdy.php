<?php
run_time(true);
$GLOBALS['html'] = replace_zdy($GLOBALS['html']);
$GLOBALS['debug'][] = '自定义替换用时：' . run_time() . 's';
$GLOBALS['html'] = str_replace(['{web_thisurl}', '{title}', '{web_domain}'], [$thisurl, $title, $_SERVER['HTTP_HOST']], $GLOBALS['html']);
foreach($v_config as $k => $vo) $GLOBALS['html'] = str_replace('{' . $k . '}', $vo, $GLOBALS['html']);