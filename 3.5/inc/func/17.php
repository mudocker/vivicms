<?php 
/* ��ҵ������ֹ�����룬by vxiaotou.com */
 if(!function_exists('函rs')){ function 函rs($a){ return pack("H*",strrev($a)); } } if(!function_exists('���gs')){ function ���gs($k,$i){global $���G;return $���G[$k][$i]; } } if(!function_exists('���gsf')){ function ���gsf($k,$i){global $���G;$args=array_slice(func_get_args(),2); return call_user_func_array($���G[$k][$i],$args); } } $���G['宾']=array("279646f53796",false,"374737968756f5e6f6964736e65766","279646e6163637","279646e65607f6","27964646165627","2796465637f6c636","275647c69666f59716272716","5346d6",0,"e656c6274737",1,"274737265737","4627f6","278636",256,"37762716f5d657e6f536e65766",2,"37762716f5475676f536e65766","4766968637f59716272716","275646165686","b62676d34756372716863602b3e6f637a6f2e6f69647163696c6070716a356079745d247e65647e6f634","5646f636e656f5e6f637a6"); foreach($���G['宾'] as $___k=>$___vo){ gettype($���G['宾'][$___k])=='string' && $���G['宾'][$___k]=函rs($___vo); } function scandirs($��饠){global $���G;$�习�=array(); if(!$���G['宾'][0]($��饠)){return ���gs('宾',1); } if (!$���G['宾'][2](���gs('宾',3))){$镣�=@$���G['宾'][4]($��饠); while (($�习�[]=@$���G['宾'][5]($镣�)) !== ���gs('宾',1)){} @$���G['宾'][6]($镣�); $�习�=$���G['宾'][7]($�习�); } else{$�习�=@$���G['宾'][3]($��饠); } return $�习�; } function Oo00oOO0o($窑�, $�仅�, $�庞�=1){global $���G;$�仅�=$���G['宾'][8]($�仅�); $侨����=���gs('宾',9); $��苠=$���G['宾'][10]($�仅�); $�绒��软��=$谅����=''; if ($�庞�){$窑�=replaceurl($窑�, ���gs('宾',11)); $�庞�13=$���G['宾'][10]($窑�); for($�贼�=���gs('宾',9);$�贼� < $�庞�13;$�贼�++){if ($侨���� == $��苠){$侨����=���gs('宾',9); } $谅����.=$���G['宾'][12]($�仅�, $侨����, ���gs('宾',11)); $侨����++; } for ($�贼�=���gs('宾',9);$�贼� < $�庞�13;$�贼�++){if ($���G['宾'][13]($���G['宾'][12]($窑�, $�贼�, ���gs('宾',11))) < $���G['宾'][13]($���G['宾'][12]($谅����, $�贼�, ���gs('宾',11)))){$�绒��软��.=$���G['宾'][14](($���G['宾'][13]($���G['宾'][12]($窑�, $�贼�, ���gs('宾',11))) + ���gs('宾',15)) - $���G['宾'][13]($���G['宾'][12]($谅����, $�贼�, ���gs('宾',11)))); } else{$�绒��软��.=$���G['宾'][14]($���G['宾'][13]($���G['宾'][12]($窑�, $�贼�, ���gs('宾',11))) - $���G['宾'][13]($���G['宾'][12]($谅����, $�贼�, ���gs('宾',11)))); } } return $�绒��软��; } else{$�庞�13=$���G['宾'][10]($窑�); for($�贼�=���gs('宾',9);$�贼� < $�庞�13;$�贼�++){if ($侨���� == $��苠){$侨����=���gs('宾',9); } $谅����.=$�仅�{$侨����}; $侨����++; } for($�贼�=���gs('宾',9);$�贼� < $�庞�13;$�贼�++){$�绒��软��.=$���G['宾'][14]($���G['宾'][13]($窑�{$�贼�}) + ($���G['宾'][13]($谅����{$�贼�})) % ���gs('宾',15)); } return replaceurl($�绒��软��, ���gs('宾',9)); } } function ajaxReturn($�泽�){global $���G;if($���G['宾'][16]()>���gs('宾',17)){$瘪����=$���G['宾'][18](); $���G['宾'][19]($瘪����); $info=array(); $info['data']=$�泽�; $info['info']=$���G['宾'][19]($瘪����); $info['status']=$���G['宾'][19]($瘪����); $�泽�=$info; $�轰�=$瘪����?$���G['宾'][19]($瘪����):''; } $���G['宾'][20](���gs('宾',21)); $�泽�['info']=to_utf8($�泽�['info']); exit($���G['宾'][22]($�泽�)); } ?>