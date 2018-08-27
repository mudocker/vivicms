<?php
/**
 * Created by PhpStorm.
 * User: ACER-VERITON
 * Date: 2018/8/26
 * Time: 23:40
 */

namespace md\data\rules;


use md\data\BaseGlobal;

class getTargetUrl extends BaseGlobal
{
     function __construct()
    {
        if ($this->urlext!='js'&& $this->urlext!='css'&& $this->urlext!='html'&&$this->urlext!='jpg')return;
       $this->geturl= $this->resdomain();
    }

    private function resdomain()
    {
     return   rtrim($this->caiji_config['resdomain'],'/').$this->REDIRECT_URL;
    }


    function __get($name)
    {
        $value=  parent::__get($name);
        (null===$value )and $value=isset($_SERVER[$name])?$_SERVER[$name]:null;
        return $value;
    }

}