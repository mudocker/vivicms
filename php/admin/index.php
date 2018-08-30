<?php
require_once('autoload.php');
header("Content-type: text/html; charset=utf8");
?>
<html>
<head>
<title>小偷后台管理系统</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<link rel='stylesheet' type='text/css' href='./public_admin/css/admin.css'>
<script language="JavaScript">
function chk(){
	if(document.login.adminname.value==""){
		alert("用户名不能为空");
		return false;
	}else if(document.login.password.value==""){
		alert("密码不能为空");
		return false;
	}
}
</script>
</head>
<body>

<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><table width="502" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="public_admin/img/top1.gif" width="502" height="70"><?php // 检测后台目录是否更名
$cururl = $_SERVER['SCRIPT_NAME'];
$redmsg = preg_match('/admin\/index/i', $cururl)? '<div class=\'loginsafe\'>您的管理目录包含admin，为了网站安全,vivi建议你在FTP里把它修改为其它名称！</div>':  '';
echo $redmsg;
?></td>
  </tr>
  <tr>
    <td height="134" align="center" background="public_admin/img/top2.gif" bgcolor="#F2FFD1">
    <form method='post' action='login.php' name="login">
        <table width="400" border="0" align="right" cellpadding="0" cellspacing="4">
          <tr>
            <td width="74" height="25" align="center">用户名称：</td>
            <td width="314"><input class='in_p' type='text' name='adminname' id="adminname"onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ></td>
          </tr>
          <tr>
            <td height="25" align="center">密  码：</td>
            <td><input type='password' class='in_p' name='password' id="password" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ></td>
          </tr>
            <td height="25" align="center">&nbsp;</td>
            <td><input name="action" type='hidden' value='login'><input name="submit" type='image' src="public_admin/img/top4.gif" x=10 y=10 id="submit" class="noborder"></td>
          </tr>
        </table>
    </form></td>
  </tr>
  <tr>
    <td><img src="public_admin/img/top3.gif" width="502" height="84"></td>
  </tr>
</table></td>
  </tr>
</table>
<span style="display:none">

</span>
</body>
</html>
