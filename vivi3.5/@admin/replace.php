<?php
require_once('data.php');
$v_config = require_once('../data/config.php');
require_once('checkAdmin.php');
$var_25 = isset($_GET ["id"])?$_GET ["id"]:"";
$var_28 = VV_DATA . '/keyword.conf';
$var_94 = file_get_contents($var_28);
if($var_25 == 'wyc' || $var_25 == ""){
    echo ADMIN_HEAD; ;
    echo '<body>' . "\r\n" . '<div class="right">' . "\r\n" . '   ';
    include 'welcome.php';
    echo '  <div class="right_main">' . "\r\n" . '  <form action="?id=save" method="post" onSubmit="return chk();" >' . "\r\n" . '  <table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">' . "\r\n\t" . '<tr class="tb_head">  ' . "\r\n\t\t" . '<td colspan="2">' . "\r\n\t\t\t" . '<h2>αԭ��ͬ�������</h2>' . "\r\n\t\t" . '</td>' . "\r\n\t" . '</tr>' . "\r\n\t" . '<tr class="firstalt">' . "\r\n\t\t" . '<td width="260" align="center">' . "\r\n\t\t\t" . '<b>ͬ��ʴʻ�</b><br /><font color="#666666">(����2000����)</font>' . "\r\n\t\t" . '</td>  ' . "\r\n\t\t" . '<td>ÿ��һ��ͬ��ʣ��԰�Ƕ���,����<br>�磺<br>����,����<br>�˼�,������</font><br>' . "\r\n\t\t" . '<textarea name="keyword" cols="80" style="height:120px; width:450px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo $var_94;
    echo '</textarea>' . "\r\n\t\t" . '</td>' . "\r\n\t" . '</tr>' . "\r\n" . '<script type="text/javascript">' . "\r\n" . 'document.write(submit);' . "\r\n" . '</script>' . "\r\n" . ' </table>' . "\r\n" . '</form>' . "\r\n" . '  </div>' . "\r\n" . '</div>' . "\r\n";
    include 'footer.php';
    echo '</body>' . "\r\n" . '</html>' . "\r\n\r\n";
}elseif ($var_25 == 'save'){
    $var_26 = get_magic(trim($_POST["keyword"]));
    if(@preg_match('/require|include|REQUEST|eval|system|fputs/i', $var_26)){
        ShowMsg('���зǷ��ַ�,����������', -1, 2000);
    }else{
        write($var_28, $var_26);
        ShowMsg('��ϲ��,�޸ĳɹ���', 'replace.php', 2000);
    }
} ;
?>