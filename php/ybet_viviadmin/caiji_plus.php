<?php require_once("data.php");
$v_config = require_once("../data/config.php");
require_once("checkAdmin.php");
 define('VV_PLUS', true);
$ac = isset($_GET['ac'])?$_GET['ac']:'';
echo ADMIN_HEAD;
if($ac == 'save'){
    $name = $_GET['name'];
    $name = preg_replace('~[^\w]+~', '', $name);
    $plusconfig_file = VV_DATA . '/plus/' . $name . '/config.php';
    $plusconfig = require_once($plusconfig_file);
    $config = $_POST['plus']?$_POST['plus']:$_POST['con'];
    foreach($config as $k => $vo){
        if(!is_array($vo)){
            $config[$k] = get_magic(trim($vo));
        }
    }
    if($plusconfig){
        $plusconfig = @array_merge($plusconfig, $config);
    }else{
        $plusconfig = $config;
    }
    if($plusconfig){
        arr2file($plusconfig_file, $plusconfig);
    }
    ShowMsg("��ϲ��,����ɹ���", '?', 500);
    exit;
}else if($ac == 'del'){
    $name = $_GET['name'];
    $name = preg_replace('~[^\w]+~', '', $name);
    if(is_dir(VV_DATA . '/plus/' . $name)){
        @removedir(VV_DATA . '/plus/' . $name);
    }
    ShowMsg("��ϲ��,ɾ���ɹ���", '?', 500);
    exit;
}else if($ac == 'up'){
    if(!isset($_FILES['plusfile'])){
        return false;
    }
    if(!empty($_FILES['plusfile']['error'])){
        switch($_FILES['plusfile']['error']){
        case '1':$error = '����php.ini����Ĵ�С';
            break;
        case '2':$error = '����������Ĵ�С';
            break;
        case '3':$error = 'ͼƬֻ�в��ֱ��ϴ�';
            break;
        case '4':$error = '��ѡ��ͼƬ';
            break;
        case '6':$error = '�Ҳ�����ʱĿ¼';
            break;
        case '7':$error = 'д�ļ���Ӳ�̳���';
            break;
        case '8':$error = 'File upload stopped by extension';
            break;
        case '999':default:$error = 'δ֪����';
        }
        if($_FILES['plusfile']['error'] != 4){
        ShowMsg($error, '-1', 2000);
    }
}
if(!empty($_FILES['plusfile']['name']) && !empty($_FILES['plusfile']['tmp_name']) && $_FILES['plusfile']['error'] == '0'){
    $file_name = $_FILES['plusfile']['name'];
    $tmp_name = $_FILES['plusfile']['tmp_name'];
    if(@is_uploaded_file($tmp_name) === false){
        ShowMsg($file_name . "�ϴ�ʧ�ܡ�", '-1', 2000);
    }
    $filepath = VV_DATA . '/plus.zip';
    if(move_uploaded_file($tmp_name, $filepath) === false){
        ShowMsg("�ϴ�����ļ�ʧ�ܡ�", '?', 1000);
    }
    require_once(VV_INC . '/pclzip.class.php');
    $archive = new PclZip($filepath);
    if($archive -> extract(PCLZIP_OPT_PATH, VV_DATA . '/plus', PCLZIP_OPT_REPLACE_NEWER) == 0){
        ShowMsg("�����ѹʧ�ܣ�Error : " . $archive -> errorInfo(true), "-1", 300000);
    }else{
        @unlink($filepath);
        ShowMsg('��ϲ��,����ϴ��ɹ���', "?", 0, 500);
    }
}
}
?>
<body>
<div class="right">
   <?php include "welcome.php";
?>
  <div class="right_main">
  <table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">
	<tr class="tb_head">  
		<td colspan="7">
			<h2><a href="?">�������</a> &nbsp;&nbsp;-&nbsp;&nbsp;<a href="?ac=add" style='color:red'>�ϴ����</a></h2>
		</td>
	</tr>
<?php if($ac == ''){
$dir = VV_DATA . '/plus';
$filearr = scandirs($dir);
$temp = array();
foreach($filearr as $k => $vo){
    if($vo <> '.' && $vo <> '..'){
        if(is_dir("$dir/$vo")){
            $plusfile = $dir . '/' . $vo . '/' . $vo . '.class.php';
            if(!is_file($plusfile)){
                continue;
            }
            require_once($plusfile);
            $plusclass = new $vo;
            $plusinfo = $plusclass -> info;
            $temp[] = array_merge($plusinfo, array('file' => $vo));
        }
    }
}
if(!checktime_log_out_1h()){
    $temp = array();
}
?>
	<tr nowrap class="firstalt">
		<td width="50" align="center"><b>ID</b></td>
		<td width="200" align="center"><b>�������</b></td>
		<td width="300" align="center"><b>���˵��</b></td>
		<td width="100" align="center"><b>����</b></td>
		<td width="130" align="center"><b>�汾</b></td>
		<td width="150" align="center"><b>����</b></td>
		<td>&nbsp;</td>
	</tr>
<?php if($temp){
    foreach($temp as $k => $vo){
        ?>
	<tr nowrap class="firstalt">
		<td align="center"><?php echo $k ?></td>
		<td style="padding-left:20px"><?php echo $vo['name'] ?></td>
		<td style="padding-left:20px"><?php echo $vo['info'] ?></td>
		<td align="center"><?php echo $vo['author'] ?></td>
		<td align="center"><?php echo $vo['version'] ?></td>
		<td align="center"><?php if(@is_file(VV_DATA . '/plus/' . $vo['file'] . '/run.php')){
            ?><a href="?ac=run&name=<?php echo $vo['file'] ?>">����</a>&nbsp;&nbsp;&nbsp;&nbsp;<?php }
        ?><?php if(@is_file(VV_DATA . '/plus/' . $vo['file'] . '/config.php')){
            ?><a href="?ac=xiugai&name=<?php echo $vo['file'] ?>">����</a><?php }else{
            ?><font color="red">����</font><?php }
        ?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="?ac=del&name=<?php echo $vo['file'] ?>" onClick="return confirm('ȷ��ɾ��?')">ɾ��</a></td>
		<td>&nbsp;</td>
	</tr>
<?php }
}else{
    ?>
	<tr nowrap class="firstalt">
		<td colspan="7" align="center">û���ҵ������</td>
	</tr>
<?php }
}else if($ac == 'xiugai'){
$name = $_GET['name'];
$name = preg_replace('~[^\w]+~', '', $name);
if(!is_dir(VV_DATA . '/plus/' . $name)){
    ShowMsg("��������ڣ���", '?', 2000);
    exit;
}
$plusconfig_file = VV_DATA . '/plus/' . $name . '/config.php';
$plusclass_file = VV_DATA . '/plus/' . $name . '/' . $name . '.class.php';
if(!is_file($plusconfig_file)){
    ShowMsg("������ò����ڣ���", '?', 2000);
    exit;
}
if(!is_file($plusclass_file)){
    ShowMsg("���������2����", '?', 2000);
    exit;
}
require_once($plusclass_file);
$plusclass = new $name;
$plusconfig = require_once($plusconfig_file);
?>
	<tr nowrap class="firstalt">
		<td colspan="2">��<?php echo $plusclass -> info['name'];
?>���������</td>
	</tr>
<form action="?ac=save&name=<?php echo $name;
?>" method="post">
<?php @include(VV_DATA . '/plus/' . $name . '/' . $name . '.form.html');
?>
	<tr class="firstalt">
		<td>&nbsp;</td>
		<td colspan="2">
			<input type="submit" value=" ���� " name="submit" class="bginput">&nbsp;&nbsp;<input type="button" onclick="history.go(-1);" value=" ���� " name="Input" class="bginput"></td>
		</tr>
</form>
<?php }else if($ac == 'add'){
?>
<form method="post" action="?ac=up" enctype="multipart/form-data">
	<tr class="firstalt">
		<td width="180"><b>�ϴ����</b><br>
		<font color="#666666">�����ͬ��������ᱻ����</font></td>
		<td><input name="plusfile" type="file"></td>
	</tr>
	<tr class="firstalt">
		<td >&nbsp;</td>
		<td>
			<input class="bginput" type="submit" name="submit" onclick='this.value="�����ϴ�..."' value=" �ϴ� ">
		</td>
	</tr>
</form>
<?php }else if($ac == 'run'){
$name = $_GET['name'];
$name = preg_replace('~[^\w]+~', '', $name);
$plusrun_file = VV_DATA . '/plus/' . $name . '/run.php';
include($plusrun_file);
}
?>
 </table>
</form>
  </div>
</div>
<?php include "footer.php";
?>
</body>
</htm>