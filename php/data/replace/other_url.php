<?php
/**
 * Created by PhpStorm.
 * User: ACER-VERITON
 * Date: 2018/8/28
 * Time: 10:06
 */

namespace md\data\replace;


class other_url
{


     function __construct(){
         $this->html = str_ireplace(array($this->server_url, $server_url2), '', $this->html);

         if($caiji_config['other_url']){ //https
             $other_url = explode(',', $caiji_config['other_url']);
             foreach($other_url as $k => $vo) $this->html = str_ireplace(array('http://' . $vo, 'https://' . $vo, '//' . $vo), '', $this->html);
         }

         $this->html = preg_replace('~href=(["|\']*)//([0-9a-zA-Z\.-]+\.[0-9a-zA-Z-]+)~i', 'href=\\1' . $scheme . '://\\2', $this->html);

    }
}