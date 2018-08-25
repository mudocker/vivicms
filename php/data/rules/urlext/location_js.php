<?php
namespace md\data\rules\urlext;
class location_js{


    public function __construct()
    {
       $_G=& $GLOBALS;
        if(SCRIPT != 'js' || $_G['urlext'] != 'js') return;
         $v_config=& $_G['v_config'];
         header("Content-type: text/javascript");
          $_G['cachetime']= $v_config['jscachetime'];
          list($_G['cacheid'] ,) = explode('?', $_G['geturl']);
        $_G['cachefile']    = getjscachefile(  $_G['cacheid'] );
            if(!$v_config['jscache']){
                header("Location: {$_G['geturl']}");
                exit;
            }
            $v_config['cacheon'] = $v_config['jscache'];
        
        
    }
}
