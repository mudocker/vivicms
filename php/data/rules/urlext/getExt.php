<?php
namespace md\data\rules\urlext;
use md\data\BaseGlobal;

class getExt extends BaseGlobal {




    public function __construct()
    {
        $this->yulanGeturl();
        $this->getParaseUrl();
        $this->getUrlPath();
        $this->setExt();
    }










    function yulanGeturl(){
        $this->ac == 'yulan' and  $this->geturl = $this->from_url;
    }
    function getUrlPath(){
        $this->urlpath  = geturlpath(  $this->parse_url);
    }

    function getParaseUrl(){
        $this->parse_url    =  parse_url(SCRIPT == 'search'? $this->searchurl: $this->geturl);

    }
    function setExt(){

        if(stripos($_SERVER["HTTP_ACCEPT"], 'text/css') > -1)                                                       $this->urlext= 'css';
        else if(SCRIPT == 'css')                                                                                      $this->urlext= 'css';
        else if(SCRIPT == 'js')                                                                                       $this->urlext = 'js';
        else if(SCRIPT == 'html')                                                                                    $this->urlext = 'html';
        else if(SCRIPT == 'font')                                                                                    $this->urlext = 'ttf';
        else if(SCRIPT == 'index')                                                                                    $this->urlext = 'html';
        else                                                                                                            $this->urlext= strtolower(pathinfo($this->parse_url['path'], PATHINFO_EXTENSION));
         $this->image();

    }
    function image(){
       $imgarr= $this->imgarr= array('gif', 'jpg', 'jpeg', 'png', 'bmp', 'ico') ;
        SCRIPT == 'img' && !in_array( $this->urlext,$imgarr) and $this->urlext = 'jpg';
    }

}
