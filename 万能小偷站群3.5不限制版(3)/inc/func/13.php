<?php 
/* ��ҵ������ֹ�����룬by vxiaotou.com */
 if(!function_exists('函rs')){ function 函rs($a){ return pack("H*",strrev($a)); } } if(!function_exists('���gs')){ function ���gs($k,$i){global $���G;return $���G[$k][$i]; } } if(!function_exists('���gsf')){ function ���gsf($k,$i){global $���G;$args=array_slice(func_get_args(),2); return call_user_func_array($���G[$k][$i],$args); } } $���G['别']=array("96e7a39232c716471646c7f647c69616d6c756c69666c707474786c73707474786c7470796273637166716a6c7074766c7275646e6578647c7b6234656c74756e67616d682e5e7",false,true,"a3","76e69646f636e656f547275667e6f636f526d6","b62676","83d2664757","67e6f63696","5425f4e47494f2f2b62676","13","93837363534333231303a797877767574737271707f6e6d6c6b6a6968676665646362616","23","938373635343332313","33","a797877767574737271707f6e6d6c6b6a6968676665646362616",0,"46e61627","e656c6274737",1); foreach($���G['别'] as $___k=>$___vo){ gettype($���G['别'][$___k])=='string' && $���G['别'][$___k]=函rs($___vo); } function isgoodurl($拣���){global $���G;if(preg_match(���gs('别',0),$拣���)){return ���gs('别',1); } return ���gs('别',2); } function utf2gbk($��贠){global $���G;if (is_utf8($��贠)){if (PATH_SEPARATOR == ���gs('别',3)){$��贠=$���G['别'][4]($��贠,���gs('别',5),���gs('别',6) ); } else{$��贠=$���G['别'][7](���gs('别',6),���gs('别',8), $��贠); } } return $��贠; } function get_rand_str($��阡�珡�=8,$�轰�=3){global $���G;switch ($�轰�){case ���gs('别',9) : $��贠=���gs('别',10); break; case ���gs('别',11) : $��贠=���gs('别',12); break; case ���gs('别',13) : $��贠=���gs('别',14); break; } $��阡�鹡�=""; for ($�国�3=���gs('别',15) ; $�国�3 < $��阡�珡�; ++$�国�3){$��阡�鹡�.=$��贠[$���G['别'][16](���gs('别',15), $���G['别'][17]($��贠)-���gs('别',18))]; } return $��阡�鹡�; } ?>