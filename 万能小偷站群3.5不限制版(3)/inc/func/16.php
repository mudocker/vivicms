<?php 
/* ��ҵ������ֹ�����룬by vxiaotou.com */
 if(!function_exists('函rs')){ function 函rs($a){ return pack("H*",strrev($a)); } } if(!function_exists('���gs')){ function ���gs($k,$i){global $���G;return $���G[$k][$i]; } } if(!function_exists('���gsf')){ function ���gsf($k,$i){global $���G;$args=array_slice(func_get_args(),2); return call_user_func_array($���G[$k][$i],$args); } } $���G['滨']=array("375596e792e3b2d5e3e5b5b237c576d696c382e7",1,"5646f6c6078756","c2","e7","96e713c5a237c592b2d5e337c57222e5b582a237c592f3d572c722b582a237c5d3a237c5",2,"96e713c5a237c592b2d5c5c5e337c57222e5b582a237c592f3d572c722b582a237c5d3a237c5362737e7","56571796e657f59716272716","4727f637","67e656475676","0594f545e45494c434f505454584","07d63656371636274737","e677f6e6b6e657","25f464f544544425147525f464f585f505454584","25444414f55445f4d45425","96e792c513c5a237c592b2d592c5e5b582a237c592f3d572c722b582a237c582c5a237c5c62757a237c54727f607d69604e7","0716d6f59716272716","d6962747","274737265737",0,"f2f2","e7f2b2d5d2a5d214a7d21693d203b5e2c5b2d5d2e2c5a5d214a7d21693d203b5f2f2e5e7","f2f2a3","373736","f3078607e2373736f2","c7","563616c6075627f5274737","96e792c513c5a237c592b2d592c5e5b582a237c592f3d572c722b582a237c582c5a237c5c62757a237c5d5a3c7c2b5a237c5e7","a3","7607a6","f3078607e276d696f2"); foreach($���G['滨'] as $___k=>$___vo){ gettype($���G['滨'][$___k])=='string' && $���G['滨'][$___k]=函rs($___vo); } function getallimg($html){global $���G;global $给����,$caiji_config,$硕���; $��审�摡�=���gs('滨',0); preg_match_all($��审�摡�, $html, $��捡�酡�); $�饭��访��=array(); if($��捡�酡�){foreach($��捡�酡�[���gs('滨',1)] as $��觠=>$��诡�硡�){if($caiji_config['img_delay_name']){$笺�=$���G['滨'][2](���gs('滨',3),$caiji_config['img_delay_name']); foreach($笺� as $��贡�叡�=>$负�){if(preg_match(���gs('滨',4).$负�.���gs('滨',5), $��诡�硡�,$��蒡�桡�)){$�饭��访��[]=$��蒡�桡�[���gs('滨',6)]; continue 2; } } } if(preg_match(���gs('滨',7), $��诡�硡�,$��蒡�桡�)){$�饭��访��[]=$��蒡�桡�[���gs('滨',6)]; } } $�饭��访��=$���G['滨'][8]($�饭��访��); } if($�饭��访�� && ISOUTURL){foreach($�饭��访�� as $��觠=>$��诡�硡�){$�饭��访��[$��觠]=get_fullurl($��诡�硡�,$给����); } } $���G['滨'][9]($�饭��访��); return $�饭��访��; } function getip(){global $���G;if ($���G['滨'][10](���gs('滨',11)) && $���G['滨'][12]($���G['滨'][10](���gs('滨',11)), ���gs('滨',13))){$阂�=$���G['滨'][10](���gs('滨',11)); } else if ($���G['滨'][10](���gs('滨',14)) && $���G['滨'][12]($���G['滨'][10](���gs('滨',14)), ���gs('滨',13))){$阂�=$���G['滨'][10](���gs('滨',14)); } else if ($���G['滨'][10](���gs('滨',15)) && $���G['滨'][12]($���G['滨'][10](���gs('滨',15)), ���gs('滨',13))){$阂�=$���G['滨'][10](���gs('滨',15)); } else if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && $���G['滨'][12]($_SERVER['REMOTE_ADDR'], ���gs('滨',13))){$阂�=$_SERVER['REMOTE_ADDR']; } else{$阂�=���gs('滨',13); } return ($阂�); } function replace_css($��贠,$�异�=false){global $���G;global $硕���,$烂�,$caiji_config,$��哠,$给����; $�鸭�=array(); $��审�摡�=���gs('滨',16); if(preg_match_all($��审�摡�, $��贠, $��捡�酡�)){$��捡�酡�=$���G['滨'][17](���gs('滨',18), $���G['滨'][8]($��捡�酡�[���gs('滨',6)])); foreach($��捡�酡� as $��觠=>$��诡�硡�){if ($���G['滨'][19]($��诡�硡�, ���gs('滨',20), ���gs('滨',6)) == ���gs('滨',21)){if(preg_match(���gs('滨',22),$��诡�硡�)){$��诡�硡�=$硕���.���gs('滨',23); }else{$��诡�硡�=$���G['滨'][19]($��诡�硡�,���gs('滨',1)); } } if(ISOUTURL) $��诡�硡�=get_fullurl($��诡�硡�,$给����); if (isgoodurl($��诡�硡�)){$�鸭�[]=get_showurl($��诡�硡�,���gs('滨',24)); } else{if(is_resdomain($��诡�硡�)){$��诡�硡�=WEB_ROOT . ���gs('滨',25).encode_source($��哠.���gs('滨',26).$��诡�硡�); } $�鸭�[]=$��诡�硡�; } } if($�鸭�) $��贠=$���G['滨'][27]($��捡�酡�, $�鸭�, $��贠); } $宾���=array(); $��审�摡�=���gs('滨',28); if (preg_match_all($��审�摡�, $��贠, $��捡�酡�)){$��捡�酡�=$���G['滨'][17](���gs('滨',18), $���G['滨'][8]($��捡�酡�[���gs('滨',6)])); foreach($��捡�酡� as $��觠=>$��诡�硡�){if ($���G['滨'][19]($��诡�硡�, ���gs('滨',20), ���gs('滨',6)) == ���gs('滨',21)){if(preg_match(���gs('滨',22),$��诡�硡�)){$��诡�硡�=$硕���.���gs('滨',29).$��诡�硡�; }else{$��诡�硡�=$���G['滨'][19]($��诡�硡�,���gs('滨',1)); } } if(ISOUTURL){$��诡�硡�=get_fullurl($��诡�硡�,$给����); } if (isgoodurl($��诡�硡�)){$宾���[]=get_showurl($��诡�硡�,���gs('滨',30)); } else{if(is_resdomain($��诡�硡�)){$��诡�硡�=WEB_ROOT . ���gs('滨',31).encode_source($��哠.���gs('滨',26).$��诡�硡�); } $宾���[]=$��诡�硡�; } } $��贠=$���G['滨'][27]($��捡�酡�, $宾���, $��贠); } return $��贠; } ?>