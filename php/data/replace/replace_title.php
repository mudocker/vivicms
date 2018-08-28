<?php
/**
 * Created by PhpStorm.
 * User: ACER-VERITON
 * Date: 2018/8/28
 * Time: 12:07
 */

namespace md\data\replace;


use md\data\BaseGlobal;

class replace_title extends BaseGlobal
{

    function __construct($caiji)
    {

            $this->title = $caiji ->strcut('<title>', '</title>', $this->html);
            foreach(array(' ', '|', '-', '_', ',')as $vo) $this->title = str_replace($vo . $this->web_name, '', $this->title);
            $this->title = trim(trim($this->title), '-');
            $this->title = trim($this->title);
            $this->debug[] = '获取当前title标题：' . $this->title;
            $title = $this->title;

    }

    function __get($name)
    {
        $value=  parent::__get($name);
        (null===$value )and $value=isset( $this->config_ads2[$name])? $this->config_ads2[$name]:null;
        return $value;
    }
}