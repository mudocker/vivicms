<?php

if($v_config['sifton'] && checktime_log_timeout()){
    $sifturl = explode('[cutline]', $v_config['sifturl']);
    foreach($sifturl as $k => $vo){
        if($vo == $GLOBALS['geturl']){
            header("location: {$v_config['my_url']}");
            exit();
        }
    }
}