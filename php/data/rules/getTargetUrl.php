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
        if (!isExt($this->urlext))return;
        $this->base64_decode($url);
        $this->isDomain($url);
        $this->local_link($url);
    }







    function base64_decode(&$url){
        $url= ltrim( $this->REDIRECT_URL,'/');
        $url=preg_replace('#(\.\w+)$#','',$url);
        $url=  $this->isBase64Encode($url)?  base64_decode($url):$this->REDIRECT_URL;
    }








    function isDomain($url){
        if (!isDomain($url)) return;
        if(isHttp($url) )return $this->geturl=$url;
        !preg_match('^:',$url) and $scheme=$this->scheme.':';
        $this->geturl=$scheme.$url;
        return  $this->geturl;

    }
    function local_link($url){
       if (isDomain($url))return;
        $this->geturl=  $this->geturl!=""? $this->geturl:$this->caiji_config['from_url'];
        $this->geturl=$this->geturl.$url;
    }




    function isBase64Encode($url){
         return $url == base64_encode(base64_decode($url));
    }


    function __get($name)
    {
        $value=  parent::__get($name);
        if(null!==$value )return $value;
        $value=isset($_SERVER[$name])?$_SERVER[$name]:null;
        return $value;
    }

}