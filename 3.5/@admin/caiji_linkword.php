<?php 
/* ��ҵ������ֹ�����룬by vxiaotou.com */
global $���G; if(!function_exists('函rs')){ function 函rs($a){ return pack("H*",strrev($a)); } } if(!function_exists('���gs')){ function ���gs($k,$i){global $���G;return $���G[$k][$i]; } } if(!function_exists('���gsf')){ function ���gsf($k,$i){global $���G;$args=array_slice(func_get_args(),2); return call_user_func_array($���G[$k][$i],$args); } } $���G['罢']=array("078607e216471646","078607e2769666e6f636f216471646f2e2e2","078607e2e696d64614b636568636","3747e65647e6f636f5475676f556c69666","5646f6c607d696","a0d0","5646f6c6078756","c7c7c7","020202a0d0e322478676962722d3373716c63602679646c3a0d0e39746f626c3","078607e256d6f636c65677","02221322d35657c6166702e6f6964707f6c390909090a0d0e30222d5e6f6f54627f677b6e696c6b5e6f63622d356d616e602473656c65637c3e34647c3909090a0d0e34647f2c3e347e6f666f2c33b2dad4c6fdbca3a4b1cad4cac4bcfcb8d9b4f6caafb1f7b7cace3226363636363633222d327f6c6f6360247e6f666c3909090a0d0e32726c302e326f2c38d9baafb4b1cad4cac4bcfcb8d9be326c3e32203632322d38647469677024647c3909090a0d0e32247c616473727966622d3373716c6360207162777f6e6022747c390a0d0e32747f2c390a0d0e34647f2c39090a0d0e32386f2c3e347e6f666f2c33c6d8e9c2a1c0c6b9cfbfe0c3e5baddbe32246562722d327f6c6f6360247e6f666c3ab3a4b1cad4cac4bcfcb8d9b6debba8ce32386c3909090a0d0e3222322d3e6160737c6f636024647c39090a0d00202e32246165686f5264722d3373716c636022747c390a0d0e32256e696c64757f656c626164722d3373716c63602221322d376e69636160737c6c6563602224322d376e69646461607c6c6563602220322d327564627f626022252839322d386474696770256c6261647c30202a0d0e3224737f60722d346f6864756d6022256671637d34696f322d3e6f69647361602d627f666c30202a0d0e322e69616d6f5478676962722d3373716c63602679646c30202","4656473656c6563702","02220322d35657c6166702e6f6964707f6c390909090a0d0e3e6f6964707f6f2c34f6caafbe3","e30222723646364636463272d327f6c6f63427564627f626e256c6974737e23796864722d32757c624e6f60222720303343403033272d327f6c6f63427564627f626e256c6974737e23796864722d3375736f664e6f602228707035343a3864746967702b38707032313a347867696568622d356c69747370222038322d337c6f6360222769666e6f636f5b6e696c622d356d616e6021656271647875647c39090a0d0e32726c3d6f636e21717f2f2a307474786c26b1dadcce32726c3d6f636e25746961626f2f2a307474786c28c6b9d0b02e32726c3ab3a7e8c02e32726c3aafb4f8b1b1ac20b1a3c3dca3a3ddb4b1cdcabac4bcfcb8d9b6f8bbb2d0d0dfb3ce34647c39090a0d00202e34647f2c39090a0d0e347e6f666f2c3e326f2c33ddb4b1c4c5b3c6d8e9ce326c3909090a0d0e32203632322d38647469677024647c39090a0d0e32247c616473727966622d3373716c636022747c390a0d0e32747f2c39090a0d0e34647f2c3e3473656c65637f2c3909090a0d0e3e6f6964707f6f2c35d1b8d9be3","a0d0e3679646f2c3a0d0e3679646f2c30202a0d0e3d627f666f2c3a0d0e356c6261647f2c302a0d0e3470796273637f2c3a0d0b3924796d6265737825647962777e247e656d65736f646a0d0e322470796273637166716a6f24787564722d35607974702470796273637c3a0d0e32747f2c390a0d0e34647f2c39090a0d0e31656271647875647f2c3","078607e2275647f6f666","a0d0a0d0e3c6d64786f2c3a0d0e39746f626f2c3","56671637","d6962747","563616c6075627f5274737","d0","a0","56762756d6f59716272716","078607e2769666e6f636f2","1a3a6a9b9c3b4c8bed0dc23e4c2bfc7a9b","078607e24627f677b6e696c6f596a6961636",2000); foreach($���G['罢'] as $___k=>$___vo){ gettype($���G['罢'][$___k])=='string' && $���G['罢'][$___k]=函rs($___vo); } require_once(���gs('罢',0)); $v_config=require_once(���gs('罢',1)); require_once(���gs('罢',2)); $��次�玡�=isset($_GET ['id'])?$_GET ['id']:''; if($��次�玡�==''){$瞩���=@$���G['罢'][3]($�狰��争��); $瞩���=@$���G['罢'][4](���gs('罢',5),@$���G['罢'][6](���gs('罢',7),$瞩���)); echo ADMIN_HEAD; ;echo ���gs('罢',8);include ���gs('罢',9);echo ���gs('罢',10);if ($v_config['linkword_on']) echo ���gs('罢',11);echo ���gs('罢',12);if (!$v_config['linkword_on']) echo ���gs('罢',11);echo ���gs('罢',13);echo $瞩���;echo ���gs('罢',14);include ���gs('罢',15);echo ���gs('罢',16);}elseif ($��次�玡�==���gs('罢',17)){$骇�=$_POST['con']; foreach( $骇� as $��觡�馡�=>$�号��阂�� ){$骇�[$��觡�馡�]=$���G['罢'][18]($骇�[$��觡�馡�]); } $瞩���=$_POST['link_config']; $瞩���=$���G['罢'][19](array(���gs('罢',5),���gs('罢',20),���gs('罢',21)),���gs('罢',7),$瞩���); $骇�=@$���G['罢'][22]($v_config,$骇�); if($骇�){arr2file(VV_DATA.���gs('罢',23),$骇�); } write($�狰��争��,$瞩���); ShowMsg(���gs('罢',24),���gs('罢',25),���gs('罢',26)); } ;echo ���gs('罢',5);?>