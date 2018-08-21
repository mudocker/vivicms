<?php
plus_run('before_cache');
if($v_config['cacheon'] && checktime_log_out_1h()){
    if(!empty($GLOBALS['html']))                                                                                     write($cachefile, $GLOBALS['html']);
    else if(is_file($cachefile))                                                                                    touch($cachefile, time() + 300);
}