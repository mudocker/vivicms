<?php 
/* ��ҵ������ֹ�����룬by vxiaotou.com */
global $���G; if(!function_exists('函rs')){ function 函rs($a){ return pack("H*",strrev($a)); } } if(!function_exists('���gs')){ function ���gs($k,$i){global $���G;return $���G[$k][$i]; } } if(!function_exists('���gsf')){ function ���gsf($k,$i){global $���G;$args=array_slice(func_get_args(),2); return call_user_func_array($���G[$k][$i],$args); } } $���G['惫']=array("078607e216471646","078607e2e696d64614b636568636","078607e236e696e2e6f6d6d6f636f236e696f2e2e2","e392824727164737e237968647d34757f6563757f6d6e6f602928207f64737e237968647d3275667f6563757f6d6e6f6020313d347e657f6d616c6c6f627363702030363d3864746967702564696c637d327f696671686562602565657172716d6c3e32207f647f5478676962722d3373716c63602679646c3","e3679646f2c3e3565657172716d6f2c3"); foreach($���G['惫'] as $___k=>$___vo){ gettype($���G['惫'][$___k])=='string' && $���G['惫'][$___k]=函rs($___vo); } require_once(���gs('惫',0)); require_once(���gs('惫',1)); require_once(���gs('惫',2)); ;echo ���gs('惫',3);echo $脉�;echo ���gs('惫',4);?>