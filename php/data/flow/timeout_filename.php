<?php
function getCacheOver(&$cacheOver, &$iscollect, $caiji_config, $cachefile, $cachetime){
    getIscollect($caiji_config,$cachefile,$iscollect);
    $filetimeOver=(@filemtime($cachefile) + ($cachetime * 3600)) <= time();
    $cacheOver= $iscollect && (!is_file($cachefile) || $filetimeOver);
}



getCacheOver($cacheOver, $iscollect, $caiji_config, $cachefile, $cachetime);