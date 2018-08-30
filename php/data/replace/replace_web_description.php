<?php
/**
 * Created by PhpStorm.
 * User: ACER-VERITON
 * Date: 2018/8/28
 * Time: 13:45
 */

namespace md\data\replace;


use md\data\BaseGlobal;

class replace_web_description extends BaseGlobal
{

    function __construct(){
        if (!isCanReplaceHtml())return;
        if(!$this->web_description)return;
        $this->html = preg_replace('#name\s*=\s*(["|\']*)description\\1\s*content=\s*(["|\']*)[^"\']+\\2#i', 'name="description" content="' . $this->web_description . '"', $this->html);

    }

    function __get($name){
        $value=  parent::__get($name);
      if(null!==$value)return;
      $value=isset( $this->v_config[$name])? $this->v_config[$name]:null;
        return $value;
    }
}