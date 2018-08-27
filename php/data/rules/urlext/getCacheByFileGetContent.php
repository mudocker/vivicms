<?php
namespace md\data\rules\urlext;
use md\data\BaseGlobal;

class getCacheByFileGetContent extends BaseGlobal {

    /**
     * Content_type constructor.
     */
    public function __construct()
    {

       if (strpos($_SERVER['QUERY_STRING'], '..') !== false) return;
        if(!@is_file($this->cachefile)) return;
        if (!file_exists($this->cachefile)) return;
        $this->getfile = false;
        $this->image();
        $this->js();
        $this->css();
        $this->down();


    }

    function css(){
        $this->urlext == 'css' and $this->setContentType("text/css");
    }

    function js(){
        $this->urlext == 'js' and $this->setContentType("text/javascript");
    }
    function image(){
        isset($this->imgarr)&& in_array($this->urlext, $this->imgarr) and $this->setContentType("image/{$this->urlext}");
    }

    function setContentType($str){
        header("Content-type: {$str}");
        $this->getfile = true;
    }

    private function down()
    {
           if (!$this->getfile  )return;
           echo  @file_get_contents($this->cachefile);
           exit();

    }
}
