<?php
namespace md\data\rules;
class echo_html{

    /**
     * echo_html constructor.
     */
    public function __construct()
    {
            $this->image();
            $this->html();
            getCharsetAndHeader($GLOBALS['html']);
            echo $GLOBALS['html'];
    }


    function html(){
        $_G=& $GLOBALS;
        if(!isset($_G['urlext']))return;
        if(!in_array($_G['urlext'], $_G['extarr']))return;
        if(stripos($_G['html'], '<head>') ==false)return;
        if(stripos($_G['html'], '<html>') ==false)return;
        if(stripos($_G['html'], '<body>') ==false)return;
        require_once (DRULES.'result/debug.php');
        require_once (DRULES.'result/getTplPath.php');
        require_once (DRULES.'result/vxiaotou_link.php');
        getCharsetAndHeader($_G['html']);
        include($_G['tplfile']);
        exit();
    }
    function image(){
        $_G =& $GLOBALS;
        if (!isset($_G['urlext']) || ($_G['urlext'] != 'css' && $_G['urlext'] != 'js')) return;
        substr($_G['html'], 0, 1) == '?' and $_G['html'] = substr($_G['html'], 1);
        getCharsetAndHeader($_G['html']);
        if ($_G['v_config']['web_debug'] == "on") echo("/*start---\r\n" . implode("\r\n", $_G['debug']) . "\r\nend---*/\r\n");
        exit($_G['html']);
    }


}





