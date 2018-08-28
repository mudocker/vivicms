<?php
/**
 * Created by PhpStorm.
 * User: ACER-VERITON
 * Date: 2018/8/28
 * Time: 13:40
 */

namespace md\data\replace;


use md\data\BaseGlobal;

class replace_style_by_caiji_config_css extends BaseGlobal
{

    function __construct()
    {
        if(!$this->css) return;
        $css = str_replace('{webpath}', WEB_ROOT . '/', $this->css);
        $this->html = str_ireplace('</head>', '<style>' . $css . '</style></head>', $this->html);
        $this->html = str_ireplace('</body>', '<style>' . $css . '</style></body>', $this->html);

    }

    function __get($name)
    {
        $value=  parent::__get($name);
        (null===$value )and $value=isset( $this->caiji_config[$name])? $this->caiji_config[$name]:null;
        return $value;
    }

}