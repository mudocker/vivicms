<?php
namespace md\inc;


use md\data\BaseGlobal;

!defined('VV_INC') and   exit(header("HTTP/1.1 403 Forbidden"));




class delcache extends BaseGlobal{

    private $deltime_file;
    public function __construct()
    {

        if(!$this->deloldcache)return;
        $this->deltime_file=VV_DATA . '/deltime.txt';
        is_file($this->deltime_file)?$this->delCacheOverDay():$this->delCache();

    }


    function delCacheOverDay(){
        $deltime = file_get_contents($this->deltime_file);
        ($deltime + ($this->delcachetime * 24 * 3600)) < time () and  $this->delCache();
    }

    function delCache(){

        $cachesize = @getRealSize(@getDirSize(VV_CACHE));
        $cachesize > $this->delcache and  @removedir(VV_CACHE);
        $deltime = time();
        write($this->deltime_file, $deltime);
    }


    function __get($name)
    {
        $value=  parent::__get($name);
        (null===$value )and $value=isset( $this->v_config[$name])? $this->v_config[$name]:null;
        return $value;
    }
}

