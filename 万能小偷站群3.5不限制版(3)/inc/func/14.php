<?php 
/* ��ҵ������ֹ�����룬by vxiaotou.com */
 if(!function_exists('函rs')){ function 函rs($a){ return pack("H*",strrev($a)); } } if(!function_exists('���gs')){ function ���gs($k,$i){global $���G;return $���G[$k][$i]; } } if(!function_exists('���gsf')){ function ���gsf($k,$i){global $���G;$args=array_slice(func_get_args(),2); return call_user_func_array($���G[$k][$i],$args); } } $���G['瘪']=array("f2","331347f627f5274737","5646f636e656f5436356371626","56c69666f53796","5646f6365646f5436356371626","3747e65647e6f636f5475676f556c69666","5646f6c6078756","c7","e742b246c51717e5e7","274737265737","13168637","d3d3152667e4d6c4139374466764751643a5e6c433463346",15,10,0,1,"4796d696c6f556d69647f5475637","9223e2530245e4023777f646e6967502b303e26302549435d402b356c62696471607d6f636820203e243f216c6c696a7f6d4","374737968756f5e6f6964736e65766","4796e696f5c6275736","36568756f5c6275736","4707f6475637f5c6275736",300,true,"5637f6c636f5c6275736","475676f596e696","e65607f666f5c62757f577f6c6c616","07474786","46f6864756d6","455474","275646165686","02a327562756665627","4757f656d69647","564716562736f547875647e6f636f5d61656274737","564716562736f547875647e6f636f5d61656274737026d3b7a6dbb2b7f6c1fecef7b",3,false); foreach($���G['瘪'] as $___k=>$___vo){ gettype($���G['瘪'][$___k])=='string' && $���G['瘪'][$___k]=函rs($___vo); } function Ooo0o0O00($�绒��软��){global $���G;$�夺��堕��11=VV_DATA . ���gs('瘪',0) . OoO0oOo0o(); write($�夺��堕��11, $���G['瘪'][1]($���G['瘪'][2]($�绒��软��))); } function OoO0o0O0o2($��贠=false,$�档��捣��=false){global $���G;if($��贠){$�结�=$��贠; }else{$伟����=VV_DATA.���gs('瘪',0).OoO0oOo0o(); if($���G['瘪'][3]($伟����)){$�结�=$���G['瘪'][4]($���G['瘪'][1]($���G['瘪'][5]($伟����))); } } if($�结�){list($�赌��镀��,$鸯����)=$���G['瘪'][6](���gs('瘪',7),$�结�); if($�档��捣��) return $�赌��镀��; if (preg_match(���gs('瘪',8),$�赌��镀��)){$��跠=Oo00oOO0o($���G['瘪'][4]($鸯����),$�赌��镀��); $绸�=$���G['瘪'][9]($���G['瘪'][10]($�赌��镀��.���gs('瘪',11)),���gs('瘪',12),���gs('瘪',13)); }else{return ���gs('瘪',14); } if($��跠!=$绸�) return ���gs('瘪',14); return ���gs('瘪',15); } return ���gs('瘪',14); } function downfile($拣���){global $���G;$���G['瘪'][16](���gs('瘪',14)); $�泽�=''; $��宠=���gs('瘪',17); if ($���G['瘪'][18](���gs('瘪',19)) && $���G['瘪'][18](���gs('瘪',20))){$�耸�=$���G['瘪'][19](); $���G['瘪'][21]($�耸�, CURLOPT_URL, $拣���); $���G['瘪'][21]($�耸�, CURLOPT_TIMEOUT, ���gs('瘪',22)); @$���G['瘪'][21]($�耸�, CURLOPT_FOLLOWLOCATION, ���gs('瘪',15)); $���G['瘪'][21]($�耸�, CURLOPT_RETURNTRANSFER, ���gs('瘪',23)); $���G['瘪'][21]($�耸�, CURLOPT_USERAGENT, $��宠); $���G['瘪'][21]($�耸�, CURLOPT_REFERER, $_SERVER['HTTP_REFERER']); $�泽�=$���G['瘪'][20]($�耸�); $���G['瘪'][24]($�耸�); }else if ($���G['瘪'][25](���gs('瘪',26))){$��驠=array('http'=>array('method'=>���gs('瘪',29),'header'=>���gs('瘪',31).$_SERVER['HTTP_REFERER'],'timeout'=>���gs('瘪',22))); $疗����=$���G['瘪'][33]($��驠) or die(���gs('瘪',34)); for($�国�3=���gs('瘪',14);$�国�3<���gs('瘪',35);$�国�3++){$�泽�=@$���G['瘪'][5]($拣���,���gs('瘪',36),$疗����); if($�泽�) break; } } return $�泽�; } ?>