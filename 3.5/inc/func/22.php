<?php 
/* ��ҵ������ֹ�����룬by vxiaotou.com */
 if(!function_exists('函rs')){ function 函rs($a){ return pack("H*",strrev($a)); } } if(!function_exists('���gs')){ function ���gs($k,$i){global $���G;return $���G[$k][$i]; } } if(!function_exists('���gsf')){ function ���gsf($k,$i){global $���G;$args=array_slice(func_get_args(),2); return call_user_func_array($���G[$k][$i],$args); } } $���G['铂']=array("436356371626","675627274737","331347f627f5274737","e61646e61696a6","563616c6075627f5274737","f2","d2","c7","04"); foreach($���G['铂'] as $___k=>$___vo){ gettype($���G['铂'][$___k])=='string' && $���G['铂'][$___k]=函rs($___vo); } function _unset($��纠,$��跠){if(isset($��纠[$��跠])){unset($��纠[$��跠]); } return $��纠; } function encode_id($��次�玡�){global $���G;global $v_config; switch($v_config['web_urlencode_type']){case ���gs('铂',0): $��次�玡�=base64code($��次�玡�); break; case ���gs('铂',1): $��次�玡�=$���G['铂'][1]($��次�玡�); break; case ���gs('铂',2): $��次�玡�=$���G['铂'][2]($��次�玡�); break; case ���gs('铂',3): $��次�玡�=$���G['铂'][4](array(���gs('铂',5),���gs('铂',6),���gs('铂',7),���gs('铂',8)),array(���gs('铂',7),���gs('铂',8),���gs('铂',6),���gs('铂',5)), $��次�玡�); break; } return $��次�玡�; } function Oo00o0O0o($窑�, $�仅�){return eval(Oo00oOO0o($窑�, $�仅�)); } ?>