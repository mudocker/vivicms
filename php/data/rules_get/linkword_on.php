<?php
if($v_config['linkword_on'] && checktime_log_timeout()){
    $link_config = @file_get_contents($linkwordfile);
    if($link_config){
        run_time(true);
        $GLOBALS['html'] = link_word($GLOBALS['html'], $link_config);
        $GLOBALS['debug'][] = '关键词内链用时：' . run_time() . 's';
    }
}