<?php
require_once('data.php');
$v_config = require_once('../data/config.php');
require_once('checkAdmin.php');
$var_14 = isset($_GET ["ac"])?$_GET ["ac"]:"";
if ($var_14 == 'save'){
    $var_30 = $_POST["con"];
    foreach($var_30 as $var_5 => $var_6){
        if(is_array($var_30[$var_5])){
            foreach($var_30[$var_5] as $var_47 => $var_48){
                $var_30[$var_5][$var_47] = utf2gbk(get_magic(trim($var_48)));
            }
        }else{
            $var_30[$var_5] = utf2gbk(get_magic(trim($var_30[$var_5])));
        }
    }
    if($var_30["siftrules"]){
        $var_30["siftrules"] = str_replace(array("\r\n", "\r", "\n"), '[cutline]', $var_30["siftrules"]);
        $var_50 = explode('[cutline]', $var_30["siftrules"]);
        foreach($var_50 as $var_5 => $var_6){
            if(!preg_match('#^\{vivi\s+replace\s*=\s*\'([^\']*)\'\s*\}(.*)\{/vivi\}#', $var_6)){
                ShowMsg('���˹����������ʽ��ʽ����ȷ', '?', 500);
            }
        }
        $var_30["siftrules"] = implode('[cutline]', $var_50);
    }
    if($var_30["replacerules_before"]){
        if(!preg_match('#\{vivicut\}#', $var_30["replacerules_before"])){
        }
    }
    if($var_30["siftrules_before"]){
        $var_30["siftrules_before"] = str_replace(array("\r\n", "\r", "\n"), '[cutline]', $var_30["siftrules_before"]);
        $var_51 = explode('[cutline]', $var_30["siftrules_before"]);
        foreach($var_51 as $var_5 => $var_6){
            if(!preg_match('#\{vivi\s+replace\s*=\s*\'([^\']*)\'\s*\}(.*)\{/vivi\}$#', $var_6)){
                ShowMsg('ǰ�ù��˹����������ʽ��ʽ����ȷ', '?', 500);
            }
        }
        $var_30["siftrules_before"] = implode('[cutline]', $var_51);
    }
    $var_30 = @array_merge($v_config, $var_30);
    if($var_30){
        $var_44 = arr2file(VV_DATA . '/config.php', $var_30);
        if($var_44 === false){
            ShowMsg('�޸�ʧ�ܣ�����ļ�д��Ȩ�ޣ�', '?', 500);
        }
    }
    ShowMsg('��ϲ��,�޸ĳɹ���', '?', 500);
}
echo ADMIN_HEAD; ;
echo '<body>' . "\r\n" . '<div class="right">' . "\r\n" . '   ';
include 'welcome.php';
echo '  <div class="right_main">' . "\r\n" . '  <form action="?ac=save" method="post" >' . "\r\n\t" . '<table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">' . "\r\n\t\t" . '<tbody>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt"><td colspan="2"><font style="font-size:18px" color="red">����Ϊȫ���滻���ã�ȫ����վ���ܴ�Ӱ�죡</font></td></tr>' . "\r\n\t\t\t" . '<tr class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260" valign=\'top\' style="background:#fafafa"><b>�ַ����滻����</b><br>' . "\r\n\t\t\t" . '<font color="#666666">�滻ǰ���滻��ֱ����<font color="red">******</font>�ָ�<br>ÿһ���滻������������ַ��ָ�����<br><font color="red">##########</font><br>���ӣ�<br><div style=\'padding:5px;border:1px dotted #ff6600;background:#f6f6f6\'>�����滻ǰ<font color="red">******</font>�����滻��<br><font color="red">##########</font><br>�ٶ�<font color="red">******</font>{web_name}</font><br><font color="red">##########</font></div>' . "\r\n\t\t\t\t" . '<div style="margin:8px 0;padding:5px 0;border-top:1px solid #eee;">' . "\r\n\t\t\t\t\t" . '<b>��ǩ˵����</b><br>' . "\r\n\t\t\t\t\t" . '{web_name} -> ��վ����<br>' . "\r\n\t\t\t\t\t" . '{web_url} -> ��վ��ַ<br>' . "\r\n\t\t\t\t\t" . '{web_domain} -> ��ǰ����<br>' . "\r\n\t\t\t\t\t" . '{web_thisurl} -> ��ǰҳ��url<br>' . "\r\n\t\t\t\t\t" . '{web_remark} -> α��̬��ʾ��<br>' . "\r\n\t\t\t\t\t" . '{ad.����ʶ} -> ����ǩ<br>' . "\r\n\t\t\t\t\t" . '{zdy.��ǩ} -> �Զ����ǩ<br>' . "\r\n\t\t\t\t" . '</div>' . "\r\n\t\t\t\t" . '<div style="margin:8px 0;padding:5px 0;border-top:1px solid #eee;">' . "\r\n\t\t\t\t\t" . '<b>ҳ�����֣�</b><br>' . "\r\n\t\t\t\t\t" . '���滻����ͷ��<br><font color="red">index@@</font>��ʾֻ�滻��ҳ<br><font color="red">other@@</font>��ʾֻ�滻��ҳ' . "\r\n\t\t\t\t" . '</div>' . "\r\n\t\t\t" . '</font>' . "\r\n\t\t\t" . '</td>' . "\r\n\t\t\t" . '<td><textarea name="con[replacerules]" style="height: 450px; width: 750px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
echo _htmlspecialchars($v_config["replacerules"]);
echo '</textarea></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260" valign=\'top\'><b>�����滻����</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">�����滻���ʽ��һ��һ������ʽ���£�<br>' . "\r\n\t\t\t\t" . '<div style=\'padding:5px;border:1px dotted #ff6600;background:#f6f6f6\'>' . "\r\n\t\t\t\t\t" . '<font color="red">{vivi replace=\'</font>�滻��<font color="red">\'}</font>������ʽ<font color="red">{/vivi}</font><br>' . "\r\n\t\t\t\t\t" . '<font color="blue">�滻���纬�е�������ʹ��[d]�����磺</font><br>' . "\r\n\t\t\t\t\t" . '<font color="red">{vivi replace=\'</font>[d]�滻��[d]<font color="red">\'}</font>����<font color="red">{/vivi}</font>' . "\r\n\t\t\t\t" . '</div>' . "\r\n\t\t\t\t\t" . '<div style="margin:8px 0;padding:5px 0;border-top:1px solid #eee;">' . "\r\n\t\t\t\t\t\t" . '<b>��ǩ˵����</b><br>ͬ��' . "\r\n\t\t\t\t\t" . '</div>' . "\r\n\t\t\t\t" . '</font></td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[siftrules]" style="height: 250px; width: 750px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
echo _htmlspecialchars($v_config["siftrules"]);
echo '</textarea></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>����ǰ���滻</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">�滻�ʼ�Ĵ��루��Ŀ��վ��ԭʼhtml��<br><font color="red">������;��һ�㲻�ÿ���</font></font></td>' . "\r\n\t\t\t\t" . '<td>' . "\r\n\t\t\t\t\t" . '<label><input type="radio" id="replace_before_on" name="con[replace_before_on]" value="1" ';
if ($v_config["replace_before_on"]) echo ' checked';
echo ' />����</label>' . "\r\n\t\t\t\t\t" . '<label><input type="radio" id="replace_before_off" name="con[replace_before_on]" value="0" ';
if (!$v_config["replace_before_on"]) echo ' checked';
echo ' />�ر�</label>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr class="firstalt replace_before_body"';
if (!$v_config["replace_before_on"]) echo ' style=\'display:none\'';
echo '>' . "\r\n\t\t\t\t" . '<td width="260" valign=\'top\'><b>ǰ���ַ����滻����</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">ʹ�÷���ͬ������滻����һ��</font>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[replacerules_before]" style="height: 150px; width: 750px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
echo _htmlspecialchars($v_config["replacerules_before"]);
echo '</textarea></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt replace_before_body"';
if (!$v_config["replace_before_on"]) echo ' style=\'display:none\'';
echo '>' . "\r\n\t\t\t\t" . '<td width="260" valign=\'top\'><b>ǰ�������滻����</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666"><font color="#666666">ʹ�÷���ͬ����������滻����һ��</font></td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[siftrules_before]" style="height: 150px; width: 750px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
echo _htmlspecialchars($v_config["siftrules_before"]);
echo '</textarea></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t" . '</tbody>' . "\r\n" . '<script>' . "\r\n" . '$(function() {' . "\r\n\t" . '$("#replace_before_on").click(function(){' . "\r\n\t\t" . '$(".replace_before_body").show();' . "\r\n\t" . '});' . "\r\n\t" . '$("#replace_before_off").click(function(){' . "\r\n\t\t" . '$(".replace_before_body").hide();' . "\r\n\t" . '});' . "\r\n" . '});' . "\r\n" . 'document.write(submit);' . "\r\n" . '</script>' . "\r\n" . ' </table>' . "\r\n" . '</form>' . "\r\n" . '  </div>' . "\r\n" . '</div>' . "\r\n";
include 'footer.php';
echo '</body>' . "\r\n" . '</html>';
?>