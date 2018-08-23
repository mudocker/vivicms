<?php
foreach($allcss as $k => $vo){
    if(substr($vo, 0, 2) == '//'){
        if(preg_match('~^//[0-9a-zA-Z\.-]+\.[0-9a-zA-Z-]+/~', $vo)){
            if($_SERVER["REQUEST_SCHEME"])                                                                          $vo = $_SERVER["REQUEST_SCHEME"] . ':' . $vo;
            else                                                                                                         $vo = $scheme . ':' . $vo;

        }else $vo = substr($vo, 1);

    }
    if(isgoodurl($vo)){
        if(substr($vo, 0, 1) == '/')                             $vo = substr($vo, 1);
        else if(stripos($vo, '{') === false)                    $vo = $urlpath . $vo;

        if(in_array('localcss', $caiji_config['siftags'])){$newcss[] = 'none';continue;}
        $newcss[] = get_showurl($vo, 'css');
    }else{
        if(in_array('outcss', $caiji_config['siftags'])){   $newcss[] = 'none';  continue;}
        if(is_resdomain($vo))                                    $vo = WEB_ROOT . '/css.php?' . encode_source($collectid . '|' . $vo);
        $newcss[] = $vo;
    }
}
$newcss and $GLOBALS['html'] = str_replace($allcss, $newcss, $GLOBALS['html']);

$GLOBALS['debug'][] = '替换所有css链接用时：' . run_time() . 's';
run_time(true);