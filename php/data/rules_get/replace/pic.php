<?php
foreach($allimg as $k => $vo){
    if(substr($vo, 0, 2) == '//'){
        if(preg_match('~^//[0-9a-zA-Z\.-]+\.[0-9a-zA-Z-]+/~', $vo)) $vo =  $_SERVER["REQUEST_SCHEME"]?  $_SERVER["REQUEST_SCHEME"] . ':'.$vo:$scheme . ':' . $vo;

        else $vo = substr($vo, 1);

    }
    if(isgoodurl($vo)){
        if(substr($vo, 0, 1) == '/')                                                                                    $vo = substr($vo, 1);
        else if(stripos($vo, '{') === false)                                                                           $vo = $urlpath . $vo;
        $newpic[] = get_showurl($vo, 'jpg');
    }else{
        is_resdomain($vo) and  $vo = WEB_ROOT . '/img.php?' . encode_source($collectid . '|' . $vo);
        $newpic[] = $vo;
    }
}
if($newpic) $GLOBALS['html'] = str_replace($allimg, $newpic, $GLOBALS['html']);

$GLOBALS['debug'][] = '替换所有图片链接用时：' . run_time() . 's';
run_time(true);
