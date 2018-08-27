<?php
namespace md\data\rules;

use md\data\BaseGlobal;

class plus_run_before_get extends BaseGlobal {

     function __construct()
    {
        define('VV_PLUS', true);
        $this->isplus = false;
        plus_run('init');
        plus_run('before_get');
    }
}

