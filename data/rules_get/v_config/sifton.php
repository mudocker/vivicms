<?php
if($v_config['sifton'] && checktime_log_out_1h()){
    $sifturl = explode('[cutline]', $v_config['sifturl']);
    foreach($sifturl as $k => $vo){
        if($vo == $GLOBALS['geturl']){
            header("location: {$v_config['web_url']}");
            exit();
        }
    }
}