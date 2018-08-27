<?php
namespace md\data\flow;
use md\data\BaseGlobal;

class timeout_filename extends BaseGlobal {

    /**
     * timeout_filename constructor.
     */
    public function __construct()
    {
        getCacheOver($this->cacheOver, $this->iscollect, $this->caiji_config, $this->cachefile, $this->cachetime);
    }
}



