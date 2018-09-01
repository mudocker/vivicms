<?php
require_once('data.php');
$v_config = require_once('../data/config.php');
require_once('checkAdmin.php');
$var_25 = isset($_GET ["id"])?$_GET ["id"]:"";
if($var_25 == ""){
    $var_71 = @file_get_contents($var_75);
    $var_71 = @implode("\r\n", @explode('|||', $var_71));
    echo ADMIN_HEAD; ;
    echo '<body>' . "\r\n" . '<div class="right">' . "\r\n" . '   ';
    include 'welcome.php';
    echo '  <div class="right_main">' . "\r\n" . '  <form action="?id=save" method="post">' . "\r\n" . '  <table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">' . "\r\n\t" . '<tr class="tb_head">  ' . "\r\n\t\t" . '<td colspan="2">' . "\r\n\t\t\t" . '<h2>全局关键词内链：<font color="red">节点里可独立设置</font></h2>' . "\r\n\t\t" . '</td>' . "\r\n\t" . '</tr>' . "\r\n\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>关键词内链开关</b> <br>' . "\r\n\t\t\t" . '<font color="#666666">是否开启关键词内链，仅内页</font></td>' . "\r\n\t\t\t" . '<td><select name="con[linkword_on]" >' . "\r\n\t\t\t\t" . '<option value="1" ';
    if ($v_config["linkword_on"]) echo ' selected';
    echo '>开启</option>' . "\r\n\t\t\t\t" . '<option value="0" ';
    if (!$v_config["linkword_on"]) echo ' selected';
    echo '>关闭</option>' . "\r\n\t\t\t" . '</select></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t" . '<tr class="firstalt">' . "\r\n\t\t" . '<td width="260">' . "\r\n\t\t\t" . '<b>设置的链接</b></font>' . "\r\n\t\t" . '</td>  ' . "\r\n\t\t" . '<td>每行一个关键词和链接，用“,”隔开<br> 如：<br> 百度,http://baidu.com<br>腾讯,http://qq.com<br>' . "\r\n\t\t" . '<textarea name="link_config" cols="80" style="height:120px; width:450px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo $var_71;
    echo '</textarea>' . "\r\n\t\t" . '</td>' . "\r\n\t" . '</tr>' . "\r\n" . '<script type="text/javascript">' . "\r\n" . 'document.write(submit);' . "\r\n" . '</script>' . "\r\n" . ' </table>' . "\r\n" . '</form>' . "\r\n" . '  </div>' . "\r\n" . '</div>' . "\r\n";
    include 'footer.php';
    echo '</body>' . "\r\n" . '</html>' . "\r\n\r\n";
}elseif ($var_25 == 'save'){
    $var_30 = $_POST["con"];
    foreach($var_30 as $var_5 => $var_31){
        $var_30[$var_5] = trim($var_30[$var_5]);
    }
    $var_71 = $_POST["link_config"];
    $var_71 = str_replace(array("\r\n", "\r", "\n"), '|||', $var_71);
    $var_30 = @array_merge($v_config, $var_30);
    if($var_30){
        arr2file(VV_DATA . '/config.php', $var_30);
    }
    write($var_75, $var_71);
    ShowMsg('恭喜你,修改成功！', 'caiji_linkword.php', 2000);
} ;
echo "\r\n";
?>