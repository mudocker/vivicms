<?php
preg_match('#<meta[^>]*charset\s*=\s*utf-8#iUs', $strhead) && $GLOBALS['urlext'] != 'js' and $caiji_config['charset'] = 'utf-8';

if(($GLOBALS['urlext'] == 'js' && preg_match('/[^\x00-\x80]/', $GLOBALS['html']) && is_utf8($GLOBALS['html'])) || ($GLOBALS['urlext'] != 'xml' && !ISOUTURL && is_utf8($GLOBALS['html']))){
//    $GLOBALS['html'] =    PATH_SEPARATOR == ':' ? mb_convert_encoding($GLOBALS['html'], "gbk", 'utf-8'): iconv('utf-8', "gbk//IGNORE", $GLOBALS['html']);
}