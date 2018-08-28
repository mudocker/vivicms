<?php
/**
 * Created by PhpStorm.
 * User: ACER-VERITON
 * Date: 2018/8/28
 * Time: 9:41
 */

namespace md\data\replace;


use md\data\BaseGlobal;

class replace_before_on extends BaseGlobal
{

    function __construct()
    {
         plus_run('source');
        if(!$this->caiji_config['replace_before_on'])return;
         run_time(true);
         $this->html = replace_before($this->html);
         $this->debug[] = '前置替换：' . run_time() . 's';
    }
}