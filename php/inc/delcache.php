<?php
namespace md\inc;


use md\data\BaseGlobal;

!defined('VV_INC') and   exit(header("HTTP/1.1 403 Forbidden"));




class delcache extends BaseGlobal{

    private $deltime_file;
    public function __construct()
    {

        if(!$this->v_config['deloldcache'])return;
        $this->deltime_file=VV_DATA . '/deltime.txt';
        is_file($this->deltime_file)?$this->delCacheOverDay():$this->delCache();

    }


    function delCacheOverDay(){
        $deltime = file_get_contents($this->deltime_file);
        ($deltime + ($this->v_config['delcachetime'] * 24 * 3600)) < time () and  $this->delCache();
    }

    function delCache(){

        $cachesize = @getRealSize(@getDirSize(VV_CACHE));
        $cachesize > $this->v_config['delcache'] and  @removedir(VV_CACHE);
        $deltime = time();
        write($this->deltime_file, $deltime);
    }
}

