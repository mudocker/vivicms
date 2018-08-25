<?php
namespace md\data\rules;

class plus_run_before_get{

     function __construct()
    {
        define('VV_PLUS', true);
        $GLOBALS['isplus'] = false;
        plus_run('init');
        plus_run('before_get');
    }
}

