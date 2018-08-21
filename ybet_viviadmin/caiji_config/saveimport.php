<?php
if($ac == 'saveimport'){
    $text = trim($_POST['import_text']);
    $id = isset($_POST['id'])?$_POST['id']:'';
    if(!$id){
        $arr = glob(VV_DATA . '/config/*.php');
        if(!checktime_log_out_1h() && count($arr) >= 2)ShowMsg('导入失败，未授权只能有2条规则', '-1', 6000);
        if($arr){
            $arr = array_map('basename', $arr);
            $arr = array_map('intval', $arr);
            $id = max($arr) + 1;
        }
    }
    if(!$id){
        $id = 1;
    }
    $file = VV_DATA . '/config/' . $id . '.php';
    if(preg_match('#^VIVI:#', $text)){
        if(!preg_match('#:END$#', $text)){
            ShowMsg('该规则不合法，采集规则为：VIVI:base64代码:END !', '-1', 6000);
        }
        $notess = explode(':', $text);
        $config = $notess[1];
        $config = unserialize(base64_decode(preg_replace("#[\r\n\t ]#", '', $config)))OR die('配置字符串有错误！');
    }else{
        ShowMsg("该规则不合法，无法导入！", '-1', 6000);
    }
    arr2file($file, $config);
    ShowMsg("恭喜你,导入成功！", 'caiji_config.php', 2000);
}