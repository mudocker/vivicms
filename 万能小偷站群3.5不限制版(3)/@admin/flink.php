<?php
 require_once('data.php'); $v_config=require_once('../data/config.php'); require_once('checkAdmin.php'); $id=isset($_GET ['id'])?$_GET ['id']:''; $file=VV_DATA."/flink.conf"; $flink=@file_get_contents($file); if($id==''){echo ADMIN_HEAD; ;echo '<body>
<div class="right">
   ';include "welcome.php";echo '  <div class="right_main">
  <form action="?id=save" method="post" onSubmit="return chk();" >
  <table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">
	<tr class="tb_head">  
		<td colspan="2">
			<h2>ȫ�������������ã�<font color="red">�ڵ���ɶ�������</font></h2>
		</td>
	</tr>
	<tr nowrap class="firstalt">
		<td width="260"><b>�Ƿ��Զ��ӵ���ҳ�ײ�</b><br>
		<font color="#666666">�粻�Զ���ӣ������ʹ��{flinks}���е���</font></td>
		<td><select name="flinks_auto_insert">
			<option value="1" ';if ($v_config['flinks_auto_insert']==1 || $v_config['flinks_auto_insert']=='') echo "selected";echo '>��</option>
			<option value="2" ';if ($v_config['flinks_auto_insert']==2) echo "selected";echo '>��</option>
		</select></td>
	</tr>
	<tr class="firstalt">
		<td width="260"><b>ѡ������</b><br>
		<font color="#666666"><font color="red">ѡ���������ӵķ�ʽ</font></td>
		<td><label><input type="radio" name="flinktype" value="1" ';if ($v_config['flinktype'] == "1" || !$v_config['flinktype']) echo " checked";echo ' onclick="$(\'#config1\').show();$(\'#config2\').hide();" />��ͨ����</label> <label><input type="radio" name="flinktype" value="2" ';if ($v_config['flinktype'] == "2") echo " checked";echo ' onclick="$(\'#config2\').show();$(\'#config1\').hide();"/>վȺ����</label></td>
	</tr>
	<tr class="firstalt">
		<td width="260"><b>��ҳ�Ƿ���ʾ����</b><br>
		<font color="#666666"></td>
		<td><label><input type="radio" name="flinkshowtype" value="1" ';if ($v_config['flinkshowtype'] == "1") echo " checked";echo ' />��</label> <label><input type="radio" name="flinkshowtype" value="2" ';if ($v_config['flinkshowtype'] == "2" || !$v_config['flinkshowtype']) echo " checked";echo '/>��</label></td>
	</tr>
	<tbody id="config1" ';if ($v_config['flinktype'] == "2") echo "style='display:none'";echo '>
	<tr class="firstalt">
		<td width="260" align="center">
			<b>��ͨ����</b>
		</td>
		<td>ÿ��һ������<br>�磺&lt;a target="_blank" href=\'http://baidu.com\' &gt;�ٶ�&lt;/a&gt;<br>
		<textarea name="flink" cols="80" style="height:120px; width:450px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';echo $flink;echo '</textarea>
		</td>
	</tr>
	</tbody>
	<tbody id="config2"';if ($v_config['flinktype']!= "2") echo "style='display:none'";echo '>
		<tr nowrap class="firstalt">
			<td width="260"><b>������ʾ����</b><br>
			<font color="#666666">�����ȡָ��������վȺ������������</font></td>
			<td><input name="flinknum" type="text" value="';echo $v_config['flinknum']?$v_config['flinknum']:10;echo '" size="10" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>
		</tr>
	</tbody>
<script type="text/javascript">
document.write(submit);
</script>
 </table>
</form>
  </div>
</div>
';include "footer.php";echo '</body>
</html>

';}elseif ($id=='save'){$con=get_magic(trim($_POST['flink'])); $con=str_replace('<?','***',$con); if(@preg_match("/require|include|REQUEST|eval|system|fputs/i", $con)){ShowMsg("���зǷ��ַ�,����������",'-1',2000); }else{write($file,$con); extract($_POST); $config=@array_merge($v_config,array('flinktype'=>$flinktype,'flinknum'=>$flinknum,'flinkshowtype'=>$flinkshowtype,'flinks_auto_insert'=>$flinks_auto_insert)); if($config){arr2file(VV_DATA."/config.php",$config); } ShowMsg("��ϲ��,�޸ĳɹ���",'flink.php',2000); } } ;echo '
';?>