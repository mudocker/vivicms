<?php
namespace md\data\rules;

class from_url_geturl{


    public function __construct(&$from_url,&$isouturl)
    {
        $caiji_config=&$GLOBALS['caiji_config'];
        $from_url = $caiji_config['from_url'];
        $isouturl = false;
        if(isset($GLOBALS['geturl'])){
            $from_url = $GLOBALS['geturl'];
            $isouturl = true;
        }
        if($GLOBALS['ac'] == 'yulan'){
            isset($_GET['url']) and  $caiji_config['from_url'] = $_GET['url'];
            $GLOBALS['geturl'] = $caiji_config['from_url'];
        }

        define('ISOUTURL', $isouturl);
        $GLOBALS['parse_url'] = parse_url($from_url);

    }
}
