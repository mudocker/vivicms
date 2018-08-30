<?php
/**
 * Created by PhpStorm.
 * User: ACER-VERITON
 * Date: 2018/8/28
 * Time: 13:36
 */

namespace md\data\replace;


use md\data\BaseGlobal;

class no_site_app extends BaseGlobal
{

   function __construct(){
       if (!isCanReplaceHtml())return;
        if(!$this->caiji_config['no_siteapp'])return;
        $this->html = str_ireplace('<head>', '<head><meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" />', $this->html);

    }

}