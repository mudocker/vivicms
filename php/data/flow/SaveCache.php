<?php
namespace md\data\flow;

use md\data\BaseGlobal;

class SaveCache extends BaseGlobal {

    /**
     * CacheHtml constructor.
     */
    public function __construct()
    {
        if ($this->ac=='yulan')return;
        if (!$this->isgetnew)return;
        if (!$this->html||$this->html=='')return;

        plus_run('before_cache');
        $GLOBALS['v_config']['cacheon'] and fSaveCache();
    }




}
