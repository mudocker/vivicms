<?php
getIscollect($caiji_config,$cachefile,$iscollect);
$timeout=(@filemtime($cachefile) + ($cachetime * 3600)) <= time();

$cacheOver= $iscollect && (!is_file($cachefile) || $timeout);
if (siteAbort($GLOBALS['geturl']))                                                                                    !file_exists($cachefile)? exit('服务器缓存异常') : readCache($cachefile);
elseif ($cacheOver)                                                                                                     $isgetnew =  getHtml($caiji);
else                                                                                                                    readCache($cachefile);
