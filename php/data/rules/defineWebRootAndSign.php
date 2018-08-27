<?php
namespace md\data\rules;

use md\data\BaseGlobal;

class defineWebRootAndSign extends BaseGlobal {

    /**
     * WEB_ROOT constructor.
     */
    public function __construct()
    {

        $this->getSign();
        $this->defineWebRoot();
        $this->rewrite();

    }

    function rewrite(){
        if($this->caiji_config['rewrite'] && checktime_log_timeout())return;
        $this->sign = '?';
        SCRIPT == 'search' and   $this->sign = WEB_ROOT . '/?';
    }
    function defineWebRoot(){
        $temp_url = parse_url($this->v_config['web_url']);
        define('WEB_ROOT', substr($temp_url['path'], 0, -1));
    }
    function getSign(){
        $this->sign = $this->v_config['web_remark']?'/' . $this->v_config['web_remark'] . '/':'/';
    }


}
