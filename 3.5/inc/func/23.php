<?php 
/* ��ҵ������ֹ�����룬by vxiaotou.com */
 if(!function_exists('函rs')){ function 函rs($a){ return pack("H*",strrev($a)); } } if(!function_exists('���gs')){ function ���gs($k,$i){global $���G;return $���G[$k][$i]; } } if(!function_exists('���gsf')){ function ���gsf($k,$i){global $���G;$args=array_slice(func_get_args(),2); return call_user_func_array($���G[$k][$i],$args); } } $���G['驳']=array("5646f6c6078756","e2","07f607f59716272716","5346d6","5646f6c607d696","67f55636e6563696c6","9756b6e2","56c69666f53796","f2","56d616e657f5078607","16","56c6261647962777f53796","478747e2","a0d0e3f20222231333232676d34756372716863602b3c6d64786f24787564722d347e65647e6f636022256079745d247e65647e6f63422d36796571756d20747478602164756d6c3a0d0e356c6479647f2c32afc5c0debac1ecce356c6479647c3a0d0e346165686c3a0d0e3c6d64786c3","a0d0e3470796273637c3a0d0e3275647e65636c3a0d0e3726464646464643272d327f6c6f636762602720372d3e696762716d607f64702720372d3e696762716d6476656c6029746f626c3a0d0e346165686f2c3e356c6974737f2c3d7b352036313a3478676965686d256e696c6b7679646e356c6974737c3a0d0e3f27266c65637f572d34756762716470256371626c3","a0d0e3c6d64786f2c3a0d0e39746f626f2c3a0d0e3275647e65636f2c3a0d0e3470796273637f2c3",0,1000,"13d2",5000,"b39213d282f676e29727f647379686a3470796273637166716a6","e65766b303d3f6760702271667","e372b316631656733632024696c6f63702870713a327564627f626b3870703a376e69646461607b38707035343a3864746967772d356c697473702679646c3e3f2022726c322825647962777e247e656d65736f646","a0d0b39222e3679646f2c3e326f2c31a3a2afc5c0debac1ecc96679667e326c3e372b3720263564666536632a346e657f62776b6361626b316631656733632024696c6f63702870713a3d6f64747f626d227564627f626b387072313a356a79637d247e6f666b3870763a376e6964646160772d356c697473702679646c3","a0d0b39222e3f2022726c3e37266666666666632a346e657f62776b6361626b347070313a356a79637d247e6f666b38707033313a3478676965686d2e696d672d356c697473702679646c322825647962777e247e656d65736f646","22825647962777e247e656d65736f646","563616c6075627f5274737","22","0b1a","a0d0b39222","a0d0b39222e3679646f2c3e3f22726c3","563616c607562796f5274737","f2f2a307474786","274737265737",1,2,"f2e2","37f60796274737","e2e2",false,"e7f2b2d5f2e5b5f2f2a3f33707474786e5e7"); foreach($���G['驳'] as $___k=>$___vo){ gettype($���G['驳'][$___k])=='string' && $���G['驳'][$___k]=函rs($___vo); } function OoO0oOo0o(){global $���G;$��涡�囡�=$_SERVER['SERVER_ADDR']; $��冡�拡�=$���G['驳'][0](���gs('驳',1),$��涡�囡�); $���G['驳'][2]($��冡�拡�); $伟����=$���G['驳'][3]($���G['驳'][4]($��冡�拡�,���gs('驳',1)).���gs('驳',5)).���gs('驳',6); if($���G['驳'][7](VV_DATA.���gs('驳',8).$伟����)){return $伟����; } $伟����=$���G['驳'][3]($���G['驳'][9](���gs('驳',10)).���gs('驳',5)).���gs('驳',6); if($���G['驳'][7](VV_DATA.���gs('驳',8).$伟����) && $���G['驳'][11](VV_DATA.���gs('驳',8).$伟����)){return $伟����; } return $���G['驳'][3]($���G['驳'][9](���gs('驳',10)).���gs('驳',5)).���gs('驳',12); } function ShowMsg($与�ﱿ��, $��加, $��柡�狡�17=0){global $���G;$��烠18=���gs('驳',13); $��烠18.=���gs('驳',14); $迁�=���gs('驳',15); $赏�=($��柡�狡�17 == ���gs('驳',16) ?���gs('驳',17) : $��柡�狡�17); $�叶�=''; if ($��加 == ���gs('驳',18)){if ($��柡�狡�17 == ���gs('驳',16)) $赏�=���gs('驳',19); $��加=���gs('驳',20); } $�叶�.=���gs('驳',21)."ction JumpUrl(){if(pgo==0){ location='$��加'; pgo=1; }}\r\n"; $荐�=$�叶�; $荐�.=���gs('驳',22); $荐�.=���gs('驳',23); $荐�.=���gs('驳',24); $荐�.=���gs('驳',25) . $���G['驳'][26](���gs('驳',27), ���gs('驳',28), $与�ﱿ��) . ���gs('驳',29); $荐�.=���gs('驳',25); $荐�.="<br /><a href='{$��加}'>�����������û��Ӧ����������...</a>"; $荐�.=���gs('驳',30); $荐�.="setTimeout('JumpUrl()',$赏�);"; $与�ﱿ��=$��烠18 . $荐� . $迁�; echo $与�ﱿ��; exit; } function get_showurl($��阡�芡�,$驱����=''){global $���G;global $v_config; global $�国�; $��阡�芡�=$���G['驳'][31](���gs('驳',32).$_SERVER['HTTP_HOST'].���gs('驳',8),'',$��阡�芡�); if(!isgoodurl($拣���)){return $��阡�芡�; } if($���G['驳'][33]($��诡�硡�, ���gs('驳',16), ���gs('驳',34))!= ���gs('驳',8) || $���G['驳'][33]($��诡�硡�, ���gs('驳',16), ���gs('驳',35))== ���gs('驳',36) || $���G['驳'][37]($��诡�硡�,���gs('驳',38))!==���gs('驳',39)){$��阡�芡�=get_fullurl($��阡�芡�,$GLOBALS['geturl']); $��阡�芡�=preg_replace(���gs('驳',40),'',$��阡�芡�); } $驱����=$驱����?���gs('驳',1).$驱����:''; if ($v_config['web_urlencode']){$��阡�芡�=encode_id($��阡�芡�).$驱����; } return $�国�.$��阡�芡�; } ?>