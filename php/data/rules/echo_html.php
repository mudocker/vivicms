<?php
namespace md\data\rules;
use md\data\BaseGlobal;

class echo_html extends BaseGlobal {

    /**
     * echo_html constructor.
     */
    public function __construct()
    {
       //     $this->image();

            $this->html();
         //   HeaderCharset($this->html);
            echo($this->html==''?$this->geturl:$this->html);
            exit();
    }

    function noHtml(&$isHtml=true){
        if(!isset($this->urlext))$isHtml=false;
        if(!in_array($this->urlext, $this->extarr))$isHtml=false;
        if(stripos($this->html, '<head>') ==false)$isHtml=false;
        if(stripos($this->html, '<html>') ==false)$isHtml=false;
        if(stripos($this->html, '<body>') ==false)$isHtml=false;
    }
    function html(){

        $this->noHtml($isHtml);
        if (!$isHtml)return;
        header("Content-Type:text/html; charset=UTF-8");
        include($this->cachefile);
        exit();
    }
    function image(){
        if (!isset($this->urlext) || ($this->urlext != 'css' && $this->urlext != 'js')) return;
        substr($this->html, 0, 1) == '?' and $this->html = substr($this->html, 1);

        echo $this->html;
        exit();
    }


    function debug(){
        if ($this->v_config['web_debug'] == "on") echo("/*start---\r\n" . implode("\r\n", $this->debug) . "\r\nend---*/\r\n");
    }

}





