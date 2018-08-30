<?php
namespace md\data\rules\urlext;

use md\data\BaseGlobal;

class downCss extends BaseGlobal {

    private $css='csscache';
    public function __construct()
    {
        if($this->urlext != 'css') return;
        header("Content-type: text/css; charset=UTF-8");
        $this->getCacheFile();
        headerDownCss($this->css);
        setCacheOn($this->css);
    }



    function getCacheFile(){
        $this->cachetime = $this->v_config['csscachetime'];
        list($this->cacheid ,) = explode('?', $this->geturl);
        $this->cachefile    = getcsscachefile($this->cacheid);
    }
}
