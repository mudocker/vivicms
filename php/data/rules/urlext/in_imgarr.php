<?php
if(isset($GLOBALS['urlext'])&&in_array($GLOBALS['urlext'], $imgarr)){
    if(($v_config['imgcache'] || $caiji_config['collect_close']) && checktime_log_out_1h()){
        if($v_config['sifton']){
            $sifturl = explode('[cutline]', $v_config['sifturl']);
            foreach($sifturl as $k => $vo)                                                                               if($vo == $GLOBALS['geturl'])  {header("Content-type: image/png");exit();}
        }
        $cachetime = $v_config['imgcachetime'];
        $extarr = array_merge($extarr, $imgarr);
        @$_GET['debug'] != 'true'? header("Content-type: image/{$GLOBALS['urlext']}"): $GLOBALS['geturl'] = str_replace('?debug=true', '', $GLOBALS['geturl']);
        $iscollect = true;
       $caiji_config['collect_close']                                                                                 and   is_file($cachefile)? $iscollect = false: exit('not file');
        require_once (VV_DATA.'./rules/urlext/in_imgarr/image_timeout.php');
        require_once (VV_DATA.'./rules/urlext/in_imgarr/web_debug.php');

    }else{
        header("Content-Type: image/jpeg; charset=UTF-8");
        header("Location: {$GLOBALS['geturl']}");
        exit;
    }
}