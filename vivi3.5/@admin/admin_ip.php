<?php
require_once('data.php');
$v_config = require_once('../data/config.php');
require_once('checkAdmin.php');
$var_25 = isset($_GET ["id"])?$_GET ["id"]:"";
$var_28 = VV_DATA . '/banip.conf';
$var_29 = @file_get_contents($var_28);
if($var_25 == ""){
    echo ADMIN_HEAD; ;
    echo '<body>' . "\r\n" . '<div class="right">' . "\r\n" . '   ';
    include 'welcome.php';
    echo '  <div class="right_main">' . "\r\n" . '  <form action="?id=save" method="post" onSubmit="return chk();" >' . "\r\n" . '  <table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">' . "\r\n\t" . '<tr class="tb_head">  ' . "\r\n\t\t" . '<td colspan="2">' . "\r\n\t\t\t" . '<h2>IP屏蔽设置</h2>' . "\r\n\t\t" . '</td>' . "\r\n\t" . '</tr>' . "\r\n\t" . '<tr class="firstalt">' . "\r\n\t\t" . '<td width="260" >' . "\r\n\t\t\t" . '<b>IP地址</b>' . "\r\n\t\t\t" . '<br>' . "\r\n\t\t\t" . '屏蔽后该IP将不能访问前台页面' . "\r\n\t\t\t" . '<br>每行一个IP地址，支持通配符*<br>' . "\r\n\t\t\t" . '如：127.0.0.*</font><br>' . "\r\n\t\t" . '</td>  ' . "\r\n\t\t" . '<td>' . "\r\n\t\t" . '<textarea name="ip" cols="80" style="height:120px; width:450px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo $var_29;
    echo '</textarea>' . "\r\n\t\t" . '</td>' . "\r\n\t" . '</tr>' . "\r\n" . '<script type="text/javascript">' . "\r\n" . 'document.write(submit);' . "\r\n" . '</script>' . "\r\n" . ' </table>' . "\r\n" . '</form>' . "\r\n" . '  </div>' . "\r\n" . '</div>' . "\r\n";
    include 'footer.php';
    echo '</body>' . "\r\n" . '</html>' . "\r\n\r\n";
}elseif ($var_25 == 'save'){
    $var_26 = get_magic(trim($_POST["ip"]));
    if(@preg_match('/require|include|REQUEST|eval|system|fputs/i', $var_26)){
        ShowMsg('含有非法字符,请重新设置', -1, 2000);
    }else{
        write($var_28, $var_26);
        ShowMsg('恭喜你,修改成功！', 'admin_ip.php', 2000);
    }
} ;
echo "\r\n";
?>