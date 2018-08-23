<?php
preg_match('#<meta[^>]*charset\s*=\s*utf-8#iUs', $strhead) &&isset($GLOBALS['urlext']) and  $GLOBALS['urlext'] != 'js' and $caiji_config['charset'] = 'utf-8';

/*if((isset($GLOBALS['html'])&&isset($GLOBALS['urlext'])&&$GLOBALS['urlext'] == 'js' && preg_match('/[^\x00-\x80]/', $GLOBALS['html']) && is_utf8($GLOBALS['html'])) || ($GLOBALS['urlext'] != 'xml' && !ISOUTURL && is_utf8($GLOBALS['html']))){
  $GLOBALS['html'] =    PATH_SEPARATOR == ':' ? mb_convert_encoding($GLOBALS['html'], "utf-8", 'gbk'): iconv('gbk//IGNORE', "utf-8", $GLOBALS['html']);
}*/


if (isset($GLOBALS['html'])&&isset($GLOBALS['urlext'])&&!is_utf8($GLOBALS['html'])){
    $GLOBALS['html'] =    PATH_SEPARATOR == ':' ? mb_convert_encoding($GLOBALS['html'], "utf-8", 'gbk'): iconv('gbk', "utf-8", $GLOBALS['html']);
}