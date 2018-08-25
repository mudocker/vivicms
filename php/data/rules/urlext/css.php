<?php
namespace md\data\rules\urlext;

class css{

    /**
     * css constructor.
     */
    public function __construct()
    {


        if($GLOBALS['urlext'] != 'css') return;

        $v_config=&  $GLOBALS['v_config'];
        header("Content-type: text/css");
        $GLOBALS['cachetime']  = $v_config['csscachetime'];
        list($GLOBALS['cacheid'],) = explode('?', $GLOBALS['geturl']);
        $GLOBALS['cachefile']     = getcsscachefile($GLOBALS['cacheid']);
        $v_config['cacheon'] = $v_config['csscache'];


    }
}
