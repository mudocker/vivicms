<?php
/**
 * Created by PhpStorm.
 * User: ACER-VERITON
 * Date: 2018/8/27
 * Time: 16:59
 */

namespace md\data;


class SiteAbortReadCache extends BaseGlobal
{

    /**
     * SiteAbortReadCache constructor.
     */
    public function __construct()
    {
        if (siteAbort($this->geturl)){
            if (!$this->v_config['obort_read_cahce']){
                 !file_exists($this->cachefile) and exit('link no exits or server cache no exits and target site abort');
                readCacheFile();
            }

        }


    }
}