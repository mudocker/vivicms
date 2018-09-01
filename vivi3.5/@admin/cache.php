<?php
require_once('data.php');
$v_config = require_once('../data/config.php');
require_once('checkAdmin.php');
$var_25 = isset($_GET ["id"])?$_GET ["id"]:"";
if ($var_25 == ""){
    echo ADMIN_HEAD; ;
    echo '<body>' . "\r\n" . '<div class="right">' . "\r\n" . ' ';
    include 'welcome.php';
    echo '  <div class="right_main">' . "\r\n" . '<table width="98%" cellspacing="1" cellpadding="4" border="0" class="tableoutline">' . "\r\n\t" . '<tbody>' . "\r\n\t\t" . '<tr class="tb_head">' . "\r\n\t\t\t" . '<td><h2>全局缓存设置：<font color="red">节点里可独立设置</font></h2></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t" . '</tbody>' . "\r\n" . '</table>' . "\r\n" . '<table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">' . "\r\n\t" . '<form action="?id=save" method="post">' . "\r\n\t" . '<tbody id="config1">' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>首页缓存保存时间</b><br>' . "\r\n\t\t\t" . '<font color="#666666"><font color=\'red\'>小时</font>为单位,1为1小时</font></td>' . "\r\n\t\t\t" . '<td><input type="text" name="con[indexcache]" size="25" maxlength="50" value="';
    echo $v_config["indexcache"];
    echo '"onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > 一般24小时内</td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>其他页缓存保存时间</b><br>' . "\r\n\t\t\t" . '<font color="#666666"><font color=\'red\'>小时</font>为单位,1为1小时</font></td>' . "\r\n\t\t\t" . '<td><input type="text" name="con[othercache]" size="25" maxlength="50" value="';
    echo $v_config["othercache"];
    echo '"onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > 一般72小时内</td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>图片缓存保存时间</b><br>' . "\r\n\t\t\t" . '<font color="#666666"><font color=\'red\'>小时</font>为单位,1为1小时</font></td>' . "\r\n\t\t\t" . '<td><input type="text" name="con[imgcachetime]" size="25" maxlength="50" value="';
    echo $v_config["imgcachetime"];
    echo '"onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > 如果设置为0或不填，则不生成缓存' . "\r\n\t\t\t" . '</td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>css缓存保存时间</b><br>' . "\r\n\t\t\t" . '<font color="#666666"><font color=\'red\'>小时</font>为单位,1为1小时</font></td>' . "\r\n\t\t\t" . '<td><input type="text" name="con[csscachetime]" size="25" maxlength="50" value="';
    echo $v_config["csscachetime"];
    echo '"onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > 一般999小时内' . "\r\n\t\t\t" . '</td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>js缓存保存时间</b><br>' . "\r\n\t\t\t" . '<font color="#666666"><font color=\'red\'>小时</font>为单位,1为1小时</font></td>' . "\r\n\t\t\t" . '<td><input type="text" name="con[jscachetime]" size="25" maxlength="50" value="';
    echo $v_config["jscachetime"];
    echo '"onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > 一般999小时内' . "\r\n\t\t\t" . '</td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>缓存大小限制</b><br>' . "\r\n\t\t\t" . '<font color="#666666">超过设定值自动清除缓存,单位为 MB</font></td>' . "\r\n\t\t\t" . '<td><input type="text" name="con[delcache]" size="25" maxlength="50" value="';
    echo $v_config["delcache"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > 一般200内</td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>定时检查缓存大小时间间隔</b><br>' . "\r\n\t\t\t" . '<font color="#666666">单位为天，间隔多少天自动扫描一次缓存大小</font><br><font color="red">扫描耗时长,建议不要设置太小值</font></td>' . "\r\n\t\t\t" . '<td><input type="text" name="con[delcachetime]" size="25" maxlength="50" value="';
    echo $v_config["delcachetime"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >  一般3天内</td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>自动清理缓存开关</b><br>' . "\r\n\t\t\t" . '<font color="#666666">开启后，超过缓存大小限制就自动清理缓存</font></td>' . "\r\n\t\t\t" . '<td><select name="con[deloldcache]">' . "\r\n\t\t\t\t" . '<option value="1" ';
    if($v_config["deloldcache"]) echo 'selected';
    echo '>开启</option>' . "\r\n\t\t\t\t" . '<option value="0" ';
    if(!$v_config["deloldcache"]) echo 'selected';
    echo '>关闭</option>' . "\r\n\t\t\t" . '</select></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>蜘蛛记录开关</b><br>' . "\r\n\t\t\t" . '<font color="#666666">记录各大搜索引擎蜘蛛爬行动态</font></td>' . "\r\n\t\t\t" . '<td><select name="con[robotlogon]">' . "\r\n\t\t\t\t" . '<option value="1" ';
    if ($v_config["robotlogon"]) echo 'selected';
    echo '>开启</option>' . "\r\n\t\t\t\t" . '<option value="0" ';
    if (!$v_config["robotlogon"]) echo 'selected';
    echo '>关闭</option>' . "\r\n\t\t\t" . '</select></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>css缓存开关</b><br>' . "\r\n\t\t\t" . '<font color="#666666">开启css缓存，加快速度</font></td>' . "\r\n\t\t\t" . '<td><select name="con[csscache]">' . "\r\n\t\t\t\t" . '<option value="1" ';
    if($v_config["csscache"]) echo 'selected';
    echo '>开启</option>' . "\r\n\t\t\t\t" . '<option value="0" ';
    if(!$v_config["csscache"]) echo 'selected';
    echo '>关闭</option>' . "\r\n\t\t\t" . '</select></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>js缓存开关</b><br>' . "\r\n\t\t\t" . '<font color="#666666">开启js缓存，加快速度，<font color="red">一般不需要开启</font></font></td>' . "\r\n\t\t\t" . '<td><select name="con[jscache]">' . "\r\n\t\t\t\t" . '<option value="1" ';
    if($v_config["jscache"]) echo 'selected';
    echo '>开启</option>' . "\r\n\t\t\t\t" . '<option value="0" ';
    if(!$v_config["jscache"]) echo 'selected';
    echo '>关闭</option>' . "\r\n\t\t\t" . '</select></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>图片缓存/破解防盗链开关</b><br>' . "\r\n\t\t\t" . '<font color="red">如未防盗链可不开启</font></td>' . "\r\n\t\t\t" . '<td><select name="con[imgcache]">' . "\r\n\t\t\t\t" . '<option value="1" ';
    if($v_config["imgcache"]) echo 'selected';
    echo '>开启</option>' . "\r\n\t\t\t\t" . '<option value="0" ';
    if(!$v_config["imgcache"]) echo 'selected';
    echo '>关闭</option>' . "\r\n\t\t\t" . '</select></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>页面缓存开关</b><br>' . "\r\n\t\t\t" . '<font color="#666666">开启页面缓存，节省服务器CPU资源</font></td>' . "\r\n\t\t\t" . '<td><select name="con[cacheon]">' . "\r\n\t\t\t\t" . '<option value="1" ';
    if ($v_config["cacheon"]) echo 'selected';
    echo '>开启</option>' . "\r\n\t\t\t\t" . '<option value="0" ';
    if (!$v_config["cacheon"]) echo 'selected';
    echo '>关闭</option>' . "\r\n\t\t\t" . '</select></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr class="firstalt"><td align="center" colspan="2"><input type="submit" value=" 提交 " name="submit" class="bginput">&nbsp;&nbsp;<input type="reset" value=" 重置 " name="Input" class="bginput"></td></tr>' . "\r\n\t" . '</tbody>' . "\r\n\t" . '</form>' . "\r\n" . '</table>' . "\r\n" . '</div>' . "\r\n" . '</div>' . "\r\n";
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
    ShowMsg('恭喜你,修改成功！', 'cache.php', 2000);
}
?>