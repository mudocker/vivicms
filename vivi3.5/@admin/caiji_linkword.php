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
    echo '  <div class="right_main">' . "\r\n" . '  <form action="?id=save" method="post">' . "\r\n" . '  <table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">' . "\r\n\t" . '<tr class="tb_head">  ' . "\r\n\t\t" . '<td colspan="2">' . "\r\n\t\t\t" . '<h2>ȫ�ֹؼ���������<font color="red">�ڵ���ɶ�������</font></h2>' . "\r\n\t\t" . '</td>' . "\r\n\t" . '</tr>' . "\r\n\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>�ؼ�����������</b> <br>' . "\r\n\t\t\t" . '<font color="#666666">�Ƿ����ؼ�������������ҳ</font></td>' . "\r\n\t\t\t" . '<td><select name="con[linkword_on]" >' . "\r\n\t\t\t\t" . '<option value="1" ';
    if ($v_config["linkword_on"]) echo ' selected';
    echo '>����</option>' . "\r\n\t\t\t\t" . '<option value="0" ';
    if (!$v_config["linkword_on"]) echo ' selected';
    echo '>�ر�</option>' . "\r\n\t\t\t" . '</select></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t" . '<tr class="firstalt">' . "\r\n\t\t" . '<td width="260">' . "\r\n\t\t\t" . '<b>���õ�����</b></font>' . "\r\n\t\t" . '</td>  ' . "\r\n\t\t" . '<td>ÿ��һ���ؼ��ʺ����ӣ��á�,������<br> �磺<br> �ٶ�,http://baidu.com<br>��Ѷ,http://qq.com<br>' . "\r\n\t\t" . '<textarea name="link_config" cols="80" style="height:120px; width:450px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
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
    ShowMsg('��ϲ��,�޸ĳɹ���', 'caiji_linkword.php', 2000);
} ;
echo "\r\n";
?>