<?php
require_once('../inc/common.inc.php');
if($_COOKIE["x_Cookie"] != $adminname || $_COOKIE["y_Cookie"] != $password){
    ShowMsg('µÇÂ¼³¬Ê±,ÇëÖØÐÂµÇÂ¼£¡', 'index.php', 2000);
}
?>