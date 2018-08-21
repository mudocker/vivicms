<?php
plus_run('before_convert_charset');
$GLOBALS['debug'][] = '使用缓存：否';
$GLOBALS['debug'][] = '采集用时：' . run_time() . 's';
$strhead = $caiji -> strcut('<head>', '</head>', $GLOBALS['html']);