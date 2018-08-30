<?php
/**
 * Created by PhpStorm.
 * User: ACER-VERITON
 * Date: 2018/8/27
 * Time: 19:03
 */

namespace md\data\rules\urlext;


use md\data\BaseGlobal;

class downFont extends BaseGlobal
{


     function __construct(){
        return;
        if($this->urlext != 'ttf') return;
        header("Content-type: application/octet-stream;");
        header("Location: {$this->geturl}");
        exit;
    }
}