<?php
require_once('data.php');
$v_config = require_once('../data/config.php');
require_once('checkAdmin.php');
$var_25 = isset($_GET ["id"])?$_GET ["id"]:"";
if ($var_25 == 'man' || $var_25 == ""){
    echo ADMIN_HEAD; ;
    echo '<body>' . "\r\n" . '<div class="right">' . "\r\n" . ' ';
    include 'welcome.php';
    echo '  <div class="right_main">' . "\r\n" . '<table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">' . "\r\n\t" . '<form action="?id=save" method="post">' . "\r\n\t" . '<tbody id="config1">' . "\r\n\t\t" . '<tr nowrap class="tb_head">' . "\r\n\t\t\t" . '<td colspan="2">' . "\r\n\t\t\t" . '<h2>��վ��Ϣ��</h2>' . "\r\n\t\t\t" . '</td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>��վ����</b><br></td>' . "\r\n\t\t\t" . '<td><input type="text" name="con[web_name]" size="30" value="';
    echo $v_config["web_name"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>' . "\r\n\t\t" . '</tr>' . "\r\n\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>��վ������</b><br>' . "\r\n\t\t\t" . '<font color="#666666">������ҳ���������Ż�</font></td>' . "\r\n\t\t\t" . '<td><input type="text" name="con[web_seo_name]" size="30" value="';
    echo $v_config["web_seo_name"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>' . "\r\n\t\t" . '</tr>' . "\r\n\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>��վ��ַ</b><br>' . "\r\n\t\t\t" . '<font color="#666666">�����ַ,��<font color="red">http://</font>��ͷ,<font color="red">б��"/"</font>��β</font></td>' . "\r\n\t\t\t" . '<td><input type="text" name="con[web_url]" id="web_url" size="30" value="';
    echo $v_config["web_url"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="checkurl(this.id);this.style.borderColor=\'#dcdcdc\'" > <a id="web_url_msg"></a></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>��ҳ�ؼ���</b><br>' . "\r\n\t\t\t" . '<font color="#666666">��ҳ�ؼ���keywords</font></td>' . "\r\n\t\t\t" . '<td><input name="con[web_keywords]" type="text" value="';
    echo $v_config["web_keywords"];
    echo '" size="55" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>��ҳ��վ����</b><br>' . "\r\n\t\t\t" . '<font color="#666666">��ҳ����</font></td>' . "\r\n\t\t\t" . '<td><textarea name="con[web_description]" cols="80" style="height: 70px; width: 350px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo $v_config["web_description"];
    echo '</textarea></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>������תurl��ַ</b><br>' . "\r\n\t\t\t" . '<font color="#666666">�ɼ�������ҳ����ת����url��ַ<br>�磺<font color="red">http://x.com/404.html</font></font></td>' . "\r\n\t\t\t" . '<td><input type="text" name="con[web_404_url]" id="web_404_url" size="60" value="';
    echo $v_config["web_404_url"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="checkurl(this.id);this.style.borderColor=\'#dcdcdc\'" > </td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr class="firstalt">' . "\r\n\t\t\t" . '<td width="260" valign="top"><b>ͳ�ƴ���</b><br>' . "\r\n\t\t\t" . '<font color="#666666">����ͳ�ƴ���<br></font></td>' . "\r\n\t\t\t" . '<td><textarea name="con[web_tongji]" cols="80" style="height: 70px; width: 350px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo $v_config["web_tongji"];
    echo '</textarea></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>����ģʽ</b><br>' . "\r\n\t\t\t" . '<font color="#666666">��������ģʽ�󣬽����������Ϣ�����ڷ��ֽ������</font></td>' . "\r\n\t\t\t" . '<td><select name="con[web_debug]" >' . "\r\n\t\t\t\t" . '<option value="off" ';
    if ($v_config["web_debug"] == 'off') echo ' selected';
    echo '>�ر�</option>' . "\r\n\t\t\t\t" . '<option value="on" ';
    if ($v_config["web_debug"] == 'on') echo ' selected';
    echo '>����</option>' . "\r\n\t\t\t" . '</select></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t" . '</tbody>' . "\r\n" . '<script type="text/javascript">' . "\r\n" . 'document.write(submit);' . "\r\n" . '</script>' . "\r\n\t" . '</form>' . "\r\n" . '</table>' . "\r\n" . '</div>' . "\r\n" . '</div>' . "\r\n";
    include 'footer.php';
    echo '<script type="text/javascript">' . "\r\n" . 'function msg(id,str){' . "\r\n\t" . 'if( id==\'error\') return \'<span class="error_msg">\'+str+\'</span>\';' . "\r\n\t" . 'if( id==\'success\') return \'<span class="success_msg">\'+str+\'</span>\';' . "\r\n" . '}' . "\r\n" . 'function checkurl(id){' . "\r\n\t" . 'var url=$(\'#\'+id).val();' . "\r\n\t" . 'if(url==\'\' || url.substr(0,7)!=\'http://\' || url.substr(-1,1)!=\'/\' ){' . "\r\n\t\t" . '$(\'#\'+id+\'_msg\').html(msg(\'error\',\'��ַ��ʽ����ȷ��\'));' . "\r\n\t" . '}else{' . "\r\n\t\t" . '$(\'#\'+id+\'_msg\').html(msg(\'success\',\'��д��ȷ\'));' . "\r\n\t" . '}' . "\r\n" . '}' . "\r\n" . '</script>' . "\r\n" . '</body>' . "\r\n" . '</html>' . "\r\n";
}elseif ($var_25 == 'save'){
    $var_30 = $_POST["con"];
    foreach($var_30 as $var_5 => $var_31){
        $var_30[$var_5] = trim($var_30[$var_5]);
    }
    $var_30["web_tongji"] = get_magic($var_30["web_tongji"]);
    if(substr($var_30["web_url"], -1) != '/') ShowMsg('��վ��ַ��ʽ����ȷ', -1, 3000);
    if(!$v_config) $v_config = $var_30;
    $var_30 = @array_merge($v_config, $var_30);
    if($var_30){
        arr2file(VV_DATA . '/config.php', $var_30);
    }
    ShowMsg('��ϲ��,�޸ĳɹ���', 'admin_main.php?id=man', 2000);
}
?>