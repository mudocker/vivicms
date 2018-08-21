<?php
run_time(true);
$searchurl and $GLOBALS['geturl'] = $searchurl;
$GLOBALS['geturl'] = str_replace('%u', '%25u', $GLOBALS['geturl']);
$GLOBALS['geturl'] = str_replace([' ', '+'], '%20', $GLOBALS['geturl']);
$parse_url = parse_url($GLOBALS['geturl']);
$scheme = $parse_url['scheme'];
$thisurl = thisurl(); //‌/ybet_viviadmin/caiji_config.php?ac=yulan&collectid=1

$isgetnew = false;
$iscollect = true;
$GLOBALS['debug'][] = '目标url：' . $GLOBALS['geturl'];