<?php require_once('data.php');
$v_config = require_once('../data/config.php');
require_once('checkAdmin.php');
$id = isset($_GET['id'])?$_GET['id']:'';
set_time_limit(0);
$ac = isset($_GET['ac'])?$_GET['ac']:'';
if($ac == ''){
    echo ADMIN_HEAD;;
    echo '<body>
<div class="right">
 ';
    include "welcome.php";
    echo '<div class="right_main">
<script type="text/javascript">
function tab(no,n){
	for(var i=1;i<=n;i++){
		$(\'#tab\'+i).removeClass(\'cur\');
		$(\'#config\'+i).hide();
	}
	$(\'#config\'+no).fadeIn();
	$(\'#tab\'+no).addClass(\'cur\');
}
</script>
<style type="text/css">
li.cur { background: #eefffd;}
</style>
<table width="98%" cellspacing="1" cellpadding="4" border="0" class="tableoutline">
	<tbody>
		<tr class="tb_head">
			<td colspan="2"><h2>����������</h2></td>
		</tr>
		<tr class="firstalt">
			<td colspan="2">
				<ul class="do_nav">
					<li id="tab1" class="cur"><a onclick="tab(1,6);" href="javascript:">��������</a></li>
					<li id="tab2"><a onclick="tab(2,6);" href="javascript:">��������/�޸�</a></li>
					<a href="?ac=reset_domain" style="line-height:30px;padding-left:20px;color:red">����������</a>&nbsp;
					<a href="javascript:" onclick="if(confirm(\'���ȫ���ڵ�?���ɻָ���\')){ $(this).html(\'�������...\');location.href=\'?ac=delall\';}" style="line-height:30px;padding-left:20px;color:red">���ȫ���ڵ�</a>
				</ul>
			</td>
		</tr>
	</tbody>
</table>
<table width="98%" cellspacing="1" cellpadding="4" border="0" class="tableoutline" id="config1">
	<tbody>
		<tr nowrap  class="tb_head">
			<td colspan="2"><h2>��������</h2></td>
		</tr>
		<form method="post" action="?ac=uptxt" enctype="multipart/form-data">
			<tr class="firstalt">
				<td width="260"><b>ѡ�����</b><br>
				<font color="#666666"><font color="red">��ȷѡ������Ҫ�Ĳ���</font></td>
				<td><label><input type="radio" name="actype" value="1" checked />����</label> <label><input type="radio" name="actype" value="2" />���ǣ������ظ��ڵ㣩</label></td>
			</tr>
			<style type="text/css">
				.webtype td,.webtype1 td,.webtype2 td{background:#f9f9f9}
				.webtype1 td.son,.webtype2 td.son{padding-left:30px;}
				.webtype2{display:none}
			</style>
			<tr class="firstalt webtype">
				<td width="260"><b>��վ��Ϣ���뷽ʽ</b><br>
				<font color="#666666"><font color="red">��ȷѡ������Ҫ������</font></td>
				<td><label><input type="radio" name="webtype" value="1" checked  onclick="$(\'.webtype1\').show();$(\'.webtype2\').hide();"/>�ؼ���������ģʽ</label> <label><input type="radio" name="webtype" value="2" onclick="$(\'.webtype1\').hide();$(\'.webtype2\').show();" />�̶�ģʽ��ÿ�����˳���Ƕ�Ӧ�ģ�</label></td>
			</tr>
			<tr nowrap class="firstalt webtype1">
				<td width="260" class="son">�N <b>�ؼ��ʿ�</b><br>
				<font color="#666666">�ؼ���txt�⣬ÿ��һ���ؼ���</font></td>
				<td><input name="kwfile" type="file"></td>
			</tr>
			<tr nowrap class="firstalt webtype1">
				<td width="260" class="son">�N <b>��ҳ�����ɼ����ؼ���������</b><br>
				<font color="#666666">�ؼ��ʿ���ϳ���ҳ���⣬��������3������</font></td>
				<td><input name="webnamenum" type="text" value="4" size="10" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>
			</tr>
			<tr nowrap class="firstalt webtype1">
				<td width="260" class="son">�N <b>keywords�ɼ����ؼ���������</b><br>
				<font color="#666666">�ؼ��ʿ���ϳ�keywords����������5������</font></td>
				<td><input name="kwnum" type="text" value="4" size="10" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>
			</tr>
			<tr nowrap class="firstalt webtype1">
				<td width="260" class="son">�N <b>description�ɼ����ؼ���������</b><br>
				<font color="#666666">�ؼ��ʿ���ϳ���������������10������</font></td>
				<td><input name="desnum" type="text" value="8" size="10" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>
			</tr>
			<tr nowrap class="firstalt webtype2">
				<td width="260" class="son">�N <b>����ؼ��ʿ�</b><br>
				<font color="#666666">�ؼ���txt�⣬ÿ��һ���ؼ���</font><br><font color="red">���������txt���е���<br>���ñ�ǩ��{word1}...{word10}</font></td>
				<td><input name="kwfile_rand" type="file">&nbsp;<font color="red">��ѡ</font></td>
			</tr>
			<tr nowrap class="firstalt webtype2">
				<td width="260" class="son">�N <b>��ҳ�����</b><br>
				<font color="#666666">��ҳ����txt�⣬ÿ��һ������</font></td>
				<td><input name="indextitlefile" type="file"></td>
			</tr>
			<tr nowrap class="firstalt webtype2">
				<td width="260" class="son">�N <b>��վ���ƿ�</b><br>
				<font color="#666666">��վ����txt�⣬ÿ��һ����վ����</font></td>
				<td><input name="webnamefile" type="file"></td>
			</tr>
			<tr nowrap class="firstalt webtype2">
				<td width="260" class="son">�N <b>keywords��</b><br>
				<font color="#666666">keywords�⣬ÿ��һ��keywords</font></td>
				<td><input name="keywordsfile" type="file">&nbsp;<font color="red">��ѡ</font></td>
			</tr>
			<tr nowrap class="firstalt webtype2">
				<td width="260" class="son">�N <b>description������</b><br>
				<font color="#666666">description�⣬ÿ��һ��description</font></td>
				<td><input name="descriptionfile" type="file">&nbsp;<font color="red">��ѡ</font></td>
			</tr>
			<tr class="firstalt">
				<td width="260"><b>��������</b><br>
				<font color="#666666">�󶨵�����txt�⣬ÿ��һ����������<font color="red">��Ҫ��http://</font></font></td>
				<td><input name="ymfile" type="file"></td>
			</tr>
			<tr class="firstalt">
				<td width="260"><b>�Ƿ��Զ����www����</b><br>
				<font color="#666666"><font color="red">�����Զ�����www������</font></td>
				<td><label><input type="radio" name="addwww" value="1" checked  />��</label> <label><input type="radio" name="addwww" value="0" />��</label></td>
			</tr>
			<tr class="firstalt">
				<td width="260"><b>�ɼ���վ��</b><br>
				<font color="#666666">�ɼ�����վ�⣬ÿ��һ��Ŀ��վ��ַ��<font color="red">http://��ͷ</font><br><font color="green">������Ŀ��վ��������|�ŷָ����ұ��磺<br>http://www.baidu.com/|�ٶ�</font></font></td>
				<td><input name="urlfile" type="file"></td>
			</tr>
			<tr nowrap class="firstalt">
				<td width="260"><b>������ɼ�վ�ı���</b><br>
				<font color="#666666">���ٸ�������Ӧһ���ɼ�վ</font></td>
				<td><input name="ymnum" type="text" value="5" size="10" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>
			</tr>
			<tr class="firstalt">
				<td width="260" valign="top"><b>α��̬����</b><br>
				<font color="#666666">α��̬����<br></font></td>
				<td><select name="rewrite">
					<option value="1">����</option>
					<option value="0" selected="">�ر�</option>
				</select></td>
			</tr>
			<tr class="firstalt">
				<td width="260" valign="top"><b>վ��״̬</b><br>
				<font color="#666666">�Ƿ���վ��<br></font></td>
				<td><select name="web_close">
					<option value="off">����</option>
					<option value="on">�ر�</option>
				</select></td>
			</tr>
			<tr class="firstalt">
				<td width="260" valign="top"><b>ͳ�ƴ���</b><br>
				<font color="#666666">����ͳ�ƴ���<br></font></td>
				<td><textarea name="tongji" cols="80" style="height: 70px; width: 350px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></textarea></td>
			</tr>
			<tr class="firstalt">
				<td width="260">&nbsp;</td>
				<td>
					<input class="bginput" type="submit" name="submit" onclick=\'this.value="�����ϴ�..."\' value=" ������� ">
				</td>
			</tr>
		</form>
	</tbody>
</table>
<table width="98%" cellspacing="1" cellpadding="4" border="0" class="tableoutline" id="config2" style="display:none">
	<tr nowrap class="firstalt"><td>
	<table width="98%" cellspacing="1" cellpadding="4" border="0" class="tableoutline">
		<tr nowrap  class="tb_head">
			<td colspan="2"><h2 style="color:#339900;font-weight:bold;">�����滻/���õķ�Χ</h2></td>
		</tr>
		<tr nowrap class="firstalt">
			<td width="260"><b>���β�����Χ</b><br>
			<font color="#666666">��д�ڵ�ID��Χ����ʽ�� 1-100<br>������Ϊȫ���ڵ�</font></td>
			<td><input id="fanwei" type="text" value="" size="10" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>
		</tr>
	</table>
	<form method="post" action="?ac=set_siftags"><input type="hidden" name="fanwei" value="" />
		<table width="98%" cellspacing="1" cellpadding="4" border="0" class="tableoutline">
			<tr nowrap  class="tb_head">
				<td colspan="2"><h2 style="color:#339900;font-weight:bold;">�������ù���ѡ��</h2></td>
			</tr>	
			<tr nowrap class="firstalt">
				<td width="260"><b>��ǩ����</b><br>
				<font color="#666666">�ɼ�ҳ��ʱ���˵���Щ��ǩ<br><font color="red">����</font>,���򽫿��ܳ��ֲɼ��������ʹ�λ����</font></td>
				<td><input name="siftags[]" type="checkbox" value="iframe" checked /> iframe
					<input name="siftags[]" type="checkbox" value="object" checked /> object
					<input name="siftags[]" type="checkbox" value="script" checked /> script
					<input name="siftags[]" type="checkbox" value="form" /> form
					<input name="siftags[]" type="checkbox" value="input" /> input
					<input name="siftags[]" type="checkbox" value="textarea" /> textarea
					<input name="siftags[]" type="checkbox" value="botton" /> botton
					<input name="siftags[]" type="checkbox" value="select" /> select
					<input name="siftags[]" type="checkbox" value="div" /> div
					<input name="siftags[]" type="checkbox" value="table" /> table
					<input name="siftags[]" type="checkbox" value="th" /> th
					<input name="siftags[]" type="checkbox" value="tr" /> tr
					<input name="siftags[]" type="checkbox" value="td" /> td
					<input name="siftags[]" type="checkbox" value="span" /> span
					<input name="siftags[]" type="checkbox" value="img" /> img
					<input name="siftags[]" type="checkbox" value="font" /> font
					<input name="siftags[]" type="checkbox" value="a" /> a
					<input name="siftags[]" type="checkbox" value="html" /> html
					<input name="siftags[]" type="checkbox" value="style" /> style</td>
			</tr>
			<tr nowrap class="firstalt">
				<td width="260"><b>վ�������</b><br>
				<font color="#666666">�ɹ���վ�ڻ�վ�ⲻ��Ҫ�����ӻ��ļ�</font></td>
				<td><input name="siftags[]" type="checkbox" value="outa" checked /> <font color="red">վ��</font>����
					<input name="siftags[]" type="checkbox" value="outjs" checked /> <font color="red">վ��</font>js�ļ�
					<input name="siftags[]" type="checkbox" value="outcss"/> <font color="red">վ��</font>css�ļ�
					<input name="siftags[]" type="checkbox" value="locala"/> <font color="blue">վ��</font>����
					<input name="siftags[]" type="checkbox" value="localjs"/> <font color="blue">վ��</font>js�ļ�
					<input name="siftags[]" type="checkbox" value="localcss" /> <font color="blue">վ��</font>css�ļ�</td>
			</tr>
			<tr class="firstalt">
				<td width="260">&nbsp;</td>
				<td>
					<input class="bginput" type="submit" name="submit" onclick=\'this.value="����������..."\' value=" ����������� ">
				</td>
			</tr>
		</table>
	</form>
	<form method="post" action="?ac=set_gaoji"><input type="hidden" name="fanwei" value="" />
		<table width="98%" cellspacing="1" cellpadding="4" border="0" class="tableoutline">
			<tr nowrap  class="tb_head">
				<td colspan="2"><h2 style="color:#339900;font-weight:bold;">�������ø߼�����</h2></td>
			</tr>
			<tr nowrap class="firstalt">
				<td width="260"><b>ѡ����</b><br>
				<font color="#666666">�������ø߼����ܿ���</font></td>
				<td><select name="key">
					<option value="rewrite">α��̬</option>
					<option value="replace">αԭ��</option>
				</select>&nbsp;&nbsp;<select name="value">
					<option value="1">����</option>
					<option value="0" selected="">�ر�</option>
				</select>  </td>
			</tr>
			<tr class="firstalt">
				<td width="260">&nbsp;</td>
				<td>
					<input class="bginput" type="submit" name="submit" onclick=\'this.value="����������..."\' value=" ����������� ">
				</td>
			</tr>
		</table>
	</form>
	<form method="post" action="?ac=set_theme"><input type="hidden" name="fanwei" value="" />
		<table width="98%" cellspacing="1" cellpadding="4" border="0" class="tableoutline">
			<tr nowrap  class="tb_head">
				<td colspan="2"><h2 style="color:#339900;font-weight:bold;">�������ó���ģ��</h2></td>
			</tr>
			<tr nowrap class="firstalt">
				<td width="260"><b>����</b><br>
				<font color="#666666">��������/�رճ���ģ��</font></td>
				<td><select name="theme_open">
					<option value="1">����</option>
					<option value="0" selected="">�ر�</option>
				</select>  </td>
			</tr>
';
    $themeArr = array();
    $dir = VV_ROOT . '/template';
    $themeArr = scandirs($dir);
    foreach($themeArr as $k => $vo){
        $indexfile = $dir . '/' . $vo . '/index.html';
        if($vo == '.' || $vo == '..' || !is_dir($dir . '/' . $vo) || !is_file($indexfile)){
            unset($themeArr[$k]);
        }
    };
    echo '			<tr nowrap class="firstalt">
				<td width="260"><b>ѡ��ģ����</b><br>
				<font color="#666666">��������ģ����</font></td>
				<td><select name="theme_dir">
					<option value="">��</option>
				';
    foreach($themeArr as $k => $vo){;
        echo '						<option value="';
        echo $vo;
        echo '" ';
        if($caiji_config['theme_dir'] == $vo)echo " selected";
        echo '>';
        echo $vo;
        echo '</option>
				';
    };
    echo '				</select>  </td>
			</tr>
			<tr class="firstalt">
				<td width="260">&nbsp;</td>
				<td>
					<input class="bginput" type="submit" name="submit" onclick=\'this.value="����������..."\' value=" ����������� ">
				</td>
			</tr>
		</table>
	</form>
	<form method="post" action="?ac=set_tj"><input type="hidden" name="fanwei" value="" />
		<table width="98%" cellspacing="1" cellpadding="4" border="0" class="tableoutline">
			<tr nowrap  class="tb_head">
				<td colspan="2"><h2 style="color:#339900;font-weight:bold;">��������ͳ�ƴ���</h2></td>
			</tr>
			<tr class="firstalt">
				<td width="260" valign="top"><b>ͳ�ƴ���</b><br>
				<font color="#666666">����ͳ�ƴ���<br></font></td>
				<td><textarea name="tongji" cols="80" style="height: 70px; width: 450px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></textarea></td>
			</tr>
			<tr class="firstalt">
				<td width="260">&nbsp;</td>
				<td>
					<input class="bginput" type="submit" name="submit" onclick=\'this.value="����������..."\' value=" ����������� ">
				</td>
			</tr>
		</table>
	</form>
	<form method="post" action="?ac=replace_fromtitle"><input type="hidden" name="fanwei" value="" />
		<table width="98%" cellspacing="1" cellpadding="4" border="0" class="tableoutline">
			<tr nowrap  class="tb_head">
				<td colspan="2"><h2 style="color:#339900;font-weight:bold;">�����滻Ŀ��վ����</h2></td>
			</tr>
			<tr nowrap class="firstalt">
				<td width="260"><b>ԭ����Ŀ��վ����</b></td>
				<td><input name="oldtitle" type="text" value="" size="50" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>
			</tr>
			<tr nowrap class="firstalt">
				<td width="260"><b>�µ�Ŀ��վ����</b></td>
				<td><input name="newtitle" type="text" value="" size="50" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>
			</tr>
			<tr class="firstalt">
				<td width="260">&nbsp;</td>
				<td>
					<input class="bginput" type="submit" name="submit" onclick=\'this.value="�����滻��..."\' value=" ��������滻 ">
				</td>
			</tr>
		</table>
	</form>
	<form method="post" action="?ac=replace_url"><input type="hidden" name="fanwei" value="" />
		<table width="98%" cellspacing="1" cellpadding="4" border="0" class="tableoutline">
			<tr nowrap  class="tb_head">
				<td colspan="2"><h2 style="color:#339900;font-weight:bold;">�����滻Ŀ��ɼ���վ��ַ</h2></td>
			</tr>
			<tr nowrap class="firstalt">
				<td width="260"><b>ԭ����Ŀ��վ��ַ</b><br>
				<font color="#666666">http://��ͷ</font></td>
				<td><input name="oldurl" type="text" value="http://" size="50" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>
			</tr>
			<tr nowrap class="firstalt">
				<td width="260"><b>�µ�Ŀ��վ��ַ</b><br>
				<font color="#666666">http://��ͷ</font></td>
				<td><input name="newurl" type="text" value="http://" size="50" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>
			</tr>
			<tr class="firstalt">
				<td width="260">&nbsp;</td>
				<td>
					<input class="bginput" type="submit" name="submit" onclick=\'this.value="�����滻��..."\' value=" ��������滻 ">
				</td>
			</tr>
		</table>
	</form>
	<form method="post" action="?ac=replace_kw"><input type="hidden" name="fanwei" value="" />
		<table width="98%" cellspacing="1" cellpadding="4" border="0" class="tableoutline">
			<tr nowrap  class="tb_head">
				<td colspan="2"><h2 style="color:#339900;font-weight:bold;">�����滻�ؼ���</h2></td>
			</tr>
			<tr nowrap class="firstalt">
				<td width="260"><b>ԭ���Ĺؼ���</b><br>
				<font color="#666666">��Ҫ�滻�Ĺؼ���</font></td>
				<td><input name="oldkw" type="text" value="" size="50" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>
			</tr>
			<tr nowrap class="firstalt">
				<td width="260"><b>�µĹؼ���</b><br>
				<font color="#666666">�滻��Ĺؼ���</font></td>
				<td><input name="newkw" type="text" value="" size="50" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>
			</tr>
			<tr class="firstalt">
				<td width="260">&nbsp;</td>
				<td>
					<input class="bginput" type="submit" name="submit" onclick=\'this.value="�����滻��..."\' value=" ��������滻 ">
				</td>
			</tr>
		</table>
	</form>
	<form method="post" action="?ac=replace_domain"><input type="hidden" name="fanwei" value="" />
		<table width="98%" cellspacing="1" cellpadding="4" border="0" class="tableoutline">
			<tr nowrap  class="tb_head">
				<td colspan="2"><h2 style="color:#339900;font-weight:bold;">�����滻�󶨵�����</h2></td>
			</tr>
			<tr nowrap class="firstalt">
				<td width="260"><b>ԭ��������</b><br>
				<font color="#666666">��Ҫ�滻����������Ҫ��http://</font></td>
				<td><input name="olddomain" type="text" value="" size="50" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>
			</tr>
			<tr nowrap class="firstalt">
				<td width="260"><b>�µ�����</b><br>
				<font color="#666666">�滻�����������Ҫ��http://</font></td>
				<td><input name="newdomain" type="text" value="" size="50" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>
			</tr>
			<tr class="firstalt">
				<td width="260">&nbsp;</td>
				<td>
					<input class="bginput" type="submit" name="submit" onclick=\'this.value="�����滻��..."\' value=" ��������滻 ">
				</td>
			</tr>
		</table>
	</form>
	<form method="post" action="?ac=set_zdy"><input type="hidden" name="fanwei" value="" />
		<table width="98%" cellspacing="1" cellpadding="4" border="0" class="tableoutline">
			<tr nowrap  class="tb_head">
				<td colspan="2"><h2 style="color:#339900;font-weight:bold;">�Զ����������ã����裬ר��ʹ��ģʽ��</h2></td>
			</tr>
			
			<tr nowrap class="firstalt">
				<td width="260"><b>��</b><br>
				<font color="#666666">ר��ʹ��ģʽ</font></td>
				<td><input name="key" type="text" value="" size="20" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>
			</tr>
			<tr class="firstalt">
				<td width="260" valign="top"><b>ֵ</b><br>
				<font color="#666666">ר��ʹ��ģʽ<br></font></td>
				<td><textarea name="value" cols="80" style="height: 70px; width: 450px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></textarea></td>
			</tr>
			<tr class="firstalt">
				<td width="260">&nbsp;</td>
				<td>
					<input class="bginput" type="submit" name="submit" onclick=\'this.value="����������..."\' value=" ����������� ">
				</td>
			</tr>
		</table>
	</form>
	<form method="post" action="?ac=replace_zdy"><input type="hidden" name="fanwei" value="" />
		<table width="98%" cellspacing="1" cellpadding="4" border="0" class="tableoutline">
			<tr nowrap  class="tb_head">
				<td colspan="2"><h2 style="color:#339900;font-weight:bold;">�Զ��������滻�����裬ר��ʹ��ģʽ��</h2></td>
			</tr>
			<tr nowrap class="firstalt">
				<td width="260"><b>��</b><br>
				<font color="#666666">ר��ʹ��ģʽ</font></td>
				<td><input name="key" type="text" value="" size="20" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>
			</tr>
			<tr class="firstalt">
				<td width="260" valign="top"><b>ԭ����ֵ</b><br>
				<font color="#666666">ר��ʹ��ģʽ<br></font></td>
				<td><textarea name="oldvalue" cols="80" style="height: 60px; width: 450px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></textarea></td>
			</tr>
			<tr class="firstalt">
				<td width="260" valign="top"><b>�µ�ֵ</b><br>
				<font color="#666666">ר��ʹ��ģʽ<br></font></td>
				<td><textarea name="newvalue" cols="80" style="height: 60px; width: 450px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></textarea></td>
			</tr>
			<tr class="firstalt">
				<td width="260">&nbsp;</td>
				<td>
					<input class="bginput" type="submit" name="submit" onclick=\'this.value="����������..."\' value=" ����������� ">
				</td>
			</tr>
		</table>
	</form>
	</td></tr>
</table>

</div>
</div>
<script type="text/javascript">
$("#config2 form").submit(function(e){
	var fanwei=$.trim($(\'#fanwei\').val());
	$(\'input[name="fanwei"]\',this).val(fanwei);
	return true;
});
</script>
';
    include "footer.php";
    echo '</body>
</html>

';
}
if($ac == 'delall'){
    @removedir(VV_DATA . '/config');
    @mkdir(VV_DATA . '/config', 0777, true);
    reset_domain();
    ShowMsg("���ȫ���ڵ�ɹ���", '?', 1000);
}
if($ac == 'replace_url'){
    extract($_POST);
    replace_cfg(array('from_url' => array($oldurl, $newurl)), $fanwei);
    ShowMsg("Ŀ��վ��ַ�����滻�ɹ�~", '?', 1000);
}
if($ac == 'replace_zdy'){
    extract($_POST);
    replace_cfg(array($key => array($oldvalue, $newvalue)), $fanwei);
    ShowMsg("�Զ��������滻�ɹ�~", '?', 1000);
}
if($ac == 'replace_fromtitle'){
    extract($_POST);
    replace_cfg(array('from_title' => array($oldtitle, $newtitle)), $fanwei);
    ShowMsg("Ŀ��վ���������滻�ɹ�~", '?', 1000);
}
if($ac == 'replace_kw'){
    extract($_POST);
    replace_cfg(array('web_name' => array($oldkw, $newkw), 'web_seo_name' => array($oldkw, $newkw), 'web_keywords' => array($oldkw, $newkw), 'web_description' => array($oldkw, $newkw),), $fanwei);
    ShowMsg("�ؼ��������滻�ɹ�~", '?', 1000);
}
if($ac == 'replace_domain'){
    extract($_POST);
    replace_cfg(array('web_domains' => array($olddomain, $newdomain)), $fanwei);
    $domains_config = require_once(VV_DATA . '/domain_config.php');
    if(isset($domains_config[$olddomain])){
        $domains_config[$newdomain] = $domains_config[$olddomain];
        unset($domains_config[$olddomain]);
        arr2file(VV_DATA . "/domain_config.php", $domains_config);
    }
    ShowMsg("���������滻�ɹ�~", '?', 1000);
}
if($ac == 'set_siftags'){
    extract($_POST);
    set_cfg('siftags', $siftags, $fanwei);
    ShowMsg("���������滻�ɹ�~", '?', 1000);
}
if($ac == 'set_gaoji'){
    extract($_POST);
    set_cfg($key, $value, $fanwei);
    ShowMsg("�������ø߼����ܳɹ�~", '?', 1000);
}
if($ac == 'set_theme'){
    extract($_POST);
    set_cfg('theme_open', $theme_open, $fanwei);
    set_cfg('theme_dir', $theme_dir, $fanwei);
    ShowMsg("�������ó���ģ��ɹ�~", '?', 1000);
}
if($ac == 'set_zdy'){
    extract($_POST);
    set_cfg($key, $value, $fanwei);
    ShowMsg("�Զ����������óɹ�~", '?', 1000);
}
if($ac == 'set_tj'){
    extract($_POST);
    set_cfg('web_tongji', $tongji, $fanwei);
    ShowMsg("ͳ�����óɹ�~", '?', 1000);
}
if($ac == 'reset_domain'){
    reset_domain();
    ShowMsg("���������󶨳ɹ�~", '?', 1000);
}
function set_cfg($key, $value, $fanwei = false){
    static $data;
    $filearr = glob(VV_DATA . '/config/*.php');
    if($filearr){
        foreach($filearr as $k => $vo){
            $fileid = intval(str_replace('.php', '', basename($vo)));
            if(!isfanwei($fanwei, $fileid)){
                continue;
            }
            if(!isset($data[$vo])){
                $data[$vo] = require_once($vo);
            }
            $data[$vo][$key] = get_magic($value);
            arr2file($vo, $data[$vo]);
        }
    }
}
function replace_cfg($arg = array(), $fanwei = false){
    static $data;
    $filearr = glob(VV_DATA . '/config/*.php');
    if($filearr){
        foreach($filearr as $k => $vo){
            $fileid = intval(str_replace('.php', '', basename($vo)));
            if(!isfanwei($fanwei, $fileid)){
                continue;
            }
            if(!isset($data[$vo])){
                $data[$vo] = require_once($vo);
            }
            $yes = false;
            foreach($arg as $kk => $vv){
                if(stripos($data[$vo][$kk], $vv[0]) !== false){
                    $data[$vo][$kk] = str_ireplace($vv[0], $vv[1], $data[$vo][$kk]);
                    $yes = true;
                }
            }
            if($yes){
                arr2file($vo, $data[$vo]);
            }
        }
    }
}
function isfanwei($fanwei, $fileid){
    if($fanwei){
        list($min, $max) = explode('-', $fanwei);
        if($min && $max){
            if($min > $fileid || $fileid > $max){
                return false;
            }
        }
    }
    return true;
}
if($ac == 'uptxt'){
    extract($_POST);
    $ymarr = uptxt('ymfile');
    $urlarr = uptxt('urlfile');
    if(empty($ymarr) || empty($urlarr)){
        ShowMsg("�����⡢�ɼ���վ�ⲻ��Ϊ��~", '?', 1000);
    }
    $tongji = get_magic($tongji);
    if($webtype == 1){
        $kwarr = uptxt('kwfile');
        if(empty($kwarr)){
            ShowMsg("�ؼ��ʿⲻ��Ϊ��~", '?', 1000);
        }
        $webnamenum = max((int)$webnamenum, 1);
        $kwnum = max((int)$kwnum, 1);
        $desnum = max((int)$desnum, 1);
    }else if($webtype == 2){
        $indextitlearr = uptxt('indextitlefile');
        $webnamearr = uptxt('webnamefile');
        $keywordsarr = uptxt('keywordsfile');
        $descriptionarr = uptxt('descriptionfile');
        $kw_randarr = uptxt('kwfile_rand');
        if(empty($indextitlearr) || empty($webnamearr)){
            ShowMsg("��ҳ����⡢��վ���ƿⲻ��Ϊ��~", '?', 1000);
        }
    }
    $ymnum = max((int)$ymnum, 1);
    $total_url = count($urlarr);
    $total_ym = count($ymarr);
    $ymdata = array();
    foreach($urlarr as $k => $vo){
        if(isset($ymarr[$k])){
            $ymdata[$ymarr[$k]] = $vo;
            unset($ymarr[$k]);
        }
    }
    if($total_url < $total_ym){
        if(($total_url * $ymnum) < $total_ym){
            $p = ceil($total_ym / ($total_url * $ymnum));
        }else{
            $p = ceil($total_ym / $total_url);
        }
        $temparr = $urlarr;
        for($i = 0;$i < $p;$i++){
            $urlarr = array_merge($urlarr, $temparr);
        }
        shuffle($urlarr);
        foreach($ymarr as $k => $vo){
            $ymdata[$vo] = $urlarr[$k];
        }
    }
    $rule_cfg = require_once(VV_DATA . '/rule_cfg_tpl.php');
    $domains_config = require_once(VV_DATA . '/domain_config.php');
    $d_config = array();
    $maxid = getconfig_maxid();
    $success = 0;
    $i = 0;
    foreach($ymdata as $k => $vo){
        $domains = $k;
        if($addwww == 1){
            $domains = 'www.' . $domains . ',' . $domains;
        }
        if(isset($domains_config[$k]) || isset($domains_config['www.' . $k]) || isset($domains_config[$domains])){
            if($actype == 1){
                continue;
            }else{
                $delid = '';
                if(isset($domains_config[$k])){
                    $delid = $domains_config[$k];
                    unset($domains_config[$k]);
                }
                if(isset($domains_config['www.' . $k])){
                    $delid = $domains_config['www.' . $k];
                    unset($domains_config['www.' . $k]);
                }
                if(isset($domains_config[$domains])){
                    $delid = $domains_config[$domains];
                    unset($domains_config[$domains]);
                }
                @unlink(VV_DATA . '/config/' . $delid . '.php');
            }
        }
        if($webtype == 1){
            $web_seo_name = get_rand_arrstr($kwarr, $webnamenum);
            $keywords = $web_seo_name . ',' . get_rand_arrstr($kwarr, $kwnum - $webnamenum);
            $desription = $web_seo_name . ',' . get_rand_arrstr($kwarr, $desnum - $webnamenum);
            list($web_name, $tempaa) = explode(',', $web_seo_name);
        }else if($webtype == 2){
            $web_seo_name = isset($indextitlearr[$i])?$indextitlearr[$i]:$indextitlearr[0];
            $web_name = isset($webnamearr[$i])?$webnamearr[$i]:$webnamearr[0];
            if($keywordsarr)$keywords = isset($keywordsarr[$i])?$keywordsarr[$i]:$keywordsarr[0];
            if($descriptionarr)$desription = isset($descriptionarr[$i])?$descriptionarr[$i]:$descriptionarr[0];
        }
        list($from_url, $from_title) = explode('|', $vo);
        if($from_url == ''){
            continue;
        }
        if($kw_randarr){
            $kw_randarr = get_rand_arrstr($kw_randarr, 11, '');
            for($n = 1;$n <= 10;$n++){
                $web_name = str_replace('{word' . $n . '}', $kw_randarr[$n], $web_name);
                $web_seo_name = str_replace('{word' . $n . '}', $kw_randarr[$n], $web_seo_name);
                $keywords = str_replace('{word' . $n . '}', $kw_randarr[$n], $keywords);
                $desription = str_replace('{word' . $n . '}', $kw_randarr[$n], $desription);
            }
        }
        $setarr = array('web_name' => $web_name, 'web_seo_name' => $web_seo_name, 'web_keywords' => $keywords, 'web_description' => $desription, 'web_domains' => strtolower($domains), 'from_url' => $from_url, 'from_title' => $from_title, 'web_404_url' => '', 'web_tongji' => get_magic($tongji), 'rewrite' => $rewrite, 'web_close' => $web_close, 'charset' => 'auto', 'time' => time(),);
        $d_config[$domains] = $maxid;
        $success++;
        $ruledata = array_merge($rule_cfg, $setarr);
        $file = VV_DATA . '/config/' . $maxid . '.php';
        arr2file($file, $ruledata);
        $maxid++;
        $i++;
    }
    $domains_config = @array_merge($domains_config, $d_config);
    arr2file(VV_DATA . "/domain_config.php", $domains_config);
    ShowMsg("�ɹ�����" . $success . "������~", 'caiji_config.php', 2000);
}
function get_rand_arrstr($arr, $num = 1, $pf = ','){
    if($num < 1)return '';
    shuffle($arr);
    $arr = array_slice($arr, 0, $num);
    if($pf)return implode($pf, $arr);
    return $arr;
}
function getconfig_maxid(){
    $arr = @glob(VV_DATA . '/config/*.php');
    if($arr){
        $arr = array_map('basename', $arr);
        $arr = array_map('intval', $arr);
        $id = max($arr) + 1;
    }else{
        $id = 1;
    }
    return $id;
}
function uptxt($name){
    if(!empty($_FILES[$name]['error'])){
        switch($_FILES[$name]['error']){
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
        if($_FILES[$name]['error'] != 4)ShowMsg($error, '-1', 2000);
    }
    if(!empty($_FILES[$name]['name']) && !empty($_FILES[$name]['tmp_name']) && $_FILES[$name]['error'] == '0'){
        $file_name = $_FILES[$name]['name'];
        $tmp_name = $_FILES[$name]['tmp_name'];
        if(@is_uploaded_file($tmp_name) === false || !is_file($tmp_name)){
            ShowMsg($file_name . "�ϴ�ʧ�ܡ�", '-1', 2000);
        }
        $arr = array();
        if(is_file($tmp_name)){
            $arr = file($tmp_name);
            $arr = array_map('trim', $arr);
        }
        return $arr;
    }
}
