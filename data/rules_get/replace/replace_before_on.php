<?php
plus_run('source');
if($caiji_config['replace_before_on']){
    run_time(true);
    $GLOBALS['html'] = replace_before($GLOBALS['html']);
    $GLOBALS['debug'][] = '前置替换：' . run_time() . 's';
}
