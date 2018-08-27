<?php
namespace md\data\rules;


use md\data\BaseGlobal;

class convert_param_charset extends BaseGlobal {


    public function __construct()
    {
        $this->convert_get($_POST);
        $this->convert_get($_GET);
    }


    function convert_get(&$data){
        if (empty($data))return;
        $temp =array();
        foreach($data as $k => $vo){
            $k = convert_query($k,  $this->charset);
            $temp[$k] = convert_query($vo, $this->charset);
        }
        $data = $temp;
    }
}

