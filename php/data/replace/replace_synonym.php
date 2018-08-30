<?php
/**
 * Created by PhpStorm.
 * User: ACER-VERITON
 * Date: 2018/8/29
 * Time: 18:27
 */

namespace md\data\replace;


use md\data\BaseGlobal;

class replace_synonym extends BaseGlobal
{
    private $keyfile;
    function __construct(){
        if (!isCanReplaceHtml())return;
        $this ->keyfile = VV_CONF . "/keyword.conf";
        $this->html= $this->replace($this->html);
    }


    function replace($str){
        if(is_file($this -> keyfile)){
            $arr = file($this -> keyfile);
            $arr = str_replace(array("\r\n", "\n", "\r"), '', $arr);
            foreach($arr as $k => $v){
                if(trim($v) == '')break;
                list($l, $r) = explode(',', $v);
                if(function_exists('mb_string')){
                    mb_regex_encoding("gb2312");
                    $str = mb_ereg_replace($l, $r, $str);
                }else $str = str_replace($l, $r, $str);

            }
        }
        return $str;
    }
}