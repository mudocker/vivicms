<?php
/**
 * Created by PhpStorm.
 * User: ACER-VERITON
 * Date: 2018/8/28
 * Time: 13:54
 */

namespace md\data\replace;


use md\data\BaseGlobal;

class keyword_inline extends BaseGlobal
{

    function __construct()
    {

        if (!$this->v_config['linkword_on'])return;
        if (!checktime_log_timeout())return;
         $link_config = @file_get_contents($this->linkwordfile);
         $this->link_word($link_config);


    }
    function link_word($link_config)
   {
       if(!$link_config)return;
       run_time(true);
       $this->html = link_word($this->html, $link_config);
       $this->debug[] = '关键词内链用时：' . run_time() . 's';
   }


}