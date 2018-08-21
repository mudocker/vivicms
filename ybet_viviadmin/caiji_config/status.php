<?php
if($ac == 'status'){
    $collectid = (int)$_GET['collectid'];
    $file = VV_DATA . '/config/' . $collectid . '.php';
    $sid = intval($_GET['sid']);
    if(!is_file($file))ShowMsg("采集配置文件不存在", '-1', 2000);
    $caiji_config = require_once($file);
    if($caiji_config){
        $caiji_config['collect_close'] = $sid;
        arr2file($file, $caiji_config);
    }
    ShowMsg("恭喜你,修改成功！", '?', 500);
}