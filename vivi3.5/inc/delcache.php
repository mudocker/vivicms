<?php
if(!defined('VV_INC')) exit(header('HTTP/1.1 403 Forbidden'));
if($v_config["deloldcache"]){
    if($caiji_config["cache_set"]){
        $var_263 = VV_CACHE . '/html/' . $var_128;
        $var_264 = VV_DATA . '/deltime/' . $var_128 . '.txt';
    }else{
        $var_263 = VV_CACHE;
        $var_264 = VV_DATA . '/deltime.txt';
    }
    if (is_file($var_264)){
        $var_265 = file_get_contents($var_264);
        if(($var_265 + ($v_config["delcachetime"] * 24 * 3600)) < time()){
            $var_266 = @getRealSize(@getDirSize($var_263));
            if ($var_266 > $v_config["delcache"]) @removedir($var_263);
            $var_265 = time();
            write($var_264, $var_265);
        }
    }else{
        $var_266 = @getRealSize(@getDirSize($var_263));
        if ($var_266 > $v_config["delcache"]) @removedir($var_263);
        $var_265 = time();
        write($var_264, $var_265);
    }
}
