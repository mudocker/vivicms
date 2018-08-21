<?php
if($caiji_config['web_debug'] == "on") echo "\r\n/*---调试信息 start---\r\n" . implode("\r\n", $GLOBALS['debug']) . "\r\n---调试信息 end---*/\r\n";
exit();