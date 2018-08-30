<?php
require_once('autoload.php');
setcookie("x_Cookie", "");
setcookie("y_Cookie", "");
echo "<script>location.href='index.php';</script>";
exit;
?>