<?php
namespace md;
use md\data\flow\getCacheFilenName;
use md\data\rules\convert_param_charset;
use md\data\rules\getFromUrl;
use md\data\rules\getTargetUrl;
use md\data\rules\search_script;
use md\data\rules\setCharset;
use md\data\rules\getImgDomain;
use md\data\rules\get_caiji_config;
use md\data\rules\plus_run_before_get;
use md\data\rules\getTargetRootUrl;
use md\data\rules\encodeQS;
use md\data\rules\urlext\getCacheByFileGetContent;
use md\data\rules\urlext\getExt;
use md\data\rules\defineWebRootAndSign;
use md\inc\delcache;

class getConfig
{
    public function __construct()
    {
        new delcache();                                                                                                              //无
        new get_caiji_config();                                                                                                //无
        new encodeQS();                                                                                                      //无
        new setCharset();                                                                                                        //无
        new convert_param_charset();                                                                                             //无
        new getImgDomain();                                                                                                     //无
        new getFromUrl();
        new getTargetRootUrl();
        new defineWebRootAndSign();
        new getExt();
        new getTargetUrl();
        new getCacheFilenName();
        new search_script();


        new getCacheByFileGetContent();
        new plus_run_before_get();
    }


}
