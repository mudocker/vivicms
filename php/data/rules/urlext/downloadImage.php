<?php
namespace md\data\rules\urlext;

use md\data\BaseGlobal;

class downloadImage extends BaseGlobal {
        private $css='imgcache';
     function __construct(){
       if (!isset($this->urlext) ||!in_array($this->urlext, $this->extarr))return;
        $isCahce= !$this->getIsCahche() and  $this->nohasCache($isCahce);
        setCacheOn($this->css);
    }
    function getIsCahche(){
        return $this->v_config[$this->css] || $this->caiji_config['collect_close'];
    }





    function nohasCache($isCahce){

        if(!$isCahce|| !checktime_log_timeout())  return;

        header("Content-Type: image/jpeg; charset=UTF-8");
        header("Location: {$this->geturl}");
        exit();

    }











}

