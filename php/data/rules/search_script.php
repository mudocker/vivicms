<?php
namespace md\data\rules;

use md\data\BaseGlobal;

class search_script extends BaseGlobal {

    /**
     * search_script constructor.
     */
    public function __construct()
    {

        $this->search();
        $this->geturl();
    }
    
    
    function search(){
        if(SCRIPT != 'search')return;

        $this->setSearchUrl();
        $this->setCacheid();
        $this->setCacheFileAndTime();


    }

    function setCacheFileAndTime(){
        $this->cachefile = getHtmlCachefile($this->cacheid);
        $this->cachetime = $this->v_config['othercache'];
    }
    function setCacheid(){
        $this->cacheid = md5(!empty($_POST)?$this->searchurl . http_build_query($_POST):$this->searchurl);
    }
    function setSearchUrl(){
        empty($_POST)? $this->post():$this->searchurl = $this->caiji_config['search_url'];
        substr($this->searchurl, 0, 7) != 'http://' && substr($this->searchurl, 0, 8) != 'https://' and  $this->searchurl = $this->server_url . '/' . ltrim($this->searchurl, '/');
    }
    function getSearchSign(){
       return stripos($this->caiji_config['search_url'], '?') > -1?'&':'?';
    }
    function post(){
        unset($_GET['action']);
        $getstr = http_build_query($_GET);
        $this->searchurl = $this->caiji_config['search_url'] . $this->getSearchSign() . $getstr;
    }

    
    function geturl(){

        $this->replaceGeturl();
        isScript($this->caiji_config,$this->v_config) and  $this->geturl = $this->server_url . '/?' . $this->QUERY_STRING;
        (stripos($this->geturl, '?') === false && stripos($this->geturl, '&') > -1)      and  $this->geturl = preg_replace('~\&~', '?', $this->geturl, 1);
    }


    function replaceGeturl(){
        $this->extarr = array('php', 'html', 'shtml', 'htm', 'jsp', 'xhtml', 'asp', 'aspx', 'txt', 'action', 'xml', 'css', 'js', 'gif', 'jpg', 'jpeg', 'png', 'bmp', 'ico', 'swf');
        foreach( $this->extarr as $vo) $this->geturl = str_replace('.' . $vo . '&', '.' . $vo . '?', $this->geturl);
    }


    function __get($name)
    {
        $value=  parent::__get($name);
        (null===$value )and $value=isset($_SERVER[$name])?$_SERVER[$name]:null;
        return $value;
    }
}





