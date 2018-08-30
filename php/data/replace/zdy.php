<?php
/**
 * Created by PhpStorm.
 * User: ACER-VERITON
 * Date: 2018/8/28
 * Time: 11:40
 */

namespace md\data\replace;


use md\data\BaseGlobal;

class zdy extends BaseGlobal
{

     function __construct(){
         if (!isCanReplaceHtml())return;
         $zdy = array();
         if(empty($this->caiji_config['zdy']))return;
         $zdyzz= $this->caiji_config['zdy'];
             foreach($zdyzz as  $vo){
                $this->zero($zdy,$vo);
                 $this->one($zdy,$vo);
                 $this->two($zdy,$vo);
                 $this->replaceZdy($zdy,$vo);
             }

    }

    function replaceZdy(&$zdy,&$vo){
        $this->html = str_replace('{zdy.' . $vo['ename'] . '}', $zdy[$vo['ename']], $this->html);
    }

    function zero(&$zdy,&$vo){
       $vo['type'] == '0' and $zdy[$vo['ename']] = $vo['body'];
    }

    function one(&$zdy,&$vo){
        if($vo['type'] == '1') $vo['start'] && $vo['end'] and  $zdy[$vo['ename']] = strcut($vo['start'], $vo['end'], $this->html);
    }
    function two(&$zdy,&$vo){
        if($vo['type'] == '2') $vo['regx'] and $zdy[$vo['ename']] = regxcut($vo['regx'], $this->html);
    }
}
