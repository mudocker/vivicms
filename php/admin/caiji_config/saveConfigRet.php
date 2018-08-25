<?php
$result = arr2file($file, $config);
$result === false and  ajaxReturn(array('status' => 1, 'info' => "修改失败，检查文件写入权限！"));
ajaxReturn(array('status' => 1, 'info' => "恭喜你,修改成功！"));