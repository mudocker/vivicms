<?php
require_once('data.php');
$v_config = require_once('../data/config.php');
require_once('checkAdmin.php');
$var_25 = isset($_GET ["id"])?$_GET ["id"]:"";
if($var_25 == 'edit' || $var_25 == ""){
    echo ADMIN_HEAD; ;
    echo '<script>' . "\r\n" . 'function chk(){' . "\r\n\t" . 'if(form.adminname.value==\'\'){' . "\r\n\t\t" . 'alert(\'����Ա�ʺ�Ϊ��\');' . "\r\n\t\t" . 'return false;' . "\r\n\t" . '}' . "\r\n\t" . 'if(form.password.value==\'\' || form.password.value!=form.password1.value){' . "\r\n\t\t" . 'alert(\'����Ϊ�ջ��ٴ����벻һ��\');' . "\r\n\t\t" . 'return false;' . "\r\n\t" . '}' . "\r\n" . '}' . "\r\n" . '</script>' . "\r\n" . '<body> ' . "\r\n" . '<div class="right">' . "\r\n" . '  ';
    include 'welcome.php'; ;
    echo '  <div class="right_main">' . "\r\n" . '  ' . "\r\n" . '  ' . "\r\n" . '  <form action="?id=save"  method="post" name="form" onsubmit="return chk();">' . "\r\n" . '    <table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline"> ' . "\r\n" . '        <tr nowrap  class="tb_head">' . "\r\n" . '          <td colspan="2"><h2>�޸����룺</h2></td>' . "\r\n" . '        </tr>' . "\r\n" . '        <tr nowrap class="firstalt">' . "\r\n" . '          <td width="260"><b>�û���</b><br><font color="#666666">���޸ģ��뱣��</font></td>' . "\r\n" . '          <td><input  type="text" name="adminname" size="33" value="';
    echo $adminname; ;
    echo '"onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >' . "\r\n" . '          </td>' . "\r\n" . '        </tr>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n" . '          <td width="260"><b>������</b><br><font color="#666666">�����µ�����</font></td>' . "\r\n" . '          <td><input  type="password" name="password" size="37"onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >' . "\r\n" . '          </td>' . "\r\n" . '        </tr>' . "\r\n" . '        <tr nowrap class="firstalt">' . "\r\n" . '          <td width="260"><b>�ظ�������</b><br><font color="#666666">�ظ������µ�����</font></td>' . "\r\n" . '          <td><input  type="password" name="password1" size="37"onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >' . "\r\n" . '          </td>' . "\r\n" . '        </tr>' . "\r\n" . '      </tbody>' . "\r\n" . '<script type="text/javascript">' . "\r\n" . 'document.write(submit);' . "\r\n" . '</script>' . "\r\n" . '      </form>' . "\r\n" . '    </table>  ' . "\r\n" . '  ' . "\r\n" . ' ' . "\r\n" . '  </div>' . "\r\n" . '</div>' . "\r\n" . '</body>' . "\r\n" . '</html>' . "\r\n\r\n";
}elseif ($var_25 == 'save'){
    $_POST["adminname"] = _htmlspecialchars($_POST["adminname"]);
    $var_26 = '<?php' . "\r\n" . '$adminname=' . '"' . trim($_POST["adminname"]) . '"' . ';' . "\r\n" . '$password=' . '"' . md5($_POST["password"]) . '"' . ';' . "\r\n" . '?>';
    if(@preg_match('/require|include|REQUEST|eval|system|fputs/i', $var_26)){
        ShowMsg('���зǷ��ַ�,����������', -1, 2000);
    }else{
        write('data.php', $var_26);
        ShowMsg('�˺��޸ĳɹ�,�����µ�¼��', 'index.php', 2000);
    }
} ;
echo "\r\n";
?>