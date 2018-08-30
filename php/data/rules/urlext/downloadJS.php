<?php
namespace md\data\rules\urlext;
use md\data\BaseGlobal;

class downloadJS extends BaseGlobal {

    private $css='jscache';





    function __construct(){
        if($this->urlext != 'js') return;
        header("Content-type: application/javascript; charset=UTF-8");
        $this->getCacheFile();
        headerDownCss($this->css);
        setCacheOn($this->css);
    }

    function getCacheFile(){

        $this->cachetime = $this->v_config['jscachetime'];
        list($this->cacheid ,) = explode('?', $this->geturl);
        $this->cachefile    = getjscachefile($this->cacheid);
    }
}
