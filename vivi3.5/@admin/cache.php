<?php
require_once('data.php');
$v_config = require_once('../data/config.php');
require_once('checkAdmin.php');
$var_25 = isset($_GET ["id"])?$_GET ["id"]:"";
if ($var_25 == ""){
    echo ADMIN_HEAD; ;
    echo '<body>' . "\r\n" . '<div class="right">' . "\r\n" . ' ';
    include 'welcome.php';
    echo '  <div class="right_main">' . "\r\n" . '<table width="98%" cellspacing="1" cellpadding="4" border="0" class="tableoutline">' . "\r\n\t" . '<tbody>' . "\r\n\t\t" . '<tr class="tb_head">' . "\r\n\t\t\t" . '<td><h2>ȫ�ֻ������ã�<font color="red">�ڵ���ɶ�������</font></h2></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t" . '</tbody>' . "\r\n" . '</table>' . "\r\n" . '<table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">' . "\r\n\t" . '<form action="?id=save" method="post">' . "\r\n\t" . '<tbody id="config1">' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>��ҳ���汣��ʱ��</b><br>' . "\r\n\t\t\t" . '<font color="#666666"><font color=\'red\'>Сʱ</font>Ϊ��λ,1Ϊ1Сʱ</font></td>' . "\r\n\t\t\t" . '<td><input type="text" name="con[indexcache]" size="25" maxlength="50" value="';
    echo $v_config["indexcache"];
    echo '"onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > һ��24Сʱ��</td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>����ҳ���汣��ʱ��</b><br>' . "\r\n\t\t\t" . '<font color="#666666"><font color=\'red\'>Сʱ</font>Ϊ��λ,1Ϊ1Сʱ</font></td>' . "\r\n\t\t\t" . '<td><input type="text" name="con[othercache]" size="25" maxlength="50" value="';
    echo $v_config["othercache"];
    echo '"onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > һ��72Сʱ��</td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>ͼƬ���汣��ʱ��</b><br>' . "\r\n\t\t\t" . '<font color="#666666"><font color=\'red\'>Сʱ</font>Ϊ��λ,1Ϊ1Сʱ</font></td>' . "\r\n\t\t\t" . '<td><input type="text" name="con[imgcachetime]" size="25" maxlength="50" value="';
    echo $v_config["imgcachetime"];
    echo '"onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > �������Ϊ0��������ɻ���' . "\r\n\t\t\t" . '</td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>css���汣��ʱ��</b><br>' . "\r\n\t\t\t" . '<font color="#666666"><font color=\'red\'>Сʱ</font>Ϊ��λ,1Ϊ1Сʱ</font></td>' . "\r\n\t\t\t" . '<td><input type="text" name="con[csscachetime]" size="25" maxlength="50" value="';
    echo $v_config["csscachetime"];
    echo '"onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > һ��999Сʱ��' . "\r\n\t\t\t" . '</td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>js���汣��ʱ��</b><br>' . "\r\n\t\t\t" . '<font color="#666666"><font color=\'red\'>Сʱ</font>Ϊ��λ,1Ϊ1Сʱ</font></td>' . "\r\n\t\t\t" . '<td><input type="text" name="con[jscachetime]" size="25" maxlength="50" value="';
    echo $v_config["jscachetime"];
    echo '"onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > һ��999Сʱ��' . "\r\n\t\t\t" . '</td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>�����С����</b><br>' . "\r\n\t\t\t" . '<font color="#666666">�����趨ֵ�Զ��������,��λΪ MB</font></td>' . "\r\n\t\t\t" . '<td><input type="text" name="con[delcache]" size="25" maxlength="50" value="';
    echo $v_config["delcache"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > һ��200��</td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>��ʱ��黺���Сʱ����</b><br>' . "\r\n\t\t\t" . '<font color="#666666">��λΪ�죬����������Զ�ɨ��һ�λ����С</font><br><font color="red">ɨ���ʱ��,���鲻Ҫ����̫Сֵ</font></td>' . "\r\n\t\t\t" . '<td><input type="text" name="con[delcachetime]" size="25" maxlength="50" value="';
    echo $v_config["delcachetime"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >  һ��3����</td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>�Զ������濪��</b><br>' . "\r\n\t\t\t" . '<font color="#666666">�����󣬳��������С���ƾ��Զ�������</font></td>' . "\r\n\t\t\t" . '<td><select name="con[deloldcache]">' . "\r\n\t\t\t\t" . '<option value="1" ';
    if($v_config["deloldcache"]) echo 'selected';
    echo '>����</option>' . "\r\n\t\t\t\t" . '<option value="0" ';
    if(!$v_config["deloldcache"]) echo 'selected';
    echo '>�ر�</option>' . "\r\n\t\t\t" . '</select></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>֩���¼����</b><br>' . "\r\n\t\t\t" . '<font color="#666666">��¼������������֩�����ж�̬</font></td>' . "\r\n\t\t\t" . '<td><select name="con[robotlogon]">' . "\r\n\t\t\t\t" . '<option value="1" ';
    if ($v_config["robotlogon"]) echo 'selected';
    echo '>����</option>' . "\r\n\t\t\t\t" . '<option value="0" ';
    if (!$v_config["robotlogon"]) echo 'selected';
    echo '>�ر�</option>' . "\r\n\t\t\t" . '</select></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>css���濪��</b><br>' . "\r\n\t\t\t" . '<font color="#666666">����css���棬�ӿ��ٶ�</font></td>' . "\r\n\t\t\t" . '<td><select name="con[csscache]">' . "\r\n\t\t\t\t" . '<option value="1" ';
    if($v_config["csscache"]) echo 'selected';
    echo '>����</option>' . "\r\n\t\t\t\t" . '<option value="0" ';
    if(!$v_config["csscache"]) echo 'selected';
    echo '>�ر�</option>' . "\r\n\t\t\t" . '</select></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>js���濪��</b><br>' . "\r\n\t\t\t" . '<font color="#666666">����js���棬�ӿ��ٶȣ�<font color="red">һ�㲻��Ҫ����</font></font></td>' . "\r\n\t\t\t" . '<td><select name="con[jscache]">' . "\r\n\t\t\t\t" . '<option value="1" ';
    if($v_config["jscache"]) echo 'selected';
    echo '>����</option>' . "\r\n\t\t\t\t" . '<option value="0" ';
    if(!$v_config["jscache"]) echo 'selected';
    echo '>�ر�</option>' . "\r\n\t\t\t" . '</select></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>ͼƬ����/�ƽ����������</b><br>' . "\r\n\t\t\t" . '<font color="red">��δ�������ɲ�����</font></td>' . "\r\n\t\t\t" . '<td><select name="con[imgcache]">' . "\r\n\t\t\t\t" . '<option value="1" ';
    if($v_config["imgcache"]) echo 'selected';
    echo '>����</option>' . "\r\n\t\t\t\t" . '<option value="0" ';
    if(!$v_config["imgcache"]) echo 'selected';
    echo '>�ر�</option>' . "\r\n\t\t\t" . '</select></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>ҳ�滺�濪��</b><br>' . "\r\n\t\t\t" . '<font color="#666666">����ҳ�滺�棬��ʡ������CPU��Դ</font></td>' . "\r\n\t\t\t" . '<td><select name="con[cacheon]">' . "\r\n\t\t\t\t" . '<option value="1" ';
    if ($v_config["cacheon"]) echo 'selected';
    echo '>����</option>' . "\r\n\t\t\t\t" . '<option value="0" ';
    if (!$v_config["cacheon"]) echo 'selected';
    echo '>�ر�</option>' . "\r\n\t\t\t" . '</select></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr class="firstalt"><td align="center" colspan="2"><input type="submit" value=" �ύ " name="submit" class="bginput">&nbsp;&nbsp;<input type="reset" value=" ���� " name="Input" class="bginput"></td></tr>' . "\r\n\t" . '</tbody>' . "\r\n\t" . '</form>' . "\r\n" . '</table>' . "\r\n" . '</div>' . "\r\n" . '</div>' . "\r\n";
    include 'footer.php';
    echo '</body>' . "\r\n" . '</html>' . "\r\n";
}elseif($var_25 == 'save'){
    $var_30 = $_POST["con"];
    foreach($var_30 as $var_5 => $var_31){
        $var_30[$var_5] = trim($var_30[$var_5]);
    }
    $var_30 = @array_merge($v_config, $var_30);
    if($var_30){
        arr2file(VV_DATA . '/config.php', $var_30);
    }
    ShowMsg('��ϲ��,�޸ĳɹ���', 'cache.php', 2000);
}
?>