<?php
require_once('data.php');
$v_config = require_once('../data/config.php');
require_once('checkAdmin.php');
$var_25 = isset($_GET ["id"])?$_GET ["id"]:"";
if($var_25 == ""){
    echo ADMIN_HEAD; ;
    echo '<body>' . "\r\n" . '<div class="right">' . "\r\n" . '   ';
    include 'welcome.php';
    echo '  <div class="right_main">' . "\r\n" . '  <form action="?id=save" method="post" onSubmit="return chk();" >' . "\r\n" . '  <table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">' . "\r\n\t" . '<tr class="tb_head">  ' . "\r\n\t\t" . '<td colspan="2">' . "\r\n\t\t\t" . '<h2>模板风格列表</h2>' . "\r\n\t\t" . '</td>' . "\r\n\t" . '</tr>' . "\r\n";
    $var_73 = array();
    $var_52 = VV_ROOT . '/template';
    $var_73 = scandirs($var_52);
    foreach($var_73 as $var_5 => $var_6){
        $var_74 = $var_52 . '/' . $var_6 . '/index.html';
        if($var_6 == '.' || $var_6 == '..' || !is_dir($var_52 . '/' . $var_6) || !is_file($var_74)){
            unset($var_73[$var_5]);
        }
    } ;
    echo '<style type="text/css">' . "\r\n" . '.list img{ border:1px solid #eee;height:120px;width:150px}' . "\r\n" . '.list li{ float:left;margin:10px;background:#ebffcc;padding:10px;border-right:1px dotted #a6f46c;list-style:none;}' . "\r\n" . '.list p{ margin-bottom:5px;padding-bottom:5px;}' . "\r\n" . '.list .name{text-align:center;}' . "\r\n" . '</style>' . "\r\n\r\n\t" . '<tr bgcolor="#ffffff">' . "\r\n\t\t" . '<td colspan="5">' . "\r\n\t\t\t" . '<div class="list">' . "\r\n\t\t\t";
    foreach($var_73 as $var_5 => $var_6){
        $var_95 = $var_52 . '/' . $var_6 . '/preview.jpg';
        $var_96 = '../template/' . $var_6 . '/preview.jpg';
        if(!is_file($var_95)){
            $var_96 = '../public/img/nopic.gif';
        } ;
        echo "\t\t\t\t" . '<li>' . "\r\n\t\t\t\t\t" . '<p><img src="';
        echo $var_96;
        echo '"></p>' . "\r\n\t\t\t\t\t" . '<p class="name"><font color="green">';
        echo $var_6;
        echo '</font></p>' . "\r\n\t\t\t\t" . '</li>' . "\r\n\t\t\t";
    } ;
    echo "\t\t\t" . '</div>' . "\r\n\t\t" . '</td>' . "\r\n\t" . '</tr>' . "\r\n" . ' </table>' . "\r\n" . '</form>' . "\r\n" . '  </div>' . "\r\n" . '</div>' . "\r\n";
    include 'footer.php';
    echo '</body>' . "\r\n" . '</html>' . "\r\n\r\n";
} ;
echo "\r\n";
?>