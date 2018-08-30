<?php
namespace md\data\rules_get\replace;
use md\data\BaseGlobal;

class search_url extends BaseGlobal {

     function __construct(){
        if (!isCanReplaceHtml())return;
        $our= '<form$1action=$2' . WEB_ROOT . '/search.php';
        $pattern='~<form([^>]+)action\s*=\s*(["|\']?)' . $this->search_url . '~i';
        $this->search_url and  $this->html= preg_replace($pattern,$our, $this->html);

    }








    function __get($name)
    {
        $value=  parent::__get($name);
        (null===$value )and $value=isset( $this->caiji_config[$name])? $this->caiji_config[$name]:null;
        return $value;
    }

}
