<?php
/**
 * Created by PhpStorm.
 * User: ACER-VERITON
 * Date: 2018/8/28
 * Time: 13:45
 */

namespace md\data\replace;


use md\data\BaseGlobal;

class replace_web_seo_name extends BaseGlobal
{

    function __construct(){
        if (!isCanReplaceHtml())return;
        if(!$this->web_seo_name)return;
        $this->html = preg_replace('#<title>(.*)</title>#i', '<title>' . $this->web_seo_name . '</title>', $this->html);
    }
    function __get($name)
    {
        $value=  parent::__get($name);
        (null===$value )and $value=isset( $this->v_config[$name])? $this->v_config[$name]:null;
        return $value;
    }
}