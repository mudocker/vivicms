<?php
namespace md\data\rules\urlext;
use md\data\BaseGlobal;

class downloadJS extends BaseGlobal {

    private $css='jscache';





    function __construct(){
        if($this->urlext != 'js') return;
        $this->getCacheFile();
        headerDownCss($this->css);
        setCacheOn($this->css);
    }

    function getCacheFile(){
        header("Content-type: text/javascript");
        $this->cachetime = $this->v_config['jscachetime'];
        list($this->cacheid ,) = explode('?', $this->geturl);
        $this->cachefile    = getjscachefile($this->cacheid);
    }
}
