<?php
/* ��ҵ�����ֹ�����룬by vxiaotou.com */
global $���G;
if (!function_exists('函rs')) {
    function 函rs($a) {
        return pack("H*", strrev($a));
    }
}
if (!function_exists('���gs')) {
    function ���gs($k, $i) {
        global $���G;
        return $���G[$k][$i];
    }
}
if (!function_exists('���gsf')) {
    function ���gsf($k, $i) {
        global $���G;
        $args = array_slice(func_get_args() , 2);
        return call_user_func_array($���G[$k][$i], $args);
    }
}
$���G['�?'] = array(
    "56e696665646",
    "450594253435",
    "875646e696",
    "56d616e6279646",
    "078607e236e696e2e6f6d6d6f636f236e696f2",
    "078607e2769666e6f636f2",
    "56c69666f53796",
    "078607e2979646f5e6f6964736e65766f2",
    "078607e2373716c636e296a6961636f236e696f2",
    "078607e247f626f627f236e696f2",
    "078607e23756c65727f2"
);
foreach ($���G['�?'] as $___k => $___vo) {
    gettype($���G['�?'][$___k]) == 'string' && $���G['�?'][$___k] = 函rs($___vo);
}
$���G['�?'][0](���gs('�?', 1) , ���gs('�?', 2));
require ($���G['�?'][3](__FILE__) . ���gs('�?', 4));
$v_config = require (VV_DATA . ���gs('�?', 5));
if ($���G['�?'][6](VV_INC . ���gs('�?', 7))) {
    require (VV_INC . ���gs('�?', 7));
}
require ($���G['�?'][3](__FILE__) . ���gs('�?', 8));
require ($���G['�?'][3](__FILE__) . ���gs('�?', 9));
require (VV_DATA . ���gs('�?', 10)); ?>
