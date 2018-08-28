<?php
/**
 * Created by PhpStorm.
 * User: ACER-VERITON
 * Date: 2018/8/28
 * Time: 11:32
 */

namespace md\data\replace;


use md\data\BaseGlobal;

class call_replace_zdy extends BaseGlobal
{

     function __construct(){
         run_time(true);
         $this->callReplaceZdy();
        $this->replaceTittle();
         $this->replaceVConfig();
    }

    function replaceTittle(){
        $this->html = str_replace(array('{web_thisurl}', '{title}', '{web_domain}'), array($this->thisurl, $this->title, $_SERVER['HTTP_HOST']), $this->html);
    }

    function callReplaceZdy(){
        $this->html = replace_zdy($this->html);
        $this->debug[] = '自定义替换用时：' . run_time() . 's';
    }
    function replaceVConfig(){
        foreach($this->v_config as $k => $vo) $this->html = str_replace('{' . $k . '}', $vo, $this->html);
    }
}