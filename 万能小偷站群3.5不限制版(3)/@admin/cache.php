<?php 
/* ��ҵ������ֹ�����룬by vxiaotou.com */
global $���G; if(!function_exists('函rs')){ function 函rs($a){ return pack("H*",strrev($a)); } } if(!function_exists('���gs')){ function ���gs($k,$i){global $���G;return $���G[$k][$i]; } } if(!function_exists('���gsf')){ function ���gsf($k,$i){global $���G;$args=array_slice(func_get_args(),2); return call_user_func_array($���G[$k][$i],$args); } } $���G['奥']=array("078607e216471646","078607e2769666e6f636f216471646f2e2e2","078607e2e696d64614b636568636","02a0d0e322478676962722d3373716c63602679646c3a0d0e39746f626c3","078607e256d6f636c65677","02221322d35657c6166702e6f6964707f6c390909090a0d0e322d5e6f676f6c647f626f627b5e6f63622d356d616e602473656c65637c3e34647c3909090a0d0e34647f2c3e347e6f666f2c3caccfa6b0d0d0c5cbe6d9a6d6e7cdf2d7fbc1dbc3f4b7f8bcb2c7ccbe3226363636363633222d327f6c6f6360247e6f666c3909090a0d0e32726c3e326f2c38d9baafbcb2c7ccbbe6d9a6de326c3e32203632322d38647469677024647c3909090a0d0e32247c616473727966622d3373716c6360207162777f6e6022747c39090a0d0e32747f2c39090a0d0e34647f2c3e32386f2c39a3ae347e6f666f2c33c6d8e9c2a1c0c6b9cfbfe0c3e5baddbe32246562722d327f6c6f6360247e6f666c38a3aab3a8d9baafb6e4babbb6debba8ce32386c3e323d3e6160737c6f636024647c3909090a0d0e32246165686f5264722d3373716c636022747c390a0d0e32213769666e6f63622d34696029746f62647c390a0d0e3224737f60722d346f6864756d6022256671637d34696f322d3e6f69647361602d627f666c390a0d0e39746f62647f2c39090a0d0e32747f2c39090a0d0e34647f2c3909090a0d0e3c657f2c390909090a0d0e396c6f2c3e316f2c32f4d6e9b6e4babbb5e2d8a6b4d7de322433222d3665627860222b39243c2438226164722d3b63696c636e6f60216c3e3224326164722d346960296c6c39090909090a0d0e396c6f2c3e316f2c36beb7b2c6e4babbbe322333222d3665627860222b39243c2338226164722d3b63696c636e6f60216c3e3223326164722d346960296c6c39090909090a0d0e396c6f2c3e316f2c3de0c5e7cfa6b4d7de322233222d3665627860222b39243c2238226164722d3b63696c636e6f60216c3e3222326164722d346960296c6c39090909090a0d0e396c6f2c3e316f2c38d9baafb6e4babbbe322133222d3665627860222b39243c2138226164722d3b63696c636e6f60216c3e32227573622d3373716c63602221326164722d346960296c6c39090909090a0d0e3226716e6f5f64622d3373716c63602c657c390909090a0d0e3222322d3e6160737c6f636024647c3909090a0d0e32247c616473727966622d3373716c636022747c39090a0d0e39746f62647c390a0d0e32256e696c64757f656c626164722d3373716c63602221322d376e69636160737c6c6563602224322d376e69646461607c6c6563602220322d327564627f626022252839322d386474696770256c6261647c3a0d0e322e69616d6f5478676962722d3373716c63602679646c30202a0d0e356c6974737f2c3a0d0e3f3a0d0d7b34666666656563202a346e657f62776b636162602b702275736e296c6a0d0e322373736f24787564722d3560797470256c6974737c3a0d0e3470796273637f2c3a0d0b392d7a0d0d790a0d0b39283c2f6e6822616470292721372d312f6e68266969090a0d0b3921382274737265737e286371686c62757d3f6e69090a0d0b79286371686c6275782669690a0d0b386371686e2e6f696471636f6c6d386371686c627570227166790a0d0b7029282e6f6964736e657668242a0d0d7a0d0b392722757367282373716c634464616e292f6e6b2722616473272824290a0d0b39282e69456461666e292f6e6b272769666e6f6363272824290a0d0d790a0d0b3928256469686e29296b272769666e6f636327282429090a0d0b392722757367282373716c6345667f6d65627e29296b272261647327282429090a0d0b792b2b296b3e6d3c396b313d396022716678227f66690a0d0b792e6c2f6e68226164702e6f6964736e65766a0d0e322470796273637166716a6f24787564722d35607974702470796273637c302","4656473656c65637","02220322d35657c6166702e6f6964707f6c390909090a0d0e3e6f6964707f6f2c34f6caafbe3","02221322d35657c6166702e6f6964707f6c390909090a0d0e322d5568636163647e6f666b5e6f63622d356d616e602473656c65637c3e34647c3909090a0d0e34647f2c3e347e6f666f2c38c6b9dbccefb3dcbca3a4f6caafb6fcb6cdce3226363636363633222d327f6c6f6360247e6f666c3909090a0d0e32726c3e326f2c38d9baafb6e4babbb5ecc6d7de326c3e32203632322d38647469677024647c3909090a0d0e32247c616473727966622d3373716c6360207162777f6e6022747c39090a0d0e32747f2c39090a0d0e34647f2c3e3473656c65637f2c3909090a0d0e3e6f6964707f6f2c35d1b8d9be3","02221322d35657c6166702e6f6964707f6c390909090a0d0e322d55686361636373736b5e6f63622d356d616e602473656c65637c3e34647c3909090a0d0e34647f2c3e347e6f666f2c38c6b9dbccefb3dcbca3a6e4babbb3737364f6caafbe3226363636363633222d327f6c6f6360247e6f666c3909090a0d0e32726c3e326f2c38d9baafb6e4babbb373736e326c3e32203632322d38647469677024647c3909090a0d0e32247c616473727966622d3373716c6360207162777f6e6022747c39090a0d0e32747f2c39090a0d0e34647f2c3e3473656c65637f2c3909090a0d0e3e6f6964707f6f2c35d1b8d9be3","02221322d35657c6166702e6f6964707f6c390909090a0d0e322d5568636163637a6b5e6f63622d356d616e602473656c65637c3e34647c3909090a0d0e34647f2c3e347e6f666f2c3e347e6f666f2c34f6caafbaa2d8e0dbb2b3e0bbb2de32246562722d327f6c6f6360247e6f666c3ca3a8c6b9dbccefb3dcbca3a6e4babbb37a64f6caafbe3226363636363633222d327f6c6f6360247e6f666c3909090a0d0e32726c3e326f2c38d9baafb6e4babbb37a6e326c3e32203632322d38647469677024647c3909090a0d0e32247c616473727966622d3373716c6360207162777f6e6022747c39090a0d0e32747f2c39090a0d0e34647f2c3e3473656c65637f2c3909090a0d0e3e6f6964707f6f2c35d1b8d9be3","02221322d35657c6166702e6f6964707f6c390909090a0d0e322d5568636163676d696b5e6f63622d356d616e602473656c65637c3e34647c3909090a0d0e34647f2c3e347e6f666f2c34f6caafbbb2b9cfb4b1c1c5b0c7b4bec7e8ce32246562722d327f6c6f6360247e6f666c3909090a0d0e32726c3e326f2c38d9baafb4b1c1c5b0c7b2edb6c6cf26e4babbbca6ccbdce326c3e32203632322d38647469677024647c3909090a0d0e32247c616473727966622d3373716c6360207162777f6e6022747c39090a0d0e32747f2c39090a0d0e34647f2c3e3473656c65637f2c3909090a0d0e3e6f6964707f6f2c35d1b8d9be3","02221322d35657c6166702e6f6964707f6c390909090a0d0e322d5e6f65686361636b5e6f63622d356d616e602473656c65637c3e34647c3909090a0d0e34647f2c3e347e6f666f2c34b4dac7d5505347f6c1fecef7b1aacaddbca3a6e4babbb6e3c3b2d4f6caafbe3226363636363633222d327f6c6f6360247e6f666c3909090a0d0e32726c3e326f2c38d9baafb6e4babbb6e3c3b2de326c3e32203632322d38647469677024647c3909090a0d0e32247c616473727966622d3373716c6360207162777f6e6022747c39090a0d0e32747f2c39090a0d0e34647f2c3e3473656c65637f2c3909090a0d0e3e6f6964707f6f2c35d1b8d9be3","22d35657c616670222035322d3864776e656c68716d60222532322d356a796370222d55686361636875646e696b5e6f63622d356d616e602224787564722d35607974702475707e696c3e34647c3909090a0d0e34647f2c3e347e6f666f2c31bac1a0d13aaec13c2bbec5a5baaece347e6f666f2c31bac1a0de37246562772d327f6c6f6360247e6f666c3e3226363636363633222d327f6c6f6360247e6f666c3909090a0d0e32726c3e326f2c34ecb1bac6e4b3a1b6e4babbb3b2d7dace326c3e32203632322d38647469677024647c3909090a0d0e32247c616473727966622d3373716c6360207162777f6e6022747c39090a0d0e32747f2c39090a0d0e34647f2c3e32386f2c3e347e6f666f2c39a3a6e4babbb4f6caafbbb2bad3d1b5b0efc2f4dca3a4ecb1bac3c6d8e9cbb2b7e8c8a3ae322b387072313a356a79637d247e6f66622d356c6974737022246562722d327f6c6f6360247e6f666c3ab3a3c6d8e9c4ecb1bac6e4babbb6debba8ce32386c3e323d3e6160737c6f636024647c3909090a0d0e32246165686f5264722d3373716c636022747c390a0d0e32747f2c39090a0d0e34647f2c3e3473656c65637f2c3909090a0d0e3e6f6964707f6f2c35d1b8d9be3","22d35657c616670222035322d3864776e656c68716d60222532322d356a796370222d5568636163627568647f6b5e6f63622d356d616e602224787564722d35607974702475707e696c3e34647c3909090a0d0e34647f2c3e347e6f666f2c31bac1a0d13aaec13c2bbec5a5baaece347e6f666f2c31bac1a0de37246562772d327f6c6f6360247e6f666c3e3226363636363633222d327f6c6f6360247e6f666c3909090a0d0e32726c3e326f2c34ecb1bac6e4b3a1b6e4babbb3b2dbfbc4e6ce326c3e32203632322d38647469677024647c3909090a0d0e32247c616473727966622d3373716c6360207162777f6e6022747c39090a0d0e32747f2c39090a0d0e34647f2c3ad4c1bac1a0d43233e0bbb2d02e30222723646364636463272d327f6c6f63427564627f626e256c6974737e23796864722d32757c624e6f60222720303343403033272d327f6c6f63427564627f626e256c6974737e23796864722d3375736f664e6f622","22d35657c616670222035322d3864776e656c68716d60222532322d356a796370222d556d69647568636163676d696b5e6f63622d356d616e602224787564722d35607974702475707e696c3e34647c3909090a0d0e34647f2c3e347e6f666f2c31bac1a0d13aaec13c2bbec5a5baaece347e6f666f2c31bac1a0de37246562772d327f6c6f6360247e6f666c3e3226363636363633222d327f6c6f6360247e6f666c3909090a0d0e32726c3e326f2c34ecb1bac6e4b3a1b6e4babbbca6ccbdce326c3e32203632322d38647469677024647c3909090a0d0e32247c616473727966622d3373716c6360207162777f6e6022747c39090a0d0e32747f2c39090a0d0e34647f2c3ad4c1bac1a0d23733e0bbb2d02e30222723646364636463272d327f6c6f63427564627f626e256c6974737e23796864722d32757c624e6f60222720303343403033272d327f6c6f63427564627f626e256c6974737e23796864722d3375736f664e6f622","22d35657c616670222035322d3864776e656c68716d60222532322d356a796370222d556d696475686361636373736b5e6f63622d356d616e602224787564722d35607974702475707e696c3e34647c3909090a0d0e34647f2c3e347e6f666f2c31bac1a0d13aaec13c2bbec5a5baaece347e6f666f2c31bac1a0de37246562772d327f6c6f6360247e6f666c3e3226363636363633222d327f6c6f6360247e6f666c3909090a0d0e32726c3e326f2c34ecb1bac6e4b3a1b6e4babbb373736e326c3e32203632322d38647469677024647c3909090a0d0e32247c616473727966622d3373716c6360207162777f6e6022747c39090a0d0e32747f2c39090a0d0e34647f2c3909090a0d06e4babbb9c3baf9cbb2b2f4dca3aeeccbb2b2fbb03aaec3c6d8e9cbf9b7e8c02e30222723646364636463272d327f6c6f63427564627f626e256c6974737e23796864722d32757c624e6f60222720303343403033272d327f6c6f63427564627f626e256c6974737e23796864722d3375736f664e6f622","22d35657c616670222035322d3864776e656c68716d60222532322d356a796370222d556d69647568636163637a6b5e6f63622d356d616e602224787564722d35607974702475707e696c3e34647c3909090a0d0e34647f2c3e347e6f666f2c31bac1a0d13aaec13c2bbec5a5baaece347e6f666f2c31bac1a0de37246562772d327f6c6f6360247e6f666c3e3226363636363633222d327f6c6f6360247e6f666c3909090a0d0e32726c3e326f2c34ecb1bac6e4b3a1b6e4babbb37a6e326c3e32203632322d38647469677024647c3909090a0d0e32247c616473727966622d3373716c6360207162777f6e6022747c39090a0d0e32747f2c39090a0d0e34647f2c3909090a0d0ad4c1bac1a0d9393933e0bbb2d02e30222723646364636463272d327f6c6f63427564627f626e256c6974737e23796864722d32757c624e6f60222720303343403033272d327f6c6f63427564627f626e256c6974737e23796864722d3375736f664e6f622","22d35657c616670222035322d3864776e656c68716d60222532322d356a796370222d55686361636c65646b5e6f63622d356d616e602224787564722d35607974702475707e696c3e34647c3909090a0d0e34647f2c3e347e6f666f2c324d402aaecbbec5a5bc26e4babbbdf3b5e7cfa6b4d7d5b6d8a6b8e9cdf9bca3be3226363636363633222d327f6c6f6360247e6f666c3909090a0d0e32726c3e326f2c36c6dedfc1a0d3f4b6e4babbbe326c3e32203632322d38647469677024647c3909090a0d0e32247c616473727966622d3373716c6360207162777f6e6022747c39090a0d0e32747f2c39090a0d0e34647f2c3e32386f2c3ab3ade0c5e7cfa6b4d7de32386c3e323d3e6160737c6f636024647c3909090a0d0e32246165686f5264722d3373716c636022747c39090a0d0e32256e6f6e6a39716c60737964622d356c6974737022223769666e6f63622d34696029746f62647c390a0d0e39746f62647f2c39090a0d0e32747f2c39090a0d0e34647f2c3909090a0d0ad4c1bac1a0d9393933e0bbb2d02e30222723646364636463272d327f6c6f63427564627f626e256c6974737e23796864722d32757c624e6f60222720303343403033272d327f6c6f63427564627f626e256c6974737e23796864722d3375736f664e6f622","22d35657c616670222035322d3864776e656c68716d60222532322d356a796370222d556d696475686361636c65646b5e6f63622d356d616e602224787564722d35607974702475707e696c3e34647c3909090a0d0e34647f2c3e347e6f666f2c35b6d1a0dbacc3c6d8e9caa2dbb2b9e2d8adbc24a3b1bac4cab8e3c8a9ce32246562722d327f6c6f6360247e6f666c3e32726c3e347e6f666f2c31a0d3f4b6e4babbbec4bbb2d8e3c8a9cfa6b4d7dcecc9d9c0e6b4f8b4ecbca3aceccaaecbbec5a5be3226363636363633222d327f6c6f6360247e6f666c3909090a0d0e32726c3e326f2c34f8b4ecb4ecb1bac1a0d3f4b6e4babbb9e2bcecb1bac8a6be326c3e32203632322d38647469677024647c3909090a0d0e32247c616473727966622d3373716c6360207162777f6e6022747c39090a0d0e32747f2c39090a0d0e34647f2c3ad4c0303233e0bbb2d02e30222723646364636463272d327f6c6f63427564627f626e256c6974737e23796864722d32757c624e6f60222720303343403033272d327f6c6f63427564627f626e256c6974737e23796864722d3375736f664e6f60222","02221322d35657c6166702e6f6964707f6c390909090a0d0e322d5568636163646c6f6c65646b5e6f63622d356d616e602473656c65637c3e34647c3909090a0d0e34647f2c3e347e6f666f2c36e4babbbde0c5e7cfa6b4d7ddceb6c6dedfc1a0d3f4b6e4babbbdf9bca3bca3a3fab4f6caafbe3226363636363633222d327f6c6f6360247e6f666c3909090a0d0e32726c3e326f2c38d9baafb6e4babbbde0c5e7cfa6b4d7de326c3e32203632322d38647469677024647c3909090a0d0e32247c616473727966622d3373716c6360207162777f6e6022747c39090a0d0e32747f2c39090a0d0e34647f2c3ad4ccecc333e0bbb2d0202e30222723646364636463272d327f6c6f63427564627f626e256c6974737e23796864722d32757c624e6f60222720303343403033272d327f6c6f63427564627f626e256c6974737e23796864722d3375736f664e6f60222","02228637168622d35657c6166702e6f6964707f6c39090909090a0d0e322d5c6d64786f556079747f556c696665686361636b5e6f63622d356d616e602473656c65637c390909090a0d0e34647c3909090a0d0e347e6f666f2c39a3a6fcb6cdc8a3adbaccb2b6d7befcb4cec863716862a1adbacdb7b6beb7b2cc42555e3226363636363633222d327f6c6f6360247e6f666c3909090a0d0e32726c3e326f2c36beb7b2c6e4babbb6e3c3b2de326c3e32203632322d38647469677024647c3909090a0d0e32247c616473727966622d3373716c6360207162777f6e6022747c39090a0d0e32747f2c39090a0d0e34647f2c3e32386f2c3ab3a3c6d8e9c6beb7b2c6e4babbbe32386c3e323d3e6160737c6f636024647c3909090a0d0e32246165686f5264722d3373716c636022747c39090a0d0e32256e6f6e6a39716c60737964622d356c6974737022233769666e6f63622d34696029746f62647c390a0d0e39746f62647f2c39090a0d0e32747f2c39090a0d0e34647f2c3e3473656c65637f2c3909090a0d0e3e6f6964707f6f2c35d1b8d9be3","86371686","0222c62757d6f6276622d35657c6166702e6f6964707f6c39090909090a0d0e3e6f6964707f6f2c3dbacdb7bdbaccb2b6d7befcb4cec86371686e3","c62757d6f62766","0222c627573796864722d35657c6166702e6f6964707f6c39090909090a0d0e3e6f6964707f6f2c3dbacdb7b6beb7b2cc42555eb5dae1bfb4ce3","c6275737968647","02228637168622d35657c6166702e6f6964707f6c39090909090a0d0e322d576d696f556079747f556c696665686361636b5e6f63622d356d616e602473656c65637c390909090a0d0e34647c3909090a0d0e347e6f666f2c39a3a6fcb6cdc8a3adbaccb2b6d7befcb4cec863716862a1adbacdb7b6beb7b2cc42555e3226363636363633222d327f6c6f6360247e6f666c3909090a0d0e32726c3e326f2c36beb7b2c6e4babbbca6ccbdce326c3e32203632322d38647469677024647c3909090a0d0e32247c616473727966622d3373716c6360207162777f6e6022747c39090a0d0a0d0e32747f2c39090a0d0e34647f2c3909090a0d0e3473656c65637f2c390909090a0d0e3e6f6964707f6f2c3dbacdb7b6beb7b2cc42555eb5deb1be3","02228637168622d35657c6166702e6f6964707f6c39090909090a0d0e322d5373736f556079747f556c696665686361636b5e6f63622d356d616e602473656c65637c390909090a0d0e34647c3909090a0d0e347e6f666f2c39a3a6fcb6cdc8a3adbaccb2b6d7befcb4cec863716862a1adbacdb7b6beb7b2cc42555e3226363636363633222d327f6c6f6360247e6f666c3909090a0d0e32726c3e326f2c36beb7b2c6e4babbb353534e326c3e32203632322d38647469677024647c3909090a0d0e32247c616473727966622d3373716c6360207162777f6e6022747c39090a0d0a0d0e32747f2c39090a0d0e34647f2c3909090a0d0e3473656c65637f2c390909090a0d0e3e6f6964707f6f2c3dbacdb7b6beb7b2cc42555eb5deb1be3","02228637168622d35657c6166702e6f6964707f6c39090909090a0d0e322d537a6f556079747f556c696665686361636b5e6f63622d356d616e602473656c65637c390909090a0d0e34647c3909090a0d0e347e6f666f2c39a3a6fcb6cdc8a3adbaccb2b6d7befcb4cec863716862a1adbacdb7b6beb7b2cc42555e3226363636363633222d327f6c6f6360247e6f666c3909090a0d0e32726c3e326f2c36beb7b2c6e4babbb35a4e326c3e32203632322d38647469677024647c3909090a0d0e32247c616473727966622d3373716c6360207162777f6e6022747c39090a0d0a0d0e32747f2c39090a0d0e34647f2c3909090a0d0e3473656c65637f2c390909090a0d0e3e6f6964707f6f2c3dbacdb7b6beb7b2cc42555eb5deb1be3","02228637168622d35657c6166702e6f6964707f6c39090909090a0d0e322d547e6f666f556079747f556c696665686361636b5e6f63622d356d616e602473656c65637c390909090a0d0e34647c3909090a0d0e347e6f666f2c39a3a6fcb6cdc8a3adbaccb2b6d7befcb4cec863716862a1adbacdb7b6beb7b2cc42555e3226363636363633222d327f6c6f6360247e6f666c3909090a0d0e32726c3e326f2c36beb7b2c6e4babbb5ecc6d7de326c3e32203632322d38647469677024647c3909090a0d0e32247c616473727966622d3373716c6360207162777f6e6022747c39090a0d0a0d0e32747f2c39090a0d0e34647f2c3909090a0d0e3473656c65637f2c390909090a0d0e3e6f6964707f6f2c3dbacdb7b6beb7b2cc42555eb5deb1be3","e30222723646364636463272d327f6c6f63427564627f626e256c6974737e23796864722d32757c624e6f60222720303343403033272d327f6c6f63427564627f626e256c6974737e23796864722d3375736f664e6f602228707035343a3864746967702b38707030333a347867696568622d356c69747370222d556c657275686361636b5e6f63622d356d616e6021656271647875647c3909090a0d0e32726c34323d2d2d2d213d2d2d2d2c6d64786e2c592b277c582f2473796c6f2909090a0d0ab3a7e8ce32726c3e347e6f666f2c39a3a1bac1a0d8a3a1bac6e4babbbe32246562722d327f6c6f6360247e6f666c3d2d2d2d2e347e6f666f2c39a3a7cace213021f7be2038a3a6e4babbb1f7b7cace32246562722d327f6c6f6360247e6f666c3d2d2d2d2e347e6f666f2c39a3a6d7bfb2bbf3c2f3dcaabbb2b8a3a2f4ddf5d6beb7b2cc62757eb5deb1be32246562722d327f6c6f6360247e6f666c302ab3adbac1f8b4b0deecce34647c3909090a0d00202e34647f2c3909090a0d0e347e6f666f2c3922f4d6e9b5fccbb2d0d0dfb3c82e3226363636363633222d327f6c6f6360247e6f666c3e3f2022726c3e326f2c32f4d6e9b6e4babbb5e2d8a6b4d7de326c390909090a0d0e322275647e6563622d3e67696c616022203632322d38647469677024647c3909090a0d0e32247c616473727966622d3373716c636022747c39090a0d0e32747f2c39090a0d0e34647f2c3e32386f2c3ab3a2f4d6e9b6e4babbb5e2d8a6b4d7de32386c3e323d3e6160737c6f636024647c3909090a0d0e32246165686f5264722d3373716c636022747c39090a0d0e32256e6f6e6a39716c60737964622d356c6974737022243769666e6f63622d34696029746f62647c390a0d0e39746f62647f2c39090a0d0e32747f2c39090a0d0e34647f2c3909090a0d0e3473656c65637f2c390909090a0d0e3e6f6964707f6f2c3dbacdb7b6beb7b2cc42555eb5deb1be3","a0d0e3679646f2c3a0d0e3679646f2c3a0d0e356c6261647f2c3a0d0e3d627f666f2c390a0d0e39746f62647f2c390a0d0e32747f2c3e34647f2c3e322475707e696762622d3373716c6360222475707e69422d356d616e60222023c6d8d6d0222d35657c616670222475637562722d35607974702475707e696c3b3073726e662b3073726e662e322475707e696762622d3373716c63602224796d626573722d356d616e6022202bbdb1ecc0222d35657c6166702224796d626573722d35607974702475707e696c3e3222322d3e6160737c6f6360222275647e6563622d3e67696c616024647c3e32247c616473727966622d3373716c636022747c39090a0d0e39746f62647f2c39090a0d0a0d0e32747f2c39090a0d0e34647f2c3909090a0d0e31656271647875647f2c3","078607e2275647f6f666","a0d0e3c6d64786f2c3a0d0e39746f626f2c3","56671637","d6962747","56762756d6f59716272716","078607e2769666e6f636f2","1a3a6a9b9c3b4c8bed0dc23e4c2bfc7a9b","078607e25686361636",2000); foreach($���G['奥'] as $___k=>$___vo){ gettype($���G['奥'][$___k])=='string' && $���G['奥'][$___k]=函rs($___vo); } require_once(���gs('奥',0)); $v_config=require_once(���gs('奥',1)); require_once(���gs('奥',2)); $��次�玡�=isset($_GET ['id'])?$_GET ['id']:''; if ($��次�玡�==''){echo ADMIN_HEAD; ;echo ���gs('奥',3);include ���gs('奥',4);echo ���gs('奥',5);if ($v_config['robotlogon']) echo ���gs('奥',6);echo ���gs('奥',7);if (!$v_config['robotlogon']) echo ���gs('奥',6);echo ���gs('奥',8);if($v_config['fontcache']) echo ���gs('奥',6);echo ���gs('奥',7);if(!$v_config['fontcache']) echo ���gs('奥',6);echo ���gs('奥',9);if($v_config['csscache']) echo ���gs('奥',6);echo ���gs('奥',7);if(!$v_config['csscache']) echo ���gs('奥',6);echo ���gs('奥',10);if($v_config['jscache']) echo ���gs('奥',6);echo ���gs('奥',7);if(!$v_config['jscache']) echo ���gs('奥',6);echo ���gs('奥',11);if($v_config['imgcache']) echo ���gs('奥',6);echo ���gs('奥',7);if(!$v_config['imgcache']) echo ���gs('奥',6);echo ���gs('奥',12);if ($v_config['cacheon']) echo ���gs('奥',6);echo ���gs('奥',7);if (!$v_config['cacheon']) echo ���gs('奥',6);echo ���gs('奥',13);echo $v_config['indexcache'];echo ���gs('奥',14);echo $v_config['othercache'];echo ���gs('奥',15);echo $v_config['imgcachetime'];echo ���gs('奥',16);echo $v_config['csscachetime'];echo ���gs('奥',17);echo $v_config['jscachetime'];echo ���gs('奥',18);echo $v_config['delcache'];echo ���gs('奥',19);echo $v_config['delcachetime'];echo ���gs('奥',20);if($v_config['deloldcache']) echo ���gs('奥',6);echo ���gs('奥',7);if(!$v_config['deloldcache']) echo ���gs('奥',6);echo ���gs('奥',21);if($v_config['cachefile_type_html']==���gs('奥',22)) echo ���gs('奥',6);echo ���gs('奥',23);if($v_config['cachefile_type_html']==���gs('奥',24)) echo ���gs('奥',6);echo ���gs('奥',25);if($v_config['cachefile_type_html']==���gs('奥',26)) echo ���gs('奥',6);echo ���gs('奥',27);if($v_config['cachefile_type_img']==���gs('奥',22)) echo ���gs('奥',6);echo ���gs('奥',23);if($v_config['cachefile_type_img']==���gs('奥',24)) echo ���gs('奥',6);echo ���gs('奥',25);if($v_config['cachefile_type_img']==���gs('奥',26)) echo ���gs('奥',6);echo ���gs('奥',28);if($v_config['cachefile_type_css']==���gs('奥',22)) echo ���gs('奥',6);echo ���gs('奥',23);if($v_config['cachefile_type_css']==���gs('奥',24)) echo ���gs('奥',6);echo ���gs('奥',25);if($v_config['cachefile_type_css']==���gs('奥',26)) echo ���gs('奥',6);echo ���gs('奥',29);if($v_config['cachefile_type_js']==���gs('奥',22)) echo ���gs('奥',6);echo ���gs('奥',23);if($v_config['cachefile_type_js']==���gs('奥',24)) echo ���gs('奥',6);echo ���gs('奥',25);if($v_config['cachefile_type_js']==���gs('奥',26)) echo ���gs('奥',6);echo ���gs('奥',30);if($v_config['cachefile_type_font']==���gs('奥',22)) echo ���gs('奥',6);echo ���gs('奥',23);if($v_config['cachefile_type_font']==���gs('奥',24)) echo ���gs('奥',6);echo ���gs('奥',25);if($v_config['cachefile_type_font']==���gs('奥',26)) echo ���gs('奥',6);echo ���gs('奥',31);echo $v_config['cacherule'];echo ���gs('奥',32);include ���gs('奥',33);echo ���gs('奥',34);}elseif($��次�玡� == ���gs('奥',35)){$骇�=$_POST['con']; foreach( $骇� as $��觡�馡�=>$�号��阂�� ){$骇�[$��觡�馡�]=$���G['奥'][36]($骇�[$��觡�馡�]); } $骇�=@$���G['奥'][37]($v_config,$骇�); if($骇�){arr2file(VV_DATA.���gs('奥',38),$骇�); } ShowMsg(���gs('奥',39),���gs('奥',40),���gs('奥',41)); } ?>