<?php
namespace md\data;

class ReadCacheNoTimeout extends BaseGlobal
{

    function __construct()
    {
        if ( $this->v_config['cacheon']){
           file_exists($this->cachefile) and  !checktime_log_timeout() and  readCacheFile();

        }




    }





}