<?php
namespace md\data\rules;

class headerContextType extends \md\data\BaseGlobal
{

    function __construct(){
        $this->explode();
        $this->header();
    }

    function explode(){
        $this->content_type!='' and   $content_type=explode(';',$this->content_type);
        $this->content_type= $content_type!=false?$content_type[0]:'';
    }
    function header(){
        $this->urlext=='html' and  header("Content-type: text/html; charset=UTF-8");
        $this->urlext!='html' and $this->content_type!='' and  header("Content-type: {$this->content_type}; charset=UTF-8");
    }
}