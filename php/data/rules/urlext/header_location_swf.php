<?php
if(isset($GLOBALS['urlext'])&&$GLOBALS['urlext'] == 'swf'){
    header("Content-type: application/x-shockwave-flash");
    header("Location: {$GLOBALS['geturl']}");
    exit;
}