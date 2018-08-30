<?php
/**
 * Created by PhpStorm.
 * User: ACER-VERITON
 * Date: 2018/8/28
 * Time: 13:47
 */

namespace md\data\replace;


use md\data\BaseGlobal;

class replace_flinks extends BaseGlobal
{

   function __construct(){
       //   if(!empty($_SERVER['QUERY_STRING']))return;

       if (!isCanReplaceHtml())return;
       is_file(VV_CONF . '/flink.conf') and  $flinks = file_get_contents(VV_CONF . '/flink.conf');

        $this->add_flinks($flinks);

       $this->html = str_ireplace('{flinks}', $flinks, $this->html);
       $this->html = preg_replace('~=(["\']*)//(\w+)/~i', '=\\1/\\2/', $this->html);

    }

    function add_flinks(&$flinks){
        if(!$flinks)return
          $flinks = str_ireplace(array("\r\n", "\r", "\n"), '&nbsp;&nbsp;', $flinks);
         $this->flinks_auto_insert != 2 and  $this->html = str_ireplace('</body>', '<div style="text-align:center;">' . $flinks . '</div></body>', $this->html);

    }


    function __get($name)
    {
        $value=  parent::__get($name);
        (null===$value )and $value=isset( $this->v_config[$name])? $this->v_config[$name]:null;
        return $value;
    }

}