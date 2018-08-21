<?php
$zdy = [];
if(!empty($caiji_config['zdy'])){
    foreach($caiji_config['zdy']as $k => $vo){
        $vo['type'] == '0' and  $zdy[$vo['ename']] = $vo['body'];

        if($vo['type'] == '1') $vo['start'] && $vo['end'] and  $zdy[$vo['ename']] = strcut($vo['start'], $vo['end'], $GLOBALS['html']);
        if($vo['type'] == '2') $vo['regx'] and $zdy[$vo['ename']] = regxcut($vo['regx'], $GLOBALS['html']);
        $GLOBALS['html'] = str_replace('{zdy.' . $vo['ename'] . '}', $zdy[$vo['ename']], $GLOBALS['html']);
    }
}