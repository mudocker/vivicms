<?php
namespace md\data\rules\urlext;
use md\data\BaseGlobal;

class downSwf extends BaseGlobal {


     function __construct()
    {
        if(!isset($this->urlext)||$this->urlext != 'swf') return;
            header("Content-type: application/x-shockwave-flash");
            header("Location: {$this->geturl}");
            exit;

    }
}
