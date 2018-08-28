<?php
/**
 * Created by PhpStorm.
 * User: ACER-VERITON
 * Date: 2018/8/28
 * Time: 11:50
 */

namespace md\data\replace;


use md\data\BaseGlobal;

class config_ads2 extends BaseGlobal
{

  function __construct(){
      $this->replaceAd();
      $this->getTopad();
      $this->getBottomAd();
        $this->replaceTopBottomAd();
    }

    function replaceTopBottomAd(){
        $this->html = preg_replace('~<(body[^>]*)>~i', '<\\1>' . $this->topad, $this->html, 1);
        $this->html = preg_replace('~</body>~i', '<div style="text-align:center;">' . $this->v_config['web_tongji'] . $this->bottomad . '</div></body>', $this->html, 1);
    }

    function replaceAd(){
        if($this->config_ads2) foreach($this->config_ads2 as $k => $vo) $this->html = str_ireplace('{ad.' . $k . '}', $vo, $this->html);
    }
    function getTopad(){
        $this->top and  $this->topad = '<p align=center>' . $this->top  . '</p>';
    }

    function getBottomAd(){
        $this->bottom and  $this->bottomad = '<p align=center>' . $this->bottom . '</p>';
    }
    function __get($name)
    {
        $value=  parent::__get($name);
        (null===$value )and $value=isset( $this->config_ads2[$name])? $this->config_ads2[$name]:null;
        return $value;
    }



}