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
                ShowMsg('过滤规则的正则表达式格式不正确', '?', 500);
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
                ShowMsg('前置过滤规则的正则表达式格式不正确', '?', 500);
            }
        }
        $var_30["siftrules_before"] = implode('[cutline]', $var_51);
    }
    $var_30 = @array_merge($v_config, $var_30);
    if($var_30){
        $var_44 = arr2file(VV_DATA . '/config.php', $var_30);
        if($var_44 === false){
            ShowMsg('修改失败，检查文件写入权限！', '?', 500);
        }
    }
    ShowMsg('恭喜你,修改成功！', '?', 500);
}
echo ADMIN_HEAD; ;
echo '<body>' . "\r\n" . '<div class="right">' . "\r\n" . '   ';
include 'welcome.php';
echo '  <div class="right_main">' . "\r\n" . '  <form action="?ac=save" method="post" >' . "\r\n\t" . '<table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">' . "\r\n\t\t" . '<tbody>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt"><td colspan="2"><font style="font-size:18px" color="red">这里为全局替换设置，全部的站都受此影响！</font></td></tr>' . "\r\n\t\t\t" . '<tr class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260" valign=\'top\' style="background:#fafafa"><b>字符串替换规则</b><br>' . "\r\n\t\t\t" . '<font color="#666666">替换前和替换后直接用<font color="red">******</font>分隔<br>每一对替换后面用下面的字符分隔开来<br><font color="red">##########</font><br>例子：<br><div style=\'padding:5px;border:1px dotted #ff6600;background:#f6f6f6\'>我是替换前<font color="red">******</font>我是替换后<br><font color="red">##########</font><br>百度<font color="red">******</font>{web_name}</font><br><font color="red">##########</font></div>' . "\r\n\t\t\t\t" . '<div style="margin:8px 0;padding:5px 0;border-top:1px solid #eee;">' . "\r\n\t\t\t\t\t" . '<b>标签说明：</b><br>' . "\r\n\t\t\t\t\t" . '{web_name} -> 网站名称<br>' . "\r\n\t\t\t\t\t" . '{web_url} -> 网站地址<br>' . "\r\n\t\t\t\t\t" . '{web_domain} -> 当前域名<br>' . "\r\n\t\t\t\t\t" . '{web_thisurl} -> 当前页面url<br>' . "\r\n\t\t\t\t\t" . '{web_remark} -> 伪静态标示符<br>' . "\r\n\t\t\t\t\t" . '{ad.广告标识} -> 广告标签<br>' . "\r\n\t\t\t\t\t" . '{zdy.标签} -> 自定义标签<br>' . "\r\n\t\t\t\t" . '</div>' . "\r\n\t\t\t\t" . '<div style="margin:8px 0;padding:5px 0;border-top:1px solid #eee;">' . "\r\n\t\t\t\t\t" . '<b>页面区分：</b><br>' . "\r\n\t\t\t\t\t" . '在替换规则开头加<br><font color="red">index@@</font>表示只替换首页<br><font color="red">other@@</font>表示只替换内页' . "\r\n\t\t\t\t" . '</div>' . "\r\n\t\t\t" . '</font>' . "\r\n\t\t\t" . '</td>' . "\r\n\t\t\t" . '<td><textarea name="con[replacerules]" style="height: 450px; width: 750px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
echo _htmlspecialchars($v_config["replacerules"]);
echo '</textarea></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260" valign=\'top\'><b>正则替换规则</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">正则替换表达式，一行一个，格式如下：<br>' . "\r\n\t\t\t\t" . '<div style=\'padding:5px;border:1px dotted #ff6600;background:#f6f6f6\'>' . "\r\n\t\t\t\t\t" . '<font color="red">{vivi replace=\'</font>替换后<font color="red">\'}</font>正则表达式<font color="red">{/vivi}</font><br>' . "\r\n\t\t\t\t\t" . '<font color="blue">替换后如含有单引号则使用[d]代替如：</font><br>' . "\r\n\t\t\t\t\t" . '<font color="red">{vivi replace=\'</font>[d]替换后[d]<font color="red">\'}</font>正则<font color="red">{/vivi}</font>' . "\r\n\t\t\t\t" . '</div>' . "\r\n\t\t\t\t\t" . '<div style="margin:8px 0;padding:5px 0;border-top:1px solid #eee;">' . "\r\n\t\t\t\t\t\t" . '<b>标签说明：</b><br>同上' . "\r\n\t\t\t\t\t" . '</div>' . "\r\n\t\t\t\t" . '</font></td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[siftrules]" style="height: 250px; width: 750px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
echo _htmlspecialchars($v_config["siftrules"]);
echo '</textarea></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>开启前置替换</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">替换最开始的代码（即目标站的原始html）<br><font color="red">特殊用途，一般不用开启</font></font></td>' . "\r\n\t\t\t\t" . '<td>' . "\r\n\t\t\t\t\t" . '<label><input type="radio" id="replace_before_on" name="con[replace_before_on]" value="1" ';
if ($v_config["replace_before_on"]) echo ' checked';
echo ' />开启</label>' . "\r\n\t\t\t\t\t" . '<label><input type="radio" id="replace_before_off" name="con[replace_before_on]" value="0" ';
if (!$v_config["replace_before_on"]) echo ' checked';
echo ' />关闭</label>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr class="firstalt replace_before_body"';
if (!$v_config["replace_before_on"]) echo ' style=\'display:none\'';
echo '>' . "\r\n\t\t\t\t" . '<td width="260" valign=\'top\'><b>前置字符串替换规则</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">使用方法同上面的替换规则一致</font>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[replacerules_before]" style="height: 150px; width: 750px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
echo _htmlspecialchars($v_config["replacerules_before"]);
echo '</textarea></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt replace_before_body"';
if (!$v_config["replace_before_on"]) echo ' style=\'display:none\'';
echo '>' . "\r\n\t\t\t\t" . '<td width="260" valign=\'top\'><b>前置正则替换规则</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666"><font color="#666666">使用方法同上面的正则替换规则一致</font></td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[siftrules_before]" style="height: 150px; width: 750px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
echo _htmlspecialchars($v_config["siftrules_before"]);
echo '</textarea></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t" . '</tbody>' . "\r\n" . '<script>' . "\r\n" . '$(function() {' . "\r\n\t" . '$("#replace_before_on").click(function(){' . "\r\n\t\t" . '$(".replace_before_body").show();' . "\r\n\t" . '});' . "\r\n\t" . '$("#replace_before_off").click(function(){' . "\r\n\t\t" . '$(".replace_before_body").hide();' . "\r\n\t" . '});' . "\r\n" . '});' . "\r\n" . 'document.write(submit);' . "\r\n" . '</script>' . "\r\n" . ' </table>' . "\r\n" . '</form>' . "\r\n" . '  </div>' . "\r\n" . '</div>' . "\r\n";
include 'footer.php';
echo '</body>' . "\r\n" . '</html>';
?>