<?php
if($ac == 'savecollectid'){
    $config = array('collectid' => $_GET['collectid']);
    $config = @array_merge($v_config, $config);
    $config and  arr2file(VV_DATA . "/config.php", $config);

    ShowMsg("恭喜你,修改成功！", 'caiji_config.php', 500);
}