<?php
/**
 * Created by PhpStorm.
 * User: ACER-VERITON
 * Date: 2018/8/28
 * Time: 13:41
 */

namespace md\data\replace;


use md\data\BaseGlobal;

class replace_web_keywords extends BaseGlobal
{

     function __construct(){
         if (!isCanReplaceHtml())return;
        if(!$this->web_keywords)return;
        $this->html = preg_replace('#name\s*=\s*(["|\']*)keywords\\1\s*content=\s*(["|\']*)[^"\']+\\2#i', 'name="keywords" content="' . $this->web_keywords . '"', $this->html);


    }
    function __get($name)
    {
        $value=  parent::__get($name);
        (null===$value )and $value=isset( $this->v_config[$name])? $this->v_config[$name]:null;
        return $value;
    }

}