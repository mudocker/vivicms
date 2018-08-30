<?php
/**
 * Created by PhpStorm.
 * User: ACER-VERITON
 * Date: 2018/8/28
 * Time: 9:32
 */

namespace md\data\replace;


use md\data\BaseGlobal;

class plug_before_convert_charset extends BaseGlobal
{


     function __construct($caiji){
         if (!isCanReplaceHtml())return;
         plus_run('before_convert_charset');
         $this->debug[] = '使用缓存：否';
         $this->debug[] = '采集用时：' . run_time() . 's';
         $this->strhead = $caiji ->strcut('<head>', '</head>', $GLOBALS['html']);
    }
}