<?php
$ac == 'yulan' and  $GLOBALS['geturl'] = $from_url;
$parse_url =  SCRIPT == 'search'?parse_url($searchurl): $parse_url = parse_url($GLOBALS['geturl']);
$urlpathinfo = pathinfo($parse_url['path']);
$urldirname = $urlpathinfo['dirname'];
$urlbasename = $urlpathinfo['basename'];
$urlpath = geturlpath($parse_url);
if(stripos($_SERVER["HTTP_ACCEPT"], 'text/css') > -1)                                                               $GLOBALS['urlext'] = 'css';
else if(SCRIPT == 'css')                                                                                              $GLOBALS['urlext'] = 'css';
else if(SCRIPT == 'js')                                                                                               $GLOBALS['urlext'] = 'js';
else                                                                                                                    $GLOBALS['urlext'] = strtolower(pathinfo($parse_url['path'], PATHINFO_EXTENSION));
$imgarr = ['gif', 'jpg', 'jpeg', 'png', 'bmp', 'ico'];
SCRIPT == 'img' && !in_array($GLOBALS['urlext'], $imgarr) and  $GLOBALS['urlext'] = 'jpg';