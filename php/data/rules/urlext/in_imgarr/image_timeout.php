<?php
if($iscollect && (!$cachetime || !is_file($cachefile) || (@filemtime($cachefile) + ($cachetime * 3600)) <= time()))         {
    run_time(true);
    $str = $caiji -> geturl($GLOBALS['geturl']);
    $GLOBALS['debug'][] = '使用缓存：否';
    $GLOBALS['debug'][] = '采集用时：' . run_time() . 's';
    if($cachetime){
        if(!empty($str))                                                                                        write($cachefile, $str);
        else if(is_file($cachefile))                                                                            {   $str = file_get_contents($cachefile); write($cachefile, $str);  }
    }
}
else if(is_file($cachefile))                                                                                             {
    $GLOBALS['debug'][] = '使用缓存：是'; $GLOBALS['debug'][] = '缓存路径：' . $cachefile;$str = file_get_contents($cachefile);
}
echo $str;