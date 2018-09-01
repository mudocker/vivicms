<?php
 require_once('data.php'); $v_config=require_once('../data/config.php'); require_once('checkAdmin.php'); $id=isset($_GET ['id'])?$_GET ['id']:''; $file=VV_DATA."/flink.conf"; $flink=@file_get_contents($file); if($id==''){echo ADMIN_HEAD; ;echo '<body>
<div class="right">
   ';include "welcome.php";echo '  <div class="right_main">
  <form action="?id=save" method="post" onSubmit="return chk();" >
  <table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">
	<tr class="tb_head">  
		<td colspan="2">
			<h2>全局友情链接设置：<font color="red">节点里可独立设置</font></h2>
		</td>
	</tr>
	<tr nowrap class="firstalt">
		<td width="260"><b>是否自动加到首页底部</b><br>
		<font color="#666666">如不自动添加，则可以使用{flinks}进行调用</font></td>
		<td><select name="flinks_auto_insert">
			<option value="1" ';if ($v_config['flinks_auto_insert']==1 || $v_config['flinks_auto_insert']=='') echo "selected";echo '>是</option>
			<option value="2" ';if ($v_config['flinks_auto_insert']==2) echo "selected";echo '>否</option>
		</select></td>
	</tr>
	<tr class="firstalt">
		<td width="260"><b>选择类型</b><br>
		<font color="#666666"><font color="red">选择友情链接的方式</font></td>
		<td><label><input type="radio" name="flinktype" value="1" ';if ($v_config['flinktype'] == "1" || !$v_config['flinktype']) echo " checked";echo ' onclick="$(\'#config1\').show();$(\'#config2\').hide();" />普通链接</label> <label><input type="radio" name="flinktype" value="2" ';if ($v_config['flinktype'] == "2") echo " checked";echo ' onclick="$(\'#config2\').show();$(\'#config1\').hide();"/>站群轮链</label></td>
	</tr>
	<tr class="firstalt">
		<td width="260"><b>内页是否显示链接</b><br>
		<font color="#666666"></td>
		<td><label><input type="radio" name="flinkshowtype" value="1" ';if ($v_config['flinkshowtype'] == "1") echo " checked";echo ' />是</label> <label><input type="radio" name="flinkshowtype" value="2" ';if ($v_config['flinkshowtype'] == "2" || !$v_config['flinkshowtype']) echo " checked";echo '/>否</label></td>
	</tr>
	<tbody id="config1" ';if ($v_config['flinktype'] == "2") echo "style='display:none'";echo '>
	<tr class="firstalt">
		<td width="260" align="center">
			<b>普通链接</b>
		</td>
		<td>每行一个链接<br>如：&lt;a target="_blank" href=\'http://baidu.com\' &gt;百度&lt;/a&gt;<br>
		<textarea name="flink" cols="80" style="height:120px; width:450px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';echo $flink;echo '</textarea>
		</td>
	</tr>
	</tbody>
	<tbody id="config2"';if ($v_config['flinktype']!= "2") echo "style='display:none'";echo '>
		<tr nowrap class="firstalt">
			<td width="260"><b>链接显示数量</b><br>
			<font color="#666666">随机抽取指定个数的站群域名进行轮链</font></td>
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

';}elseif ($id=='save'){$con=get_magic(trim($_POST['flink'])); $con=str_replace('<?','***',$con); if(@preg_match("/require|include|REQUEST|eval|system|fputs/i", $con)){ShowMsg("含有非法字符,请重新设置",'-1',2000); }else{write($file,$con); extract($_POST); $config=@array_merge($v_config,array('flinktype'=>$flinktype,'flinknum'=>$flinknum,'flinkshowtype'=>$flinkshowtype,'flinks_auto_insert'=>$flinks_auto_insert)); if($config){arr2file(VV_DATA."/config.php",$config); } ShowMsg("恭喜你,修改成功！",'flink.php',2000); } } ;echo '
';?>