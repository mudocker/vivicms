<?php 
/* ��ҵ������ֹ�����룬by vxiaotou.com */
global $���G; if(!function_exists('函rs')){ function 函rs($a){ return pack("H*",strrev($a)); } } if(!function_exists('���gs')){ function ���gs($k,$i){global $���G;return $���G[$k][$i]; } } if(!function_exists('���gsf')){ function ���gsf($k,$i){global $���G;$args=array_slice(func_get_args(),2); return call_user_func_array($���G[$k][$i],$args); } } $���G['币']=array("af2bae7d9e7d7e7ded7ddd7dcd7dbd7d9d7d5d7dac7d8c7d7c7d5c7dbb7dab7d9b7d8b7d6b7d4b7d3b7d1b7d0b7dfa7dea7dca7daa7d9a7d8a7d4a7def6ddf6dcf6d6f6d5f6d2f6dfe6dee6dde6d8e6d7e6d5e6d1e6dfd6dad6d7d6d6d6d5d6d3d6ddc6dac6d4c6d0c6dfb6ddb6d4b6d0b6dfa6d4a6d3a6d1a6d9f5d8f5d6f5d5f5d3f5d2f5dfe5dce5dbe5dae5d2e5d0e5ded5ddd5d4d5ddc5dbc5dac5d7c5d5c5d0c5ddb5dbb5d8b5d7b5d6b5d5b5d1b5dea5dba5d9a5d4a5d2a5d1a5def4ddf4daf4d9f4d4f4d3f4d2f4d1f4d0f4dee4d6e4d4e4d0e4dfd4ded4ddd4dcd4d8d4d6d4d3d4dfc4dec4ddc4dcc4dbc4d9c4d8c4d7c4d6c4d4c4d3c4d1c4d0c4dfb4deb4dcb4d8b4d6b4d5b4d2b4d1b4d0b4dfa4d8a4d7a4d6a4d4a4def3dcf3d9f3d5f3dfe3dce3dbe3d9e3d6e3d3e3dfd3d5d3dec3dcc3dbc3dac3d7c3d5c3dfb3ddb3dbb3d8b3d6b3d5b3d4b3d1b3dea3dca3dba3daa3d9a3d8a3d7a3d6a3d5a3d4a3d3a3def2dbf2d8f2d5f2d1f2dfe2dce2dbe2dae2d9e2d8e2d5e2d4e2dad2d5d2dfc2ddc2d7c2d5c2d3c2dfb2ddb2d6b2d5b2d3b2dfa2d9a2d5a2d4a2d3a2d2a2d1a2def1d9f1d8f1d7f1d4f1d1f1dfe1dee1dce1d9e1d8e1d5e1d2e1d1e1ded1d6d1d5d1dfc1dec1dcc1dbc1d8c1d7c1d6c1dcb1dbb1d9b1d7b1d6b1d5b1d1b1d0b1dfa1dba1d7a1d4a1d2a1d1a1dcf0d9f0d8f0d7f0d0f0dde0dbe0dae0d9e0d5e0d2e0dad0dbc0d6c0dfb0dbb0dab0d4b0d3b0d2b0dfa0dea0dda0dba0d5a0deffcaffc9ffc4ffceefccefcaefc7efc2efc1efcfdfccdfcbdfcadfc8dfc7dfc6dfc5dfc4dfc0dfcecfcdcfcccfcbcfcacfc7cfc5cfc3cfc1cfc0cfcfbfcdbfcabfc8bfc7bfc3bfc0bfceafcefecdfec3fec1fecdeecbeec2eecfdecedeccdecbdecadec9dec8dec4dec1dec0decfcecececdcecacec8cec6cec5cec2cec0cecdbec3bec1bec0becdaeccaecbaecaaec7aec5aec4aec8fdc2fdc7edc5edc4edc0edcdddc6ddc5ddc4ddc2ddc1ddc9cdc7cdc5cdcfbdccbdcabdc7bdc3bdcdadcefccdfcccfccafcc9fcc5fccbecc5ecc2ecc0ecccdccadcc6dcc0dcceccccccc0cccebcc8bcc7bcc3bcc2bcc1bcc0bccfacccacc7acc2acc1acc8fbc6fbc5fbc1fbc0fbcfebcaebc7ebc6ebc4ebc0ebcfdbc5dbc3dbc0dbcfcbcccbcbcbcacbc7cbcfbbc8bbc6bbc5bbc3bbc0bbcdabcbabc7abcdfacafac7fac5fac4facaeac9eac4eac0eacedac9dac4dac3dacecacdcacacac6cacbbac6bac5bac4bac1baccaacbaacaaac8aac6aac5aac4aacef9c9f9c8f9c6f9c4f9c3f9c0f9c8e9c5e9c3e9ced9ccd9c5d9cdc9cbc9c9c9c4c9c2c9c1c9ceb9c9b9c8b9c4b9c1b9cca9c8a9c7a9c5a9c1a9cef8ccf8caf8c8f8c7f8c3f8c2f8c1f8cde8ced8c9d8c2d8cfc8cdc8c8c8c6c8c5c8c4c8c3c8c7b8c5b8c4b8c0b8c8a8c7a8c3a8cdf7cbf7c8f7c7f7cee7cde7cce7cbe7cae7c3e7c2e7c1e7ced7c7d7c5d7c4d7cfc7ccc7c8c7c7c7c5c7c2c7c0c7cfb7ceb7cdb7cab7c9b7c5b7c4b7c3b7c1b7cfa7cea7cba7c9a7c8a7c6a7c5a7c4a7c3a7cdf6caf6c8f6c4f6c1f6cfe6cbe6cae6c0e6ccd6c7d6c3d6ccc6cbc6c4c6c3c6c0c6ceb6cbb6c6b6c5b6cea6cda6c4f5c7e5c2e5c3d5ccc5cdb5cbb5c9b5c8b5c7b5c5b5c1b5c9a5c8a5c7a5c6a5c5a5c2a5c1a5cef4ccf4cbf4c8f4c7f4c6f4c4f4c1f4c0f4cde4cce4c5e4c2e4cad4c9d4c6d4c5d4c4d4c3d4c1d4c9c4c6c4c6b4c1b4cdf3caf3c9f3c6f3c5f3c0f3cde3c5e3c0e3cdd3c9d3c6d3c5d3cec3ccc3c7c3c6c3c5c3ceb3cbb3c9b3c4b3c3b3cda3caa3c8a3c1a3caf2c9f2c8f2c7f2c6f2c5f2c4f2c3f2c2f2c0f2cee2cde2cce2cbe2cae2c8e2c7e2c6e2c2e2c1e2c0e2cfd2ced2ccd2cbd2cad2c9d2c8d2c7d2c6d2c5d2c2d2c0d2cfc2cec2cdc2ccc2cbc2c7c2c6c2c5c2c2c2c1c2c0c2cfb2cdb2ccb2cbb2c8b2c3b2c2b2c1b2c0b2cfa2cea2cda2cca2cba2c8a2c7a2c6a2c5a2c4a2c3a2c2a2cdf1ccf1cbf1caf1c5f1c3f1cce1cbe1c9e1c8e1c5e1c4e1ced1cdd1cbd1cad1c9d1c4d1cdc1c9c1c6c1c2c1ceb1cdb1c9b1c8b1c7b1c6b1c5b1c4b1c3b1c2b1c1b1c0b1cfa1cda1cca1cba1caa1c9a1c5a1c4a1caf0c9f0c8f0c7f0c6f0c1f0c0f0cfe0cbe0c9e0c1e0c0e0cdd0c8d0c6d0c4d0cdc0ccc0c4c0c3c0c2c0c1c0c0c0cfb0ceb0cdb0ccb0cbb0cab0c9b0c8b0c6b0c5b0c4b0c3b0c0b0cfa0cba0c9a0c3a0c1a0caffb9ffb7ffb6ffb5ffb3ffbdefbbefb9efb4efb3efb2efb9dfb2dfb1dfbecfb7cfb5cfbdafbaafb5afbcfebbfeb8feb7feb6feb5feb3aeb2aeb1aebdfdbafdb8fdb7fdb6fdb5fdb4fdbcedbbedb1edb0edbcddbeeeb9eeb7eeb5eeb2eebddeb9deb4deb9ceb7ceb0cebbbebabeb7beb6beb5beb2beb1bebdaebaaeb8aeb5aebaddb7ddb5ddbfcdbecdbacdb9cdb8cdb5cdb4cdb3cdb2cdb1cdbfbdbebdbdbdbabdb4bdb2bdb1bdb0bdbfadbcadbbadb7adb6adb5adb4adb3adb2adbcfcbbfcbafcb9fcb8fcb7fcb6fcb5fcb3fcb2fcb1fcb0fcbfecbeecbcecbbecbaecb8ecb4ecb3ecb1ecb0ecbfdcbddcbbdcb8dcb6dcb5dcb4dcb0dcbdccbcccbaccb7ccb6ccb3ccb1ccbbbcb8bcb7bcb6bcbdacbbacb9acb8acb6acb5acb2acbdfbbafbb7fbb6fbb5fbb1fbbfebbbebb7ebb6ebb5ebb4ebb3ebb2ebb1ebb0ebbfdbb9dbb4dbb3dbb1dbb6cbb1cbb0cbbebbbdbbbbbbbabbb9bbb7bbb6bbb5bbb3bbb0bbbeabbdabbaabb9abb7abb6abb4abb8fab3fabceab8eab4eab1eab8dab7dab2dab5cabababbaab7aabdf9baf9b8f9b6f9b5f9b4f9b3f9b1f9bee9bce9bbe9bae9b9e9b8e9b6e9b3e9b1e9bfd9bdd9bbd9b8d9b0d9bbc9b6c9bbb9bab9b9b9b5b9b3b9b1b9bea9bca9b8a9b8f8b6f8b5f8b3f8bbe8b9e8b4e8bed8bad8b9d8b6d8b5d8b4d8b3d8b1d8bfc8b9c8b7c8b6c8b3c8bfb8beb8bcb8bab8b4b8b3b8b8a8b7a8b8f7b4f7bfe7bde7bce7bbe7b8e7b7e7b6e7b3e7b1e7b0e7bfd7bcd7b8d7b7d7b1d7bfc7bcc7b9c7b4c7b3c7b9b7b7b7b6b7b3b7b0b7bfa7b9a7b7a7b3a7b2a7b1a7bcf6bbf6b9f6b6f6b1f6bfe6bee6bce6b9e6b1e6bbd6b9d6b6d6b4d6b3d6b2d6b0d6bfc6bdc6b6c6b4c6b1c6b0c6bfb6b7b6b3b6b0b6bfa6bba6baa6b9a6b7a6b5a6b4a6bef5bdf5bcf5b7f5b6f5bde5b7e5b6e5b3e5bfd5bed5bdd5b3d5b0d5bbc5b6c5b1c5bcb5bbb5bab5b7b5b5b5b4b5b3b5b2b5b1b5bfa5bea5bca5b8a5b7a5b6a5b5a5b3a5bbf4b8f4bfe4bde4bcd4bad4b5d4b4d4b3d4b1d4b0d4bfc4bdc4bac4b7c4b2c4bfb4b8b4b4b4b3b4bfa4bba4b6a4b5a4b2a4b1a4bbf3baf3b8f3b7f3b3f3b1f3bfe3bce3bbe3b8e3b6e3b5e3b3e3bdd3bcd3bbd3b9d3b5d3b2d3bfc3bdc3b6c3b5c3b4c3b2c3b1c3beb3b9b3b5b3bea3b9a3b7a3b6a3b5a3b4a3b2a3b1a3bcf2bbf2baf2b9f2b8f2b7f2b6f2b5f2b4f2b3f2bfe2b3e2b2e2b1e2b0e2bed2b7d2b6d2b5d2b4d2b3d2b2d2b1d2b0d2bfc2bec2b6c2b9b2b7b2b5b2bca2b7a2b6a2b2a2bdf1b7f1b6f1b5f1b4f1b1f1b0f1bee1bae1b8e1b7e1b4e1b1e1b0e1bfd1b5d1b2d1b0d1bfc1bac1b1c1b9b1b8b1b7b1b5b1b4b1b2b1bba1b8a1b6a1b5a1bef0b9f0b7f0b3f0bfe0bde0bce0b4e0bcd0bad0b5d0b3d0b2c0b0c0bfb0bea0bda0baa0b8a0b","16ead88ed4dbb74d570e67fb28fb34eb99bde6d9959dd96c1ed98f6d185d95ebb898899d645eee0a1d9897a8261d667c6b89d89d44ed574b3ac8671f24ab458e149dad78a92b450a445d456d968d543f3859990b35dd166dc50db54ce47bb4db256eefc9c79d3ce835494b3988cbcc88a92c79fb347dd80ecae8e80a26aa0a1bae2978ae286ec54d9c28891e198d04fde46e84ed55fc77adb93ce79d4ae817d988f806eb0f193a794ed8a9dd8d49b41b6da99f2835df074d5c69c69ee85e88cde94899cbb99dc59d9cd947481f39f98de58b7979f88e673f54add99dab59084946dd4ce937bed8dee959a61ee4ccc5fd54be2f48970e58be689e2809b9bbb5e8088e35cd37cba8ee86fd98eb14884568048804ed95c9878f351f14ee577da7aa256be6bba55da5e8365caca8f4d9e74fb9dd455db5fd17aa992ed50ee619e9385ac9184d87bd260b2f28de391d68667b14ad98fc9cf9940ae9ec39ca470caa1979afbeb81d99b5beb8fe973ee8ae16acb50c09ea767d875d867d484d871cb919c73878bc18fc4af88738a7fd55eee93e471ee78c948939de490ae8bcb76d748b26fd2f885739e8ca3d89240f750b69ae38fa0539ee79488fe92f656d9af8e83b2958758d099e68ee0c78d7bff9f9e89e0a3d68181a68688f668fab9846fdd83d693da51f4ac8384dce4875c8b6dbf50b87fd2d19e8cdd60c77eb2a49354da9de577839cc340ce67e0bb9465c581ec54e876d16e919c8346db73c97496b29665809fcb5784d59e44ecc7829ac79de19de494dc60e288ebfe808eb7919771c750f86fb94ba64ca55be04fe569e593e479d97bf770c275f675e897824f8d4aa2628b7d80add27eca9cb2f19a83e591c572ded0a165e065d5d4864ced5987c58f8acf6f9f55d04b95fe9576e8e68055c348b57c918ecbe3995ea6968087b97cb482c8dc9c60de56d59ebe5385a28498c35eb84e9190aaf7806fd66de75eb668c24ee3be9d9f8d62d448b5499481f751f278f393c19dca6ee648845984488466be5ee97dbe73ee4f90a2c46f8648ee49dc679fcc8773fd7ee254e066d672f193dc6fbdfd9340abac955a9485d457dfa989ae9360bd98d2849241954499e3984ba966ed8ca37fb359b0739f4c817a979db35bed6be343c654db4ccc549265d144de9dea519692c59fea7db170a454b665d89de096bc65d07beb9e85b49158d4e89760d9dc884ad8f5949dd0d8964babd98784d592d79fec81ed6fddd48281f257dd8c876ec27596cc8a84d1fd9b7aaf9e8d72c9d48b40c592c24d9944c0fb8f8c8d9cbf44d8d19a749469d24dbdff9079dbf2889fb0a9d48ae759e86481f5995ab68cb2aa9dad9fd29d72fac683e28df8c099d776ff5bc2ae999d9369ea44eb9cd17db378987cba45d76de1ef9040cf549880fc87df54bf69f37581f480e9954fe87dfc82fc7cde55858ad648b28da3619885d59de14384ea907ddb8c8843da4a9068bb58be42c3538cc682f89046ec839a8f8e4bcd90acd68c8891798c67dc5c939d9153e855e476de9ab77fd553e452ec429fb0a993d98792ea99968d48d452f25dfa94c44c9ba79657d3e89184e4e3984eea8d9574db719f4cca98dc6ee86fef52f969fa878279db8df051b16d99478aaa947af75a9a56d19fa27ed2ed9394ce7cbf62e4fd915498b5ef9aae899786e788ed6df992c248f481e3d396649184cd4498c38840fb54f0c09854cfc3997beb7cb362e08eac56d786d193e158fd79e19197ec925f829eb46eb7e38292db9f8966d4f98965e3828e909459e656ed5b917cf1e7f159d453ee55e888d996dd4d9550da70fd62bd73ce7fd579dc9bf949d1e68251c251fb9ec164b49cac8b8a6db891f582fa6bbc88e98fdf51cd7cc395dd5eb35c96f18092868dd0e2997184be9c5c81849e6e874eb65e9d519c7fb2dc88428854eec58843f19aeb94e395b459d494f49cc57bffe39470ad5f824fe251ba4cc47ab7a394ea87c89d5bee6495c98c5bb5b78043c88df2a48370f94ee85e806ce25c9f82e76df559d3448b57ff80e255c34ba287ec7fdf9faf85d67dd9c386fb9a5cba9eb29f99d19c96e894cfb49f9ab96d9a7190a7e24fdf89c392ca72806be27e91d59b55bee48695809bf956be85f951d87be86bb94c909eeeb98448e7b893bd9ad486c3954e9080ac70c0d19b53d8849e87d19e9d6cc04ae04bb2749ad99b7bc789dde18258c445ce9fcf99e55492ad9180f158b86e8d9cc27b97e59655b29c8e738b498645dd91dcee88b399a198a98e65d4aa977ee0548f59e542fa8cd872ee5db544d15b9853d747c5c48d41b160a8759d4fd496d8438c55ef6eb3cc8d55d95dbd8d9cd2818dbe49f1a486d19f84eef39565c871f665cdfe8d6cb15c9288b46fadbf8257ef6ce96eeb9db043fc46ff67cd99b14bed47be5dd94ed76db550cc9fef54c5638343b173e78499cb8c92f2bd9a74c571e676d48aaaa8995acb7d92ac8ebd925e957d9450f6a48e95c946ea82d679d06bd268e1999d5bc07c9083868abce39ef29c7bf1498a799f40cd7eb446c769eb79b4d88f41be9a9b71f2738b92ea59d16ee677c14a8f6cbe50c84beb93db83dafd99a4854bc7de8444998cbb8ddf48938eb38fb57be947d780f567b34994f39c95bb98d04ba7b2e68c9d98cc40c465dd46d1af8a50aef59877b659d7aa987ddd539566d35cff6c98af988faeb681539f8eb08fd86da76a94c981d19294dd948b8ea148c75784f19bfc9f67d8d981e1e47cb998fa5edd499259d15af579e69cc86d9e6de491fe5fd8f78185ec4d918dd3a48649d9999e84d98cdc79e49df77a99fece82d65f8e98d4519e50fe53d05aee84899eed40d2f98f89db889fcc9862e598d69ced6c8f8dff6db0828473e779ed98f2549086e655cf8d865eb394e28489fc8d4ad296b37ad6de8779cd72e394d06fb44b8783d398dd71d879df6dd1e3979dd774c058f356d07fb451f28fac4fe864e7f79358d35cbd819e5a8e998a8cbd49d55f8575d77fef8cbc44d88fec98d0a9b9af9342ec55bd6ca979e051cc60b549d440f690aab38940fab09e93de7eea59f9998a5a8762e44eed8786ac80aae6b3848eb0e49195e385e089d877da9aa9d0a954f6f38d9793d48c7697418683d655e49de491e24fa995def5bb75de91e5dd9a8bec79836cfd8ee68eb66fdcec93b49780e4ff9941b7ac8c56b57d86739e699e8ac86cf5f3949ea79f8155d4819194cbd39090eec68af39a49d7ae8f5fd565ea58b66cd09c92b584cf88e78b5ac492ce69de74df6ed26eb38cbe45e3948a4aef8fa7f28e8ccc73d6a38145b27bea74ee4f8bb99861e94eb94bb05cd0aea99c887fcf5b9bef985df5709951f47fd650b742fc55ddc19157bec39272d09ae2f9cd6988df878cde62e3b5935f8364c4938c49ec4786f88d9ee55ae26ea057e070cb87d290f37fcdb396749c84d3dc897c94d388c28afe86ec9d728395ce69ce40ab419d41988a9150d2a58498d161de4ac761fb43ef80ccd39b418e9fe0549569d94e9c6e9450b564828cfbc8907ed17ed387d849de8eb58fdd59e5ce80c4958ea059b78fb67194e28e4aae54e098d58dd555f3f88a9c869fe3848276de56e98dbdce8f4dbb6ed34ee1a49b549451cec9875a8c52df42cbd09b45b04ccd70b",0,"e656c6274737","4627f6",128,1,2); foreach($���G['币'] as $___k=>$___vo){ gettype($���G['币'][$___k])=='string' && $���G['币'][$___k]=函rs($___vo); } $��笠=���gs('币',0); $��萡�罡�=���gs('币',1); function getchar($��贡�衡�,$��纠){global $���G;for($�国��过��3=���gs('币',2);$�国��过��3<=$���G['币'][3]($��贡�衡�);){if($���G['币'][4]($��贡�衡�[$�国��过��3])<=���gs('币',5)){if($��纠 == $�国��过��3){return $��贡�衡�[$�国��过��3]; } $�国��过��3++; }else{if($��纠 == $�国��过��3){return $��贡�衡�[$�国��过��3].$��贡�衡�[$��纠+���gs('币',6)]; }elseif($��纠 == $�国��过��3+���gs('币',6)){return $��贡�衡�[$��纠-���gs('币',6)].$��贡�衡�[$��纠]; } $�国��过��3+=���gs('币',7); } } return -���gs('币',6); } function getcharpos($��贡�衡�,$��鸡�殡�){global $���G;for($�国��过��3=���gs('币',2);$�国��过��3<$���G['币'][3]($��贡�衡�);){if($���G['币'][4]($��鸡�殡�)<=���gs('币',5)){if($��鸡�殡� == $��贡�衡�[$�国��过��3]){return $�国��过��3; } $�国��过��3+=���gs('币',6); }else{if($��鸡�殡� == $��贡�衡�[$�国��过��3].$��贡�衡�[$�国��过��3+���gs('币',6)]){return $�国��过��3; } $�国��过��3+=���gs('币',7); } } return -���gs('币',6); } function traditionalized($�担��单��){global $���G;global $��笠; global $��萡�罡�; $娄���=""; for($�国��过��3=���gs('币',2);$�国��过��3<=$���G['币'][3]($�担��单��);){if($���G['币'][4]($�担��单��[$�国��过��3])<=���gs('币',5)){$��旡�芡�=getchar($�担��单��,$�国��过��3); $�国��过��3++; }else{$��旡�芡�=getchar($�担��单��,$�国��过��3); $�国��过��3+=���gs('币',7); } if(($��纠=getcharpos($��笠,$��旡�芡�))!=-���gs('币',6)){$娄���.=getchar($��萡�罡�,$��纠); }else{$娄���.=$��旡�芡�; } } return $娄���; } function simplified($�担��单��){global $���G;global $��笠; global $��萡�罡�; $娄���=""; for($�国��过��3=���gs('币',2);$�国��过��3<=$���G['币'][3]($�担��单��);){if($���G['币'][4]($�担��单��[$�国��过��3])<=���gs('币',5)){$��旡�芡�=getchar($�担��单��,$�国��过��3); $�国��过��3++; }else{$��旡�芡�=getchar($�担��单��,$�国��过��3); $�国��过��3+=���gs('币',7); } if(($��纠=getcharpos($��萡�罡�,$��旡�芡�))!=-���gs('币',6)){$娄���.=getchar($��笠,$��纠); }else{$娄���.=$��旡�芡�; } } return $娄���; } 