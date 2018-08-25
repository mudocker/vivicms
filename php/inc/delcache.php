<?php
namespace md\inc;


!defined('VV_INC') and   exit(header("HTTP/1.1 403 Forbidden"));




class delcache{

    /**
     * delcache constructor.
     */
    public function __construct()
    {
        $v_config=$GLOBALS['v_config'];
        $deltime_file = VV_DATA . '/deltime.txt';
        if($v_config['deloldcache']){
            if (is_file($deltime_file)){
                $deltime = file_get_contents($deltime_file);
                if(($deltime + ($v_config['delcachetime'] * 24 * 3600)) < time ()){
                    $cachesize = @getRealSize(@getDirSize(VV_CACHE));
                    $cachesize > $v_config['delcache'] and  @removedir(VV_CACHE);
                    $deltime = time();
                    write($deltime_file, $deltime);
                }
            }else{
                $cachesize = @getRealSize(@getDirSize(VV_CACHE));
                $cachesize > $v_config['delcache'] and  @removedir(VV_CACHE);
                $deltime = time();
                write($deltime_file, $deltime);
            }
        }
    }
}

