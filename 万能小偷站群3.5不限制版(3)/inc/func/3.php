<?php global $���G;if(!function_exists('函rs')){function 函rs($a){return pack("H*",strrev($a));}}if(!function_exists('���gs')){function ���gs($k,$i){global $���G;return $���G[$k][$i];}}if(!function_exists('���gsf')){function ���gsf($k,$i){global $���G;$args=array_slice(func_get_args(),2);return call_user_func_array($���G[$k][$i],$args);}}$���G['别']=array("47e657f636",0,"279646f53796","279646b6d6",false,true);foreach($���G['别']as $___k=>$___vo){gettype($���G['别'][$___k])=='string'&&$���G['别'][$___k]=函rs($___vo);}function recursive_mkdir($�萧�,$��丠=0777){global $���G;$��渠=$���G['别'][0]($��计�纡�);for($�贼��赠��=���gs('别',1);$�贼��赠��<$��渠;++$�贼��赠��){if(!$���G['别'][2]($�萧�)&&!$���G['别'][3]($�萧�,$��丠)){return ���gs('别',4);}}return ���gs('别',5);}