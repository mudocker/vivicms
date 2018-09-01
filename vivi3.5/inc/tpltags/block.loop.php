<?php
function tag_block_loop($args){
    $params = $args[0];
    if(empty($params)){
        return false;
    }
    $data = array();
    if(!isset($GLOBALS[$params['type']])){
        return false;
    }
    $data = array();
    !$params['row'] && $params['row'] = count($GLOBALS[$params['type']]);
    for($i = 0;$i < $params['row'];$i++){
        $arr = array_shift($GLOBALS[$params['type']]);
        if(!$arr || empty($GLOBALS[$params['type']])){
            break;
        }
        $arr['i'] = ($i + 1);
        $arr['postdate'] = date('Y/m/d H:i', time() - $i * rand(10, 120));
        $data[] = $arr;
    }
    return $data;
}
?>