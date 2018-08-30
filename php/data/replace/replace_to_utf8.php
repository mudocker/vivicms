<?php
/**
 * Created by PhpStorm.
 * User: ACER-VERITON
 * Date: 2018/8/28
 * Time: 9:35
 */

namespace md\data\replace;


use md\data\BaseGlobal;

class replace_to_utf8 extends BaseGlobal
{

     function __construct(){
     //     preg_match('#<meta[^>]*charset\s*=\s*utf-8#iUs', $strhead) &&isset($GLOBALS['urlext']) and  $GLOBALS['urlext'] != 'js' and $caiji_config['charset'] = 'utf-8';

    /*    if((isset($GLOBALS['html'])&&isset($GLOBALS['urlext'])&&$GLOBALS['urlext'] == 'js' && preg_match('/[^\x00-\x80]/', $GLOBALS['html']) && is_utf8($GLOBALS['html'])) || ($GLOBALS['urlext'] != 'xml' && !ISOUTURL && is_utf8($GLOBALS['html']))){
           $GLOBALS['html'] =    PATH_SEPARATOR == ':' ? mb_convert_encoding($GLOBALS['html'], "utf-8", 'gbk'): iconv('gbk//IGNORE', "utf-8", $GLOBALS['html']);
         }*/
         if (!isCanReplaceHtml())return;
         if ( $this->html=='') return;
         if (is_utf8($this->html))return;
         if ($this->urlext=='') return;
          htmlToUtf8();
    }


}