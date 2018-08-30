<?php
/**
 * Created by PhpStorm.
 * User: ACER-VERITON
 * Date: 2018/8/28
 * Time: 13:36
 */

namespace md\data\replace;


use md\data\BaseGlobal;

class HideJSError extends BaseGlobal
{

   function __construct()
    {
        if (!isCanReplaceHtml())return;
        if (!$this->caiji_config['hidejserror'])  return;
        $this->html = str_ireplace('<head>', '<head><script>var V_PATH="' . WEB_ROOT . '/' . '";window.onerror=function(){ return true; };</script>', $this->html);
    }

}