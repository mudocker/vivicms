<?php

header("Content-Type:text/html; charset=UTF-8");
if($_COOKIE['x_Cookie'] != $adminname || $_COOKIE['y_Cookie'] != $password) ShowMsg('登录超时,请重新登录！', "index.php", 2000);

?>