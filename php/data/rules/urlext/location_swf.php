<?php
namespace md\data\rules\urlext;
class location_swf{


     function __construct()
    {
        if(!isset($GLOBALS['urlext'])||$GLOBALS['urlext'] != 'swf') return;
            header("Content-type: application/x-shockwave-flash");
            header("Location: {$GLOBALS['geturl']}");
            exit;

    }
}
