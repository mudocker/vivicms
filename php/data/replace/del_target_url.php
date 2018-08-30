<?php
/**
 * Created by PhpStorm.
 * User: ACER-VERITON
 * Date: 2018/8/28
 * Time: 10:06
 */

namespace md\data\replace;


use md\data\BaseGlobal;

class del_target_url extends BaseGlobal
{


     function __construct(){
         if (!isCanReplaceHtml())return;
         $this->delServerUrl();
        $this->delOtherUrl();
        $this->scheme();


    }

    function delOtherUrl(){
        if(!$this->caiji_config['other_url'])return;
         $this->other_url = explode(',', $this->caiji_config['other_url']);
         foreach($this->other_url as $k => $vo) $this->html = str_ireplace(array('http://' . $vo, 'https://' . $vo, '//' . $vo), '', $this->html);

    }


    function delServerUrl(){
        $this->html = str_ireplace(array($this->server_url, $this->server_url2), '', $this->html);
    }


    function scheme(){
        $this->html = preg_replace('~href=(["|\']*)//([0-9a-zA-Z\.-]+\.[0-9a-zA-Z-]+)~i', 'href=\\1' . $this->scheme . '://\\2', $this->html);
    }





}