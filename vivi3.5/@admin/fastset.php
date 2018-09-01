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
			<td colspan="2"><h2>操作导航：</h2></td>
		</tr>
		<tr class="firstalt">
			<td colspan="2">
				<ul class="do_nav">
					<li id="tab1" class="cur"><a onclick="tab(1,6);" href="javascript:">批量导入</a></li>
					<li id="tab2"><a onclick="tab(2,6);" href="javascript:">批量设置/修改</a></li>
					<a href="?ac=reset_domain" style="line-height:30px;padding-left:20px;color:red">修正域名绑定</a>&nbsp;
					<a href="javascript:" onclick="if(confirm(\'清空全部节点?不可恢复！\')){ $(this).html(\'正在清除...\');location.href=\'?ac=delall\';}" style="line-height:30px;padding-left:20px;color:red">清空全部节点</a>
				</ul>
			</td>
		</tr>
	</tbody>
</table>
<table width="98%" cellspacing="1" cellpadding="4" border="0" class="tableoutline" id="config1">
	<tbody>
		<tr nowrap  class="tb_head">
			<td colspan="2"><h2>批量导入</h2></td>
		</tr>
		<form method="post" action="?ac=uptxt" enctype="multipart/form-data">
			<tr class="firstalt">
				<td width="260"><b>选择操作</b><br>
				<font color="#666666"><font color="red">正确选择你需要的操作</font></td>
				<td><label><input type="radio" name="actype" value="1" checked />新增</label> <label><input type="radio" name="actype" value="2" />覆盖（覆盖重复节点）</label></td>
			</tr>
			<style type="text/css">
				.webtype td,.webtype1 td,.webtype2 td{background:#f9f9f9}
				.webtype1 td.son,.webtype2 td.son{padding-left:30px;}
				.webtype2{display:none}
			</style>
			<tr class="firstalt webtype">
				<td width="260"><b>网站信息导入方式</b><br>
				<font color="#666666"><font color="red">正确选择你需要的类型</font></td>
				<td><label><input type="radio" name="webtype" value="1" checked  onclick="$(\'.webtype1\').show();$(\'.webtype2\').hide();"/>关键词随机组合模式</label> <label><input type="radio" name="webtype" value="2" onclick="$(\'.webtype1\').hide();$(\'.webtype2\').show();" />固定模式（每个库的顺序是对应的）</label></td>
			</tr>
			<tr nowrap class="firstalt webtype1">
				<td width="260" class="son">∟ <b>关键词库</b><br>
				<font color="#666666">关键词txt库，每行一个关键词</font></td>
				<td><input name="kwfile" type="file"></td>
			</tr>
			<tr nowrap class="firstalt webtype1">
				<td width="260" class="son">∟ <b>首页标题由几个关键词随机组合</b><br>
				<font color="#666666">关键词库组合成首页标题，建议设置3个以内</font></td>
				<td><input name="webnamenum" type="text" value="4" size="10" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>
			</tr>
			<tr nowrap class="firstalt webtype1">
				<td width="260" class="son">∟ <b>keywords由几个关键词随机组合</b><br>
				<font color="#666666">关键词库组合成keywords，建议设置5个以内</font></td>
				<td><input name="kwnum" type="text" value="4" size="10" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>
			</tr>
			<tr nowrap class="firstalt webtype1">
				<td width="260" class="son">∟ <b>description由几个关键词随机组合</b><br>
				<font color="#666666">关键词库组合成描述，建议设置10个以内</font></td>
				<td><input name="desnum" type="text" value="8" size="10" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>
			</tr>
			<tr nowrap class="firstalt webtype2">
				<td width="260" class="son">∟ <b>随机关键词库</b><br>
				<font color="#666666">关键词txt库，每行一个关键词</font><br><font color="red">可在下面的txt库中调用<br>调用标签：{word1}...{word10}</font></td>
				<td><input name="kwfile_rand" type="file">&nbsp;<font color="red">可选</font></td>
			</tr>
			<tr nowrap class="firstalt webtype2">
				<td width="260" class="son">∟ <b>首页标题库</b><br>
				<font color="#666666">首页标题txt库，每行一个标题</font></td>
				<td><input name="indextitlefile" type="file"></td>
			</tr>
			<tr nowrap class="firstalt webtype2">
				<td width="260" class="son">∟ <b>网站名称库</b><br>
				<font color="#666666">网站名称txt库，每行一个网站名称</font></td>
				<td><input name="webnamefile" type="file"></td>
			</tr>
			<tr nowrap class="firstalt webtype2">
				<td width="260" class="son">∟ <b>keywords库</b><br>
				<font color="#666666">keywords库，每行一个keywords</font></td>
				<td><input name="keywordsfile" type="file">&nbsp;<font color="red">可选</font></td>
			</tr>
			<tr nowrap class="firstalt webtype2">
				<td width="260" class="son">∟ <b>description描述库</b><br>
				<font color="#666666">description库，每行一个description</font></td>
				<td><input name="descriptionfile" type="file">&nbsp;<font color="red">可选</font></td>
			</tr>
			<tr class="firstalt">
				<td width="260"><b>绑定域名库</b><br>
				<font color="#666666">绑定的域名txt库，每行一个，纯域名<font color="red">不要含http://</font></font></td>
				<td><input name="ymfile" type="file"></td>
			</tr>
			<tr class="firstalt">
				<td width="260"><b>是否自动添加www域名</b><br>
				<font color="#666666"><font color="red">导入自动带上www的域名</font></td>
				<td><label><input type="radio" name="addwww" value="1" checked  />是</label> <label><input type="radio" name="addwww" value="0" />否</label></td>
			</tr>
			<tr class="firstalt">
				<td width="260"><b>采集网站库</b><br>
				<font color="#666666">采集的网站库，每行一个目标站地址，<font color="red">http://开头</font><br><font color="green">如设置目标站名称则用|号分隔在右边如：<br>http://www.baidu.com/|百度</font></font></td>
				<td><input name="urlfile" type="file"></td>
			</tr>
			<tr nowrap class="firstalt">
				<td width="260"><b>域名与采集站的比例</b><br>
				<font color="#666666">多少个域名对应一个采集站</font></td>
				<td><input name="ymnum" type="text" value="5" size="10" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>
			</tr>
			<tr class="firstalt">
				<td width="260" valign="top"><b>伪静态开关</b><br>
				<font color="#666666">伪静态开关<br></font></td>
				<td><select name="rewrite">
					<option value="1">开启</option>
					<option value="0" selected="">关闭</option>
				</select></td>
			</tr>
			<tr class="firstalt">
				<td width="260" valign="top"><b>站点状态</b><br>
				<font color="#666666">是否开启站点<br></font></td>
				<td><select name="web_close">
					<option value="off">开启</option>
					<option value="on">关闭</option>
				</select></td>
			</tr>
			<tr class="firstalt">
				<td width="260" valign="top"><b>统计代码</b><br>
				<font color="#666666">流量统计代码<br></font></td>
				<td><textarea name="tongji" cols="80" style="height: 70px; width: 350px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></textarea></td>
			</tr>
			<tr class="firstalt">
				<td width="260">&nbsp;</td>
				<td>
					<input class="bginput" type="submit" name="submit" onclick=\'this.value="正在上传..."\' value=" 点击导入 ">
				</td>
			</tr>
		</form>
	</tbody>
</table>
<table width="98%" cellspacing="1" cellpadding="4" border="0" class="tableoutline" id="config2" style="display:none">
	<tr nowrap class="firstalt"><td>
	<table width="98%" cellspacing="1" cellpadding="4" border="0" class="tableoutline">
		<tr nowrap  class="tb_head">
			<td colspan="2"><h2 style="color:#339900;font-weight:bold;">批量替换/设置的范围</h2></td>
		</tr>
		<tr nowrap class="firstalt">
			<td width="260"><b>本次操作范围</b><br>
			<font color="#666666">填写节点ID范围，格式： 1-100<br>留空则为全部节点</font></td>
			<td><input id="fanwei" type="text" value="" size="10" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>
		</tr>
	</table>
	<form method="post" action="?ac=set_siftags"><input type="hidden" name="fanwei" value="" />
		<table width="98%" cellspacing="1" cellpadding="4" border="0" class="tableoutline">
			<tr nowrap  class="tb_head">
				<td colspan="2"><h2 style="color:#339900;font-weight:bold;">批量设置过滤选项</h2></td>
			</tr>	
			<tr nowrap class="firstalt">
				<td width="260"><b>标签过滤</b><br>
				<font color="#666666">采集页面时过滤掉这些标签<br><font color="red">慎用</font>,否则将可能出现采集不完整和错位现象</font></td>
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
				<td width="260"><b>站内外过滤</b><br>
				<font color="#666666">可过滤站内或站外不必要的链接或文件</font></td>
				<td><input name="siftags[]" type="checkbox" value="outa" checked /> <font color="red">站外</font>链接
					<input name="siftags[]" type="checkbox" value="outjs" checked /> <font color="red">站外</font>js文件
					<input name="siftags[]" type="checkbox" value="outcss"/> <font color="red">站外</font>css文件
					<input name="siftags[]" type="checkbox" value="locala"/> <font color="blue">站内</font>链接
					<input name="siftags[]" type="checkbox" value="localjs"/> <font color="blue">站内</font>js文件
					<input name="siftags[]" type="checkbox" value="localcss" /> <font color="blue">站内</font>css文件</td>
			</tr>
			<tr class="firstalt">
				<td width="260">&nbsp;</td>
				<td>
					<input class="bginput" type="submit" name="submit" onclick=\'this.value="正在设置中..."\' value=" 点击批量设置 ">
				</td>
			</tr>
		</table>
	</form>
	<form method="post" action="?ac=set_gaoji"><input type="hidden" name="fanwei" value="" />
		<table width="98%" cellspacing="1" cellpadding="4" border="0" class="tableoutline">
			<tr nowrap  class="tb_head">
				<td colspan="2"><h2 style="color:#339900;font-weight:bold;">批量设置高级功能</h2></td>
			</tr>
			<tr nowrap class="firstalt">
				<td width="260"><b>选择功能</b><br>
				<font color="#666666">批量设置高级功能开关</font></td>
				<td><select name="key">
					<option value="rewrite">伪静态</option>
					<option value="replace">伪原创</option>
				</select>&nbsp;&nbsp;<select name="value">
					<option value="1">开启</option>
					<option value="0" selected="">关闭</option>
				</select>  </td>
			</tr>
			<tr class="firstalt">
				<td width="260">&nbsp;</td>
				<td>
					<input class="bginput" type="submit" name="submit" onclick=\'this.value="正在设置中..."\' value=" 点击批量设置 ">
				</td>
			</tr>
		</table>
	</form>
	<form method="post" action="?ac=set_theme"><input type="hidden" name="fanwei" value="" />
		<table width="98%" cellspacing="1" cellpadding="4" border="0" class="tableoutline">
			<tr nowrap  class="tb_head">
				<td colspan="2"><h2 style="color:#339900;font-weight:bold;">批量设置超级模板</h2></td>
			</tr>
			<tr nowrap class="firstalt">
				<td width="260"><b>开关</b><br>
				<font color="#666666">批量启动/关闭超级模板</font></td>
				<td><select name="theme_open">
					<option value="1">开启</option>
					<option value="0" selected="">关闭</option>
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
				<td width="260"><b>选择模板风格</b><br>
				<font color="#666666">批量设置模板风格</font></td>
				<td><select name="theme_dir">
					<option value="">无</option>
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
					<input class="bginput" type="submit" name="submit" onclick=\'this.value="正在设置中..."\' value=" 点击批量设置 ">
				</td>
			</tr>
		</table>
	</form>
	<form method="post" action="?ac=set_tj"><input type="hidden" name="fanwei" value="" />
		<table width="98%" cellspacing="1" cellpadding="4" border="0" class="tableoutline">
			<tr nowrap  class="tb_head">
				<td colspan="2"><h2 style="color:#339900;font-weight:bold;">批量设置统计代码</h2></td>
			</tr>
			<tr class="firstalt">
				<td width="260" valign="top"><b>统计代码</b><br>
				<font color="#666666">流量统计代码<br></font></td>
				<td><textarea name="tongji" cols="80" style="height: 70px; width: 450px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></textarea></td>
			</tr>
			<tr class="firstalt">
				<td width="260">&nbsp;</td>
				<td>
					<input class="bginput" type="submit" name="submit" onclick=\'this.value="正在设置中..."\' value=" 点击批量设置 ">
				</td>
			</tr>
		</table>
	</form>
	<form method="post" action="?ac=replace_fromtitle"><input type="hidden" name="fanwei" value="" />
		<table width="98%" cellspacing="1" cellpadding="4" border="0" class="tableoutline">
			<tr nowrap  class="tb_head">
				<td colspan="2"><h2 style="color:#339900;font-weight:bold;">批量替换目标站名称</h2></td>
			</tr>
			<tr nowrap class="firstalt">
				<td width="260"><b>原来的目标站名称</b></td>
				<td><input name="oldtitle" type="text" value="" size="50" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>
			</tr>
			<tr nowrap class="firstalt">
				<td width="260"><b>新的目标站名称</b></td>
				<td><input name="newtitle" type="text" value="" size="50" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>
			</tr>
			<tr class="firstalt">
				<td width="260">&nbsp;</td>
				<td>
					<input class="bginput" type="submit" name="submit" onclick=\'this.value="正在替换中..."\' value=" 点击批量替换 ">
				</td>
			</tr>
		</table>
	</form>
	<form method="post" action="?ac=replace_url"><input type="hidden" name="fanwei" value="" />
		<table width="98%" cellspacing="1" cellpadding="4" border="0" class="tableoutline">
			<tr nowrap  class="tb_head">
				<td colspan="2"><h2 style="color:#339900;font-weight:bold;">批量替换目标采集网站地址</h2></td>
			</tr>
			<tr nowrap class="firstalt">
				<td width="260"><b>原来的目标站地址</b><br>
				<font color="#666666">http://开头</font></td>
				<td><input name="oldurl" type="text" value="http://" size="50" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>
			</tr>
			<tr nowrap class="firstalt">
				<td width="260"><b>新的目标站地址</b><br>
				<font color="#666666">http://开头</font></td>
				<td><input name="newurl" type="text" value="http://" size="50" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>
			</tr>
			<tr class="firstalt">
				<td width="260">&nbsp;</td>
				<td>
					<input class="bginput" type="submit" name="submit" onclick=\'this.value="正在替换中..."\' value=" 点击批量替换 ">
				</td>
			</tr>
		</table>
	</form>
	<form method="post" action="?ac=replace_kw"><input type="hidden" name="fanwei" value="" />
		<table width="98%" cellspacing="1" cellpadding="4" border="0" class="tableoutline">
			<tr nowrap  class="tb_head">
				<td colspan="2"><h2 style="color:#339900;font-weight:bold;">批量替换关键词</h2></td>
			</tr>
			<tr nowrap class="firstalt">
				<td width="260"><b>原来的关键词</b><br>
				<font color="#666666">需要替换的关键词</font></td>
				<td><input name="oldkw" type="text" value="" size="50" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>
			</tr>
			<tr nowrap class="firstalt">
				<td width="260"><b>新的关键词</b><br>
				<font color="#666666">替换后的关键词</font></td>
				<td><input name="newkw" type="text" value="" size="50" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>
			</tr>
			<tr class="firstalt">
				<td width="260">&nbsp;</td>
				<td>
					<input class="bginput" type="submit" name="submit" onclick=\'this.value="正在替换中..."\' value=" 点击批量替换 ">
				</td>
			</tr>
		</table>
	</form>
	<form method="post" action="?ac=replace_domain"><input type="hidden" name="fanwei" value="" />
		<table width="98%" cellspacing="1" cellpadding="4" border="0" class="tableoutline">
			<tr nowrap  class="tb_head">
				<td colspan="2"><h2 style="color:#339900;font-weight:bold;">批量替换绑定的域名</h2></td>
			</tr>
			<tr nowrap class="firstalt">
				<td width="260"><b>原来的域名</b><br>
				<font color="#666666">需要替换的域名，不要加http://</font></td>
				<td><input name="olddomain" type="text" value="" size="50" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>
			</tr>
			<tr nowrap class="firstalt">
				<td width="260"><b>新的域名</b><br>
				<font color="#666666">替换后的域名，不要加http://</font></td>
				<td><input name="newdomain" type="text" value="" size="50" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>
			</tr>
			<tr class="firstalt">
				<td width="260">&nbsp;</td>
				<td>
					<input class="bginput" type="submit" name="submit" onclick=\'this.value="正在替换中..."\' value=" 点击批量替换 ">
				</td>
			</tr>
		</table>
	</form>
	<form method="post" action="?ac=set_zdy"><input type="hidden" name="fanwei" value="" />
		<table width="98%" cellspacing="1" cellpadding="4" border="0" class="tableoutline">
			<tr nowrap  class="tb_head">
				<td colspan="2"><h2 style="color:#339900;font-weight:bold;">自定义批量设置（警惕，专家使用模式）</h2></td>
			</tr>
			
			<tr nowrap class="firstalt">
				<td width="260"><b>键</b><br>
				<font color="#666666">专家使用模式</font></td>
				<td><input name="key" type="text" value="" size="20" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>
			</tr>
			<tr class="firstalt">
				<td width="260" valign="top"><b>值</b><br>
				<font color="#666666">专家使用模式<br></font></td>
				<td><textarea name="value" cols="80" style="height: 70px; width: 450px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></textarea></td>
			</tr>
			<tr class="firstalt">
				<td width="260">&nbsp;</td>
				<td>
					<input class="bginput" type="submit" name="submit" onclick=\'this.value="正在设置中..."\' value=" 点击批量设置 ">
				</td>
			</tr>
		</table>
	</form>
	<form method="post" action="?ac=replace_zdy"><input type="hidden" name="fanwei" value="" />
		<table width="98%" cellspacing="1" cellpadding="4" border="0" class="tableoutline">
			<tr nowrap  class="tb_head">
				<td colspan="2"><h2 style="color:#339900;font-weight:bold;">自定义批量替换（警惕，专家使用模式）</h2></td>
			</tr>
			<tr nowrap class="firstalt">
				<td width="260"><b>键</b><br>
				<font color="#666666">专家使用模式</font></td>
				<td><input name="key" type="text" value="" size="20" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>
			</tr>
			<tr class="firstalt">
				<td width="260" valign="top"><b>原来的值</b><br>
				<font color="#666666">专家使用模式<br></font></td>
				<td><textarea name="oldvalue" cols="80" style="height: 60px; width: 450px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></textarea></td>
			</tr>
			<tr class="firstalt">
				<td width="260" valign="top"><b>新的值</b><br>
				<font color="#666666">专家使用模式<br></font></td>
				<td><textarea name="newvalue" cols="80" style="height: 60px; width: 450px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></textarea></td>
			</tr>
			<tr class="firstalt">
				<td width="260">&nbsp;</td>
				<td>
					<input class="bginput" type="submit" name="submit" onclick=\'this.value="正在设置中..."\' value=" 点击批量设置 ">
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
    ShowMsg("清除全部节点成功。", '?', 1000);
}
if($ac == 'replace_url'){
    extract($_POST);
    replace_cfg(array('from_url' => array($oldurl, $newurl)), $fanwei);
    ShowMsg("目标站地址批量替换成功~", '?', 1000);
}
if($ac == 'replace_zdy'){
    extract($_POST);
    replace_cfg(array($key => array($oldvalue, $newvalue)), $fanwei);
    ShowMsg("自定义批量替换成功~", '?', 1000);
}
if($ac == 'replace_fromtitle'){
    extract($_POST);
    replace_cfg(array('from_title' => array($oldtitle, $newtitle)), $fanwei);
    ShowMsg("目标站名称批量替换成功~", '?', 1000);
}
if($ac == 'replace_kw'){
    extract($_POST);
    replace_cfg(array('web_name' => array($oldkw, $newkw), 'web_seo_name' => array($oldkw, $newkw), 'web_keywords' => array($oldkw, $newkw), 'web_description' => array($oldkw, $newkw),), $fanwei);
    ShowMsg("关键词批量替换成功~", '?', 1000);
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
    ShowMsg("域名批量替换成功~", '?', 1000);
}
if($ac == 'set_siftags'){
    extract($_POST);
    set_cfg('siftags', $siftags, $fanwei);
    ShowMsg("过滤批量替换成功~", '?', 1000);
}
if($ac == 'set_gaoji'){
    extract($_POST);
    set_cfg($key, $value, $fanwei);
    ShowMsg("批量设置高级功能成功~", '?', 1000);
}
if($ac == 'set_theme'){
    extract($_POST);
    set_cfg('theme_open', $theme_open, $fanwei);
    set_cfg('theme_dir', $theme_dir, $fanwei);
    ShowMsg("批量设置超级模板成功~", '?', 1000);
}
if($ac == 'set_zdy'){
    extract($_POST);
    set_cfg($key, $value, $fanwei);
    ShowMsg("自定义批量设置成功~", '?', 1000);
}
if($ac == 'set_tj'){
    extract($_POST);
    set_cfg('web_tongji', $tongji, $fanwei);
    ShowMsg("统计设置成功~", '?', 1000);
}
if($ac == 'reset_domain'){
    reset_domain();
    ShowMsg("修正域名绑定成功~", '?', 1000);
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
        ShowMsg("域名库、采集网站库不能为空~", '?', 1000);
    }
    $tongji = get_magic($tongji);
    if($webtype == 1){
        $kwarr = uptxt('kwfile');
        if(empty($kwarr)){
            ShowMsg("关键词库不能为空~", '?', 1000);
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
            ShowMsg("首页标题库、网站名称库不能为空~", '?', 1000);
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
    ShowMsg("成功导入" . $success . "个域名~", 'caiji_config.php', 2000);
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
        case '1':$error = '超过php.ini允许的大小';
            break;
        case '2':$error = '超过表单允许的大小';
            break;
        case '3':$error = '图片只有部分被上传';
            break;
        case '4':$error = '请选择图片';
            break;
        case '6':$error = '找不到临时目录';
            break;
        case '7':$error = '写文件到硬盘出错';
            break;
        case '8':$error = 'File upload stopped by extension';
            break;
        case '999':default:$error = '未知错误';
        }
        if($_FILES[$name]['error'] != 4)ShowMsg($error, '-1', 2000);
    }
    if(!empty($_FILES[$name]['name']) && !empty($_FILES[$name]['tmp_name']) && $_FILES[$name]['error'] == '0'){
        $file_name = $_FILES[$name]['name'];
        $tmp_name = $_FILES[$name]['tmp_name'];
        if(@is_uploaded_file($tmp_name) === false || !is_file($tmp_name)){
            ShowMsg($file_name . "上传失败。", '-1', 2000);
        }
        $arr = array();
        if(is_file($tmp_name)){
            $arr = file($tmp_name);
            $arr = array_map('trim', $arr);
        }
        return $arr;
    }
}
