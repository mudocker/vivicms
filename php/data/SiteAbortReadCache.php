<?php
/**
 * Created by PhpStorm.
 * User: ACER-VERITON
 * Date: 2018/8/27
 * Time: 16:59
 */

namespace md\data;


use md\data\rules\headerContextType;

class SiteAbortReadCache extends BaseGlobal
{

     function __construct(){
     if(! siteAbort($this->geturl))return;
      if ($this->v_config['obort_read_cahce']!=true)return;
       new headerContextType();
      !file_exists($this->cachefile) and nofoud();
      readCacheFile();



    }
}