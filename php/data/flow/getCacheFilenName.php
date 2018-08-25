<?php
namespace md\data\flow;
class getCacheFilenName{

    /**
     * getCacheFilenName constructor.
     */
    public function __construct()
    {

        $this->getCacheFromIndex();
        $this->getCacheAbout();
    }

    function getCacheFromIndex(){
        if (!empty($_SERVER['QUERY_STRING']) ) return;
        $GLOBALS['cachefile'] = VV_CACHE . '/index.html';
        $GLOBALS['cachetime'] = $GLOBALS['v_config']['indexcache'];
        $GLOBALS['geturl'] = $GLOBALS['from_url'];
    }

    function getCacheAbout(){
        if (empty($_SERVER['QUERY_STRING']))return;
        delSlash();
        if(isset($_SERVER["PATH_INFO"])&&$_SERVER["PATH_INFO"])                                                         getUrlWithIndexPhp($GLOBALS['server_url']);
        else if(!isset($GLOBALS['geturl']))                                                                               getUrlNoIndexPhp($GLOBALS['server_url']);
        $this->getCache();
    }


    function getCache(){
        $GLOBALS['cacheid'] = md5($GLOBALS['geturl']);
        $GLOBALS['cachefile'] = getcachefile($GLOBALS['cacheid']);
        $GLOBALS['cachetime'] = $GLOBALS['v_config']['othercache'];
    }
}




