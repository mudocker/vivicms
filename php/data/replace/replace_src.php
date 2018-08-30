<?php
/**
 * Created by PhpStorm.
 * User: ACER-VERITON
 * Date: 2018/8/30
 * Time: 16:34
 */

namespace md\data\replace;


use md\data\BaseGlobal;

class replace_src extends BaseGlobal
{

    function __construct(){
        if (!isset($this->caiji_config['img_delay_name']))return;
        if ($this->caiji_config['img_delay_name']=='')return;
        $data = explode(',', $this->caiji_config['img_delay_name']);
        foreach ($data as $v) $this->html=str_replace($v,'src',$this->html);
    }



}