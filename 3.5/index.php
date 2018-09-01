<?php
/* ÉÌÒµÈí¼þ½ûÖ¹·´±àÒë£¬by vxiaotou.com */
global $¾õèG;
if (!function_exists('å‡½rs')) {
    function å‡½rs($a) {
        return pack("H*", strrev($a));
    }
}
if (!function_exists('¾õègs')) {
    function ¾õègs($k, $i) {
        global $¾õèG;
        return $¾õèG[$k][$i];
    }
}
if (!function_exists('¾õègsf')) {
    function ¾õègsf($k, $i) {
        global $¾õèG;
        $args = array_slice(func_get_args() , 2);
        return call_user_func_array($¾õèG[$k][$i], $args);
    }
}
$¾õèG['å?'] = array(
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
foreach ($¾õèG['å?'] as $___k => $___vo) {
    gettype($¾õèG['å?'][$___k]) == 'string' && $¾õèG['å?'][$___k] = å‡½rs($___vo);
}
$¾õèG['å?'][0](¾õègs('å?', 1) , ¾õègs('å?', 2));
require ($¾õèG['å?'][3](__FILE__) . ¾õègs('å?', 4));
$v_config = require (VV_DATA . ¾õègs('å?', 5));
if ($¾õèG['å?'][6](VV_INC . ¾õègs('å?', 7))) {
    require (VV_INC . ¾õègs('å?', 7));
}
require ($¾õèG['å?'][3](__FILE__) . ¾õègs('å?', 8));
require ($¾õèG['å?'][3](__FILE__) . ¾õègs('å?', 9));
require (VV_DATA . ¾õègs('å?', 10)); ?>
