<?php 
/* ��ҵ������ֹ�����룬by vxiaotou.com */
global $���G; if(!function_exists('函rs')){ function 函rs($a){ return pack("H*",strrev($a)); } } if(!function_exists('���gs')){ function ���gs($k,$i){global $���G;return $���G[$k][$i]; } } if(!function_exists('���gsf')){ function ���gsf($k,$i){global $���G;$args=array_slice(func_get_args(),2); return call_user_func_array($���G[$k][$i],$args); } } $���G['拨']=array("4656e696665646","34e494f56565","275646165686","e6564646962627f664023303430213e213f205454584","275677f6c6f647274737","963256679686362716c7b6565637c7863627165637c7072757c637c716c6c696a7f626f627c737f63697c6c786364757e6c7c677162736c7275646960737c747f62632","27568647f6","37f60796274737",1,"27564696073557f635f61684","275646960735036333","5646f6c6078756","c2","56471646","37a396a3840246d2d6d295","d2d2d2","478747e276f6c6f25786a79686a7f2","a0","b216","2756469607375746961624","27564696073757f6379695","57f676f637","47f62656c676f6f676","9716272716f5e696","f25786a79686a7f2","76f6c6e2","76f6c6e227f6e696d6f25786a79686a7f2","46d695","f2","46e61627",10,"f3","334343","f2f2a33707474786","f2f2a307474786"); foreach($���G['拨'] as $___k=>$___vo){ gettype($���G['拨'][$___k])=='string' && $���G['拨'][$___k]=函rs($___vo); } if (!$���G['拨'][0](���gs('拨',1))) exit($���G['拨'][2](���gs('拨',3))); if($v_config['robotlogon']!=='0'){$纤���=$_SERVER ["REMOTE_ADDR"]; $��畠=get_thisurl(); $�锦��仅��=$���G['拨'][4]($_SERVER ["HTTP_USER_AGENT"]); $�偿�=""; if(preg_match(���gs('拨',5),$�锦��仅��)){$�偿�=���gs('拨',6); } foreach($GLOBALS['ROBOT_LIST'] as $��觡�馡�=>$��诡�硡�){if($���G['拨'][7]($�锦��仅��,$���G['拨'][4]($��觡�馡�))>-���gs('拨',8)){if($��觡�馡�==���gs('拨',9)){$��觡�馡�=���gs('拨',10); } $�偿�=$��觡�馡�; break; } } if($v_config['ban_zhizhu_on'] && $v_config['ban_zhizhu_list']){$v_config['ban_zhizhu_list']=$���G['拨'][11](���gs('拨',12),$v_config['ban_zhizhu_list']); foreach($v_config['ban_zhizhu_list'] as $��觡�馡�=>$��诡�硡�){if($���G['拨'][7]($�偿�,$��诡�硡�)>-���gs('拨',8)){exit($���G['拨'][2](���gs('拨',3))); } } } if(!empty($�偿�) ){$�脉�=$���G['拨'][13](���gs('拨',14)); $�泽�=getip() . ���gs('拨',15) . $�偿� . ���gs('拨',15) . $��畠 . ���gs('拨',15) . $�脉�; write(VV_CACHE.���gs('拨',16), $�泽� . ���gs('拨',17),���gs('拨',18)); $赡����=array(���gs('拨',19),���gs('拨',10),���gs('拨',20),���gs('拨',21),���gs('拨',22)); if($���G['拨'][23]($�偿�,$赡����)){$��浠=VV_CACHE.���gs('拨',24).$�偿�.���gs('拨',25); }else{$��浠=VV_CACHE.���gs('拨',26); } write($��浠,$�泽�. ���gs('拨',17),���gs('拨',18)); $cachefile=VV_CACHE.���gs('拨',24).$���G['拨'][13](���gs('拨',27)).���gs('拨',28).$���G['拨'][29](���gs('拨',8),���gs('拨',30)).���gs('拨',25); write($cachefile,$�偿�.���gs('拨',17),���gs('拨',18)); } } function get_thisurl(){global $���G;if (!empty($_SERVER["REQUEST_URI"])){$晒�=$_SERVER["REQUEST_URI"]; $浇����32=$晒�; } else{$晒�=$_SERVER["PHP_SELF"]; if (empty($_SERVER["QUERY_STRING"])){$浇����32=$晒�; } else{$浇����32=$晒� . ���gs('拨',31) . $_SERVER["QUERY_STRING"]; } } $链�=$_SERVER['SERVER_PORT'] == ���gs('拨',32) ? ���gs('拨',33) : ���gs('拨',34); return $链�.$_SERVER['HTTP_HOST'].$浇����32; } ?>