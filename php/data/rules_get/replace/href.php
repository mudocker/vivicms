<?php
if (!isCanReplaceHtml())return;
sort($allhref);
foreach($allhref as $k => $vo){
    if(strlen($vo) <= 1 || stripos($vo, 'javascript:') > -1)                                                      continue;

    $oldurl = $vo;
    if(substr($vo, 0, 2) == '//'){
        if(preg_match('~^//[0-9a-zA-Z\.-]+\.[0-9a-zA-Z-]+/~', $vo))                                           $vo =  $_SERVER["REQUEST_SCHEME"]? $_SERVER["REQUEST_SCHEME"] . ':' . $vo: $scheme . ':' . $vo;
        else                                                                                                        $vo = substr($vo, 1);

    }
    if(isgoodurl($vo)){
        if(in_array('locala', $caiji_config['siftags']))                                                          { $GLOBALS['html'] = preg_replace("~<a[^>]+href\s*=\s*([\"|']?){$vo}\\1[^>]+>(.*)</a>~i", '\\1', $GLOBALS['html']);  continue;}
        if(substr($vo, 0, 1) == '/')                                                                                 $vo = substr($vo, 1);
        else if(stripos($vo, '{') === false)                                                                       $vo = $urlpath . $vo;
        if(SCRIPT == 'search' && substr($vo, 0, 1) == '?')                                                        continue;
        $newurl = get_showurl($vo, $v_config['web_urlencode_suffix']);
        strpos($GLOBALS['html'], '"' . $oldurl . '"') > -1                                                        and  $GLOBALS['html'] = str_replace('"' . $oldurl . '"', '"' . $newurl . '"', $GLOBALS['html']);
        strpos($GLOBALS['html'], 'href=' . $oldurl) > -1                                                          and  $GLOBALS['html'] = str_replace('href=' . $oldurl, 'href=' . $newurl, $GLOBALS['html']);
    }else{
        if(!preg_match('~^(magnet|thunder|ftp)~i', $vo) && in_array('outa', $caiji_config['siftags'])) $GLOBALS['html'] = str_replace('"' . $oldurl . '"', '"none"', $GLOBALS['html']);
    }
}
$GLOBALS['debug'][] = '替换所有超链接用时：' . run_time() . 's';