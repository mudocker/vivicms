<?php
define('DS', DIRECTORY_SEPARATOR);

//define('VV_INC', str_replace("\\", DS, dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR.'inc');
//define('VV_ROOT', str_replace("\\", DS, substr(VV_INC, 0, -4)));

//根目录
define('WEB_ROOT', str_replace("\\", DS, dirname(__DIR__)));
define('VV_ROOT', WEB_ROOT);
//1级
define('VV_DATA', WEB_ROOT .DS. 'data');
define('VV_INC', WEB_ROOT .DS. 'inc');
define('VV_TMPL', WEB_ROOT .DS.'template');
//data
define('VV_CONF', VV_DATA .DS.'conf');
define('VV_CONFIG', VV_DATA .DS.'config');
define('VV_CACHE', VV_DATA .DS.'cache');


//rules
define('DRGET', VV_DATA .DS.'rules_get'.DS);
define('DREPLACE',VV_DATA .DS.'rules_get'.DS.'replace'.DS);
define('VV_RULES', VV_DATA .DS.'rules'.DS);
define('VV_REPLACE',VV_DATA .DS.'rules_get'.DS.'replace'.DS);
define('DRULES',VV_DATA.DS."rules".DS);
define('DRURLEXT',VV_DATA.DS."rules".DS."urlext".DS);

//inc
define('VV_INIT', VV_INC .DS. 'init');

define('VV_ENCODEKEYS', '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');

