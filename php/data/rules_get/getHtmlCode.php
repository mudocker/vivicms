<?php
if(($v_config['cacheon'] || $caiji_config['collect_close']) && checktime_log_out_1h()){
    $caiji_config['collect_close'] and  is_file($cachefile)? $iscollect = false:exit('not file');
    if($iscollect && (!is_file($cachefile) || (@filemtime($cachefile) + ($cachetime * 3600)) <= time())){     //TODO 超时重新获取
        run_time(true);
        $GLOBALS['html'] = $caiji -> post($GLOBALS['geturl'], $_POST);
        $isgetnew = true;
    }else{
        //TODO    读缓存
        $GLOBALS['html'] = file_get_contents($cachefile);
        $GLOBALS['debug'][] = '使用缓存：是';
        $GLOBALS['debug'][] = '缓存路径：' . $cachefile;
    }
}else{
    run_time(true);
    $GLOBALS['html'] = $caiji -> post($GLOBALS['geturl'], $_POST);
    $isgetnew = true;
}