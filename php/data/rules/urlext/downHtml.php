<?php
/**
 * Created by PhpStorm.
 * User: ACER-VERITON
 * Date: 2018/8/27
 * Time: 10:00
 */

namespace md\data\rules\urlext;


use md\data\BaseGlobal;

class downHtml extends BaseGlobal
{

    /**
     * css constructor.
     */
    public function __construct()
    {

        if($this->urlext != 'html') return;
        header("Content-type: text/html");
        $this->getCacheFile();
        $this->headerHtml();
        $this->setCacheOn();


    }

    function setCacheOn(){
        $this->v_config['cacheon'] = $this->v_config['othercache'];
    }
    function headerHtml(){
        if($this->v_config['othercache']) return;
        header("Location: {$this->geturl}");
        exit;

    }
    function getCacheFile(){
        $this->cacheid = md5($this->geturl);
        $this->cachefile = getHtmlCachefile($this->cacheid);
        $this->cachetime = $this->v_config['othercache'];
    }
}