<?php
namespace md\data\flow;
use md\data\BaseGlobal;

class getCacheFilenName extends BaseGlobal {

  
     function __construct()
    {


        if (!empty($this->QUERY_STRING) ) return;
        $this->cacheid = md5($this->geturl);
        $this->cachefile = getCachefile($this->cacheid,$this->urlext);
        $this->cachetime = $this->v_config['othercache'];

    }





   

    function __get($name)
    {
       $value=  parent::__get($name); 
        (null===$value )and $value=isset($_SERVER[$name])?$_SERVER[$name]:null;
       return $value;
    }


    function getCache(){
        $this->cacheid = md5($this->geturl);
        $this->cachefile = getHtmlCachefile($this->cacheid);
        $this->cachetime = $this->v_config['othercache'];
    }
}




