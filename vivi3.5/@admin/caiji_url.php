<?php
require_once('data.php');
$v_config = require_once('../data/config.php');
require_once('checkAdmin.php');
$var_14 = isset($_GET ["ac"])?$_GET ["ac"]:"";
if($var_14 == 'save'){
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
    ShowMsg('��ϲ��,�޸ĳɹ���', '?', 2000);
}
if($var_14 == 'makefile'){
    $var_83 = $v_config["web_remark"]?$v_config["web_remark"] . '/(.*)':'([^@]+)';
    $var_84 = '<IfModule mod_rewrite.c>' . "\r\n" . 'RewriteEngine on' . "\r\n" . 'RewriteCond %{REQUEST_FILENAME} !-d' . "\r\n" . 'RewriteCond %{REQUEST_FILENAME} !-f' . "\r\n" . 'RewriteRule ^' . $var_83 . '$ index\.php\?$1 [QSA,PT,L]' . "\r\n" . '</IfModule>';
    $var_85 = '<?xml version="1.0" encoding="UTF-8"?>' . "\r\n" . '<configuration>' . "\r\n" . '    <system.webServer>' . "\r\n" . '    <rewrite>' . "\r\n" . '       <rules>' . "\r\n" . '        <rule name="vivi_wanneng" stopProcessing="true">' . "\r\n" . '            <match url="' . $var_83 . '$" />' . "\r\n" . '            <action type="Rewrite" url="index.php?{R:1}" appendQueryString="true" />' . "\r\n" . '        </rule>' . "\r\n" . '        </rules>' . "\r\n" . '    </rewrite>' . "\r\n" . '    </system.webServer>' . "\r\n" . '</configuration>';
    $var_86 = 'location / {' . "\r\n" . '  if (!-e $request_filename){' . "\r\n" . '     rewrite ^/' . $var_83 . '$ /index.php?$1 last;' . "\r\n" . '  }' . "\r\n" . '}';
    $var_83 = $v_config["web_remark"]?'/' . $v_config["web_remark"] . '/(.*)':'/([^@]+)';
    $var_87 = '[ISAPI_Rewrite]' . "\r\n" . 'RepeatLimit 32' . "\r\n" . 'RewriteRule ^' . $var_83 . '$ /index\.php\?$1';
    $var_44 = write(VV_ROOT . '/.htaccess', $var_84);
    $var_44 = write(VV_ROOT . '/nginx.txt', $var_86);
    $var_44 = write(VV_ROOT . '/web.config', $var_85);
    $var_44 = write(VV_ROOT . '/httpd.ini', $var_87);
    if(!$var_44){
        exit('�ļ�д��ʧ�ܣ���Ŀ¼���дȨ��');
    }
    exit('��ϲ��,���ɳɹ���');
}
echo ADMIN_HEAD;
$var_83 = isset($v_config["web_remark"]) ? $v_config["web_remark"] : 'html';
$var_88 = $v_config["web_urlencode_suffix"]?$v_config["web_urlencode_suffix"]:'html'; ;
echo '<body>' . "\r\n" . '<div class="right">' . "\r\n" . '   ';
include 'welcome.php';
echo '  <div class="right_main">' . "\r\n" . '  <form action="?ac=save" method="post">' . "\r\n" . '  <table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">' . "\r\n\t" . '<tr class="tb_head">  ' . "\r\n\t\t" . '<td colspan="2">' . "\r\n\t\t\t" . '<h2>URL�������</h2>' . "\r\n\t\t" . '</td>' . "\r\n\t" . '</tr>' . "\r\n\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t" . '<td colspan="2">' . "\r\n\t\t\t" . '<font color="blue" style="font-size:18px;">ע��α��̬�Ŀ������޸Ľڵ�ĸ߼�����������</font>' . "\r\n\t\t" . '</td>' . "\r\n\t" . '</tr>' . "\r\n\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t" . '<td width="260"><b>α��̬��ʶ��</b><img src="../public/img/vip.gif" style="cursor: pointer;vertical-align: middle;" title="vip����" width="19" height="18" /><br>' . "\r\n\t\t" . '<font color="#666666">α��̬���ַǰ���ʶ<br>�磺http://baidu.com/<font color="red">html</font>/xxx.php<br><font color="red">�޸ĺ�ǵ��޸�α��̬��������ı�ʶ��<br>ע�⣺��̨�ļ�����ҪΪ@��ͷ���磺@admin</font></font></td>' . "\r\n\t\t" . '<td><input name="con[web_remark]" type="text" value="';
echo $var_83;
echo '" size="15" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >&nbsp;&nbsp;��ĸ�����֣�<font color="red">α��̬������ο���̳�ö��� (<a href="http://www.vxiaotou.com/thread-894-1-1.html" target="_blank">��˷���</a>) </font></td>' . "\r\n\t" . '</tr>' . "\r\n\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t" . '<td width="260"><b>URL����ת��</b><br>' . "\r\n\t\t" . '<font color="#666666">�����ı�url��ַ��������seo</font></td>' . "\r\n\t\t" . '<td><select name="con[web_urlencode]" >' . "\r\n\t\t\t" . '<option value="1" ';
if ($v_config["web_urlencode"]) echo ' selected';
echo '>����</option>' . "\r\n\t\t\t" . '<option value="0" ';
if (!$v_config["web_urlencode"]) echo ' selected';
echo '>�ر�</option>' . "\r\n\t\t" . '</select></td>' . "\r\n\t" . '</tr>' . "\r\n\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t" . '<td width="260"><b>URL���ܷ���</b><br>' . "\r\n\t\t" . '<font color="#666666">��ͬ�ķ�����ͬ��Ч��</font></td>' . "\r\n\t\t" . '<td><select name="con[web_urlencode_type]" >' . "\r\n\t\t\t" . '<option value="base64" ';
if ($v_config["web_urlencode_type"] == 'base64' || empty($v_config["web_urlencode_type"])) echo ' selected';
echo '>base64</option>' . "\r\n\t\t\t" . '<option value="jiandan" ';
if ($v_config["web_urlencode_type"] == 'jiandan') echo ' selected';
echo '>��ת��</option>' . "\r\n\t\t\t" . '<option value="str_rot13" ';
if ($v_config["web_urlencode_type"] == str_rot13) echo ' selected';
echo '>ת����ĸ</option>' . "\r\n\t\t" . '</select></td>' . "\r\n\t" . '</tr>' . "\r\n\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t" . '<td width="260"><b>������Կ</b><br>' . "\r\n\t\t" . '<font color="#666666">����base64������Ч�����ĺ����������</font></td>' . "\r\n\t\t" . '<td><input type="text" name="con[web_urlencode_key]" size="15" value="';
echo $v_config["web_urlencode_key"];
echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>' . "\r\n\t" . '</tr>' . "\r\n\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t" . '<td width="260"><b>URL��׺</b><br>' . "\r\n\t\t" . '<font color="#666666">Ĭ��Ϊ html�����ô���</font></td>' . "\r\n\t\t" . '<td><input type="text" name="con[web_urlencode_suffix]" size="15" value="';
echo $var_88;
echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>' . "\r\n\t" . '</tr>' . "\r\n\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t" . '<td width="260"><b>����α��̬�����ļ�</b><br>' . "\r\n\t\t" . '<font color="#666666">����α��̬�����ļ��������Ŀ¼</font><br><font color="red">���� httpd.ini,web.config,.htaccess,nginx.txt</font></td>' . "\r\n\t\t" . '<td><input class="bginput" type="button" name="Input" value=" ������� " onclick="makefile()"> �����������</td>' . "\r\n\t" . '</tr>' . "\r\n" . '<script type="text/javascript">' . "\r\n" . 'document.write(submit);' . "\r\n" . '</script>' . "\r\n" . ' </table>' . "\r\n" . '</form>' . "\r\n" . '  </div>' . "\r\n" . '</div>' . "\r\n" . '<script type="text/javascript">' . "\r\n" . 'function makefile(){' . "\r\n\t" . '$.ajax({' . "\r\n\t\t" . 'type:"get",' . "\r\n\t\t" . 'url:"?ac=makefile",' . "\r\n\t\t" . 'success:function(data){' . "\r\n\t\t\t" . 'alert(data);' . "\r\n\t\t" . '}' . "\r\n\t" . '});' . "\r\n" . '}' . "\r\n" . '</script>' . "\r\n";
include 'footer.php';
echo '</body>' . "\r\n" . '</html>' . "\r\n";
?>