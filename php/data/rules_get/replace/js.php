<?php
foreach($alljs as $k => $vo){
    if(substr($vo, 0, 2) == '//'){
        if(preg_match('~^//[0-9a-zA-Z\.-]+\.[0-9a-zA-Z-]+/~', $vo))                                               $vo =   $_SERVER["REQUEST_SCHEME"]? $_SERVER["REQUEST_SCHEME"] . ':' . $vo: $scheme . ':' . $vo;
        else                                                                                                            $vo = substr($vo, 1);
    }
    if(isgoodurl($vo)){
        if(substr($vo, 0, 1) == '/')                                                                                    $vo = substr($vo, 1);
        else if(stripos($vo, '{') === false)                                                                          $vo = $urlpath . $vo;
        if(in_array('localjs', $caiji_config['siftags']))                                                            {$newjs[] = 'none';continue;}
        $newjs[] = get_showurl($vo, 'js');
    }else{
        if(in_array('outjs', $caiji_config['siftags']))                                                               { $newjs[] = 'none'; continue;}
        is_resdomain($vo) and  $vo = WEB_ROOT . '/js.php?' . encode_source($collectid . '|' . $vo);
        $newjs[] = $vo;
    }
}
if($newjs) $GLOBALS['html'] = str_replace($alljs, $newjs, $GLOBALS['html']);

$GLOBALS['debug'][] = '替换所有JS链接用时：' . run_time() . 's';
run_time(true);