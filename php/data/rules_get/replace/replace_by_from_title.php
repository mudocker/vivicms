<?php
namespace md\data\rules_get\replace;
use md\data\BaseGlobal;

class replace_by_from_title extends BaseGlobal {

    function __construct()
    {
        $titlearr = explode('*', $this->caiji_config['from_title']);
        foreach($titlearr as $k => $vo) $this->html = str_ireplace($vo, $this->v_config['web_name'], $this->html);
    }


}

