<?php
if($ac == 'del'){
    $file = VV_DATA . '/config/' . $id . '.php';
    @unlink($file) and ShowMsg("恭喜你,删除成功！", 'caiji_config.php', 500);
}