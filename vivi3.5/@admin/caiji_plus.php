<?php
require_once('data.php');
$v_config = require_once('../data/config.php');
require_once('checkAdmin.php');
define('VV_PLUS', true);
$var_14 = isset($_GET ["ac"])?$_GET ["ac"]:"";
echo ADMIN_HEAD;
if($var_14 == global){
    $var_42 = $_GET["sid"];
    $var_43 = $_GET["name"];
    $var_43 = preg_replace('~[^\w]+~', "", $var_43);
    if(!isset($v_config["plus_globals"])){
        $v_config["plus_globals"] = array();
    }
    if(!$var_42 && isset($v_config["plus_globals"][$var_43])){
        unset($v_config["plus_globals"][$var_43]);
    }else{
        $v_config["plus_globals"][$var_43] = $var_42;
    }
    arr2file(VV_DATA . '/config.php', $v_config);
    ShowMsg('��ϲ��,�޸ĳɹ���', '?', 500);
    exit;
}else if ($var_14 == 'save'){
    $var_43 = $_GET["name"];
    $var_43 = preg_replace('~[^\w]+~', "", $var_43);
    $var_76 = VV_DATA . '/plus/' . $var_43 . '/config.php';
    $plusconfig = require_once($var_76);
    $var_30 = $_POST["plus"]?$_POST["plus"]:$_POST["con"];
    foreach($var_30 as $var_5 => $var_6){
        if(!is_array($var_6)){
            $var_30[$var_5] = get_magic(trim($var_6));
        }
    }
    if($plusconfig){
        $plusconfig = @array_merge($plusconfig, $var_30);
    }else{
        $plusconfig = $var_30;
    }
    if($plusconfig){
        arr2file($var_76, $plusconfig);
    }
    ShowMsg('��ϲ��,����ɹ���', '?ac=xiugai&name=' . $var_43, 500);
    exit;
}else if ($var_14 == 'del'){
    $var_43 = $_GET["name"];
    $var_43 = preg_replace('~[^\w]+~', "", $var_43);
    if(is_dir(VV_DATA . '/plus/' . $var_43)){
        @removedir(VV_DATA . '/plus/' . $var_43);
    }
    ShowMsg('��ϲ��,ɾ���ɹ���', '?', 500);
    exit;
}else if ($var_14 == 'up'){
    if(!isset($_FILES["plusfile"])){
        return false;
    }
    if (!empty($_FILES["plusfile"]["error"])){
        switch($_FILES["plusfile"]["error"]){
        case 1: $var_77 = '����php.ini����Ĵ�С';
            break;
        case 2: $var_77 = '����������Ĵ�С';
            break;
        case 3: $var_77 = 'ͼƬֻ�в��ֱ��ϴ�';
            break;
        case 4: $var_77 = '��ѡ��ͼƬ';
            break;
        case 6: $var_77 = '�Ҳ�����ʱĿ¼';
            break;
        case 7: $var_77 = 'д�ļ���Ӳ�̳���';
            break;
        case 8: $var_77 = 'File upload stopped by extension';
            break;
        case 999: default: $var_77 = 'δ֪����';
        }
        if($_FILES["plusfile"]["error"] != 4){
        ShowMsg($var_77, -1, 2000);
    }
}
if(!empty($_FILES["plusfile"]["name"]) && !empty($_FILES["plusfile"]["tmp_name"]) && $_FILES["plusfile"]["error"] == "0"){
    $var_78 = $_FILES["plusfile"]["name"];
    $var_79 = $_FILES["plusfile"]["tmp_name"];
    if(@is_uploaded_file($var_79) === false){
        ShowMsg($var_78 . '�ϴ�ʧ�ܡ�', -1, 2000);
    }
    $var_80 = VV_DATA . '/plus.zip';
    if (move_uploaded_file($var_79, $var_80) === false){
        ShowMsg('�ϴ�����ļ�ʧ�ܡ�', '?', 1000);
    }
    require_once(VV_INC . '/pclzip.class.php');
    $var_81 = new PclZip($var_80);
    if ($var_81 -> extract(PCLZIP_OPT_PATH, VV_DATA . '/plus', PCLZIP_OPT_REPLACE_NEWER) == "0"){
        ShowMsg('�����ѹʧ�ܣ�Error : ' . $var_81 -> errorInfo(true), -1, 300000);
    }else{
        @unlink($var_80);
        ShowMsg('��ϲ��,����ϴ��ɹ���', '?', "0", 500);
    }
}
} ;
echo '<body>' . "\r\n" . '<div class="right">' . "\r\n" . '   ';
include 'welcome.php';
echo '  <div class="right_main">' . "\r\n" . '  <table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">' . "\r\n\t" . '<tr class="tb_head">  ' . "\r\n\t\t" . '<td colspan="8">' . "\r\n\t\t\t" . '<h2><a href="?">�������</a> &nbsp;&nbsp;-&nbsp;&nbsp;<a href="?ac=add" style=\'color:red\'>�ϴ����</a></h2>' . "\r\n\t\t" . '</td>' . "\r\n\t" . '</tr>' . "\r\n";
if($var_14 == ""){
$var_52 = VV_DATA . '/plus';
$var_53 = scandirs($var_52);
$var_54 = array();
foreach($var_53 as $var_5 => $var_6){
    if($var_6 <> '.' && $var_6 <> '..'){
        if (is_dir("$var_52/$var_6")){
            $var_68 = $var_52 . '/' . $var_6 . '/' . $var_6 . '.class.php';
            if(!is_file($var_68)){
                continue;
            }
            require_once($var_68);
            $var_69 = new $var_6;
            $var_70 = $var_69 -> info;
            $var_54[] = array_merge($var_70, array("file" => $var_6));
        }
    }
}
if(!OoO0o0O0o()){
    $var_54 = array();
} ;
echo "\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t" . '<td width="50" align="center"><b>ID</b></td>' . "\r\n\t\t" . '<td width="200" align="center"><b>�������</b></td>' . "\r\n\t\t" . '<td width="300" align="center"><b>���˵��</b></td>' . "\r\n\t\t" . '<td width="100" align="center"><b>����</b></td>' . "\r\n\t\t" . '<td width="130" align="center"><b>�汾</b></td>' . "\r\n\t\t" . '<td width="100" align="center"><b>ȫ������</b></td>' . "\r\n\t\t" . '<td width="150" align="center"><b>����</b></td>' . "\r\n\t\t" . '<td>&nbsp;</td>' . "\r\n\t" . '</tr>' . "\r\n";
if($var_54){
    foreach($var_54 as $var_5 => $var_6){;
        echo "\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t" . '<td align="center">';
        echo $var_5;
        echo '</td>' . "\r\n\t\t" . '<td style="padding-left:20px">';
        echo $var_6["name"];
        echo '</td>' . "\r\n\t\t" . '<td style="padding-left:20px">';
        echo $var_6["info"];
        echo '</td>' . "\r\n\t\t" . '<td align="center">';
        echo $var_6["author"];
        echo '</td>' . "\r\n\t\t" . '<td align="center">';
        echo $var_6["version"];
        echo '</td>' . "\r\n\t\t" . '<td align="center">';
        echo isset($v_config["plus_globals"][$var_6["file"]])?'<a href="?ac=global&name=' . $var_6["file"] . '&sid=0" title="���ȡ��"><font color="red">������</font></a>':'<a href="?ac=global&name=' . $var_6["file"] . '&sid=1">��Ϊȫ��</a>';
        echo '</td>' . "\r\n\t\t" . '<td align="center">';
        if(@is_file(VV_DATA . '/plus/' . $var_6["file"] . '/run.php')){;
            echo '<a href="?ac=run&name=';
            echo $var_6["file"];
            echo '">����</a>&nbsp;&nbsp;&nbsp;&nbsp;';
        };
        if(@is_file(VV_DATA . '/plus/' . $var_6["file"] . '/config.php')){;
            echo '<a href="?ac=xiugai&name=';
            echo $var_6["file"];
            echo '">����</a>';
        }else{;
            echo '<font color="red">����</font>';
        };
        echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="?ac=del&name=';
        echo $var_6["file"];
        echo '" onClick="return confirm(\'ȷ��ɾ��?\')">ɾ��</a></td>' . "\r\n\t\t" . '<td>&nbsp;</td>' . "\r\n\t" . '</tr>' . "\r\n";
    }
}else{;
    echo "\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t" . '<td colspan="8" align="center">û���ҵ������</td>' . "\r\n\t" . '</tr>' . "\r\n";
}
}else if($var_14 == 'xiugai'){
$var_43 = $_GET["name"];
$var_43 = preg_replace('~[^\w]+~', "", $var_43);
if(!is_dir(VV_DATA . '/plus/' . $var_43)){
    ShowMsg('��������ڣ���', '?', 2000);
    exit;
}
$var_76 = VV_DATA . '/plus/' . $var_43 . '/config.php';
$var_46 = VV_DATA . '/plus/' . $var_43 . '/' . $var_43 . '.class.php';
if(!is_file($var_76)){
    ShowMsg('������ò����ڣ���', '?', 2000);
    exit;
}
if(!is_file($var_46)){
    ShowMsg('���������2����', '?', 2000);
    exit;
}
require_once($var_46);
$var_69 = new $var_43;
$plusconfig = require_once($var_76); ;
echo "\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t" . '<td colspan="2">��';
echo $var_69 -> info["name"];
echo '���������</td>' . "\r\n\t" . '</tr>' . "\r\n" . '<form action="?ac=save&name=';
echo $var_43;
echo '" method="post">' . "\r\n";
@include(VV_DATA . '/plus/' . $var_43 . '/' . $var_43 . '.form.html'); ;
echo "\t" . '<tr class="firstalt">' . "\r\n\t\t" . '<td>&nbsp;</td>' . "\r\n\t\t" . '<td colspan="2">' . "\r\n\t\t\t" . '<input type="submit" value=" ���� " name="submit" class="bginput">&nbsp;&nbsp;<input type="button" onclick="history.go(-1);" value=" ���� " name="Input" class="bginput"></td>' . "\r\n\t\t" . '</tr>' . "\r\n" . '</form>' . "\r\n";
}else if($var_14 == 'add'){;
echo '<form method="post" action="?ac=up" enctype="multipart/form-data">' . "\r\n\t" . '<tr class="firstalt">' . "\r\n\t\t" . '<td width="180"><b>�ϴ����</b><br>' . "\r\n\t\t" . '<font color="#666666">�����ͬ��������ᱻ����</font></td>' . "\r\n\t\t" . '<td><input name="plusfile" type="file"></td>' . "\r\n\t" . '</tr>' . "\r\n\t" . '<tr class="firstalt">' . "\r\n\t\t" . '<td >&nbsp;</td>' . "\r\n\t\t" . '<td>' . "\r\n\t\t\t" . '<input class="bginput" type="submit" name="submit" onclick=\'this.value="�����ϴ�..."\' value=" �ϴ� ">' . "\r\n\t\t" . '</td>' . "\r\n\t" . '</tr>' . "\r\n" . '</form>' . "\r\n";
}else if($var_14 == 'run'){
$var_43 = $_GET["name"];
$var_43 = preg_replace('~[^\w]+~', "", $var_43);
$var_82 = VV_DATA . '/plus/' . $var_43 . '/run.php';
include($var_82);
} ;
echo ' </table>' . "\r\n" . '</form>' . "\r\n" . '  </div>' . "\r\n" . '</div>' . "\r\n";
include 'footer.php';
echo '</body>' . "\r\n" . '</html>';
?>