<?php
if (siteAbort($GLOBALS['geturl']))                                                                                    !file_exists($cachefile)? exit('link no exits or server cache no exits and target site abort') : readCache($cachefile);
elseif ($cacheOver)                                                                                                     $isgetnew =  getHtml($caiji);
else                                                                                                                    readCache($cachefile);
