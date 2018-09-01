<?php
require_once('data.php');
$v_config = require_once('../data/config.php');
require_once('checkAdmin.php');
$var_25 = isset($_GET ["id"])?$_GET ["id"]:"";
if($var_25 == ""){
    $v_config["sifturl"] = implode("\r\n", explode('[cutline]', $v_config["sifturl"]));
    echo ADMIN_HEAD; ;
    echo '<body>' . "\r\n" . '<div class="right">' . "\r\n" . '   ';
    include 'welcome.php';
    echo '  <div class="right_main">' . "\r\n" . '  <form action="?id=save" method="post">' . "\r\n" . '  <table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">' . "\r\n\t" . '<tr class="tb_head">  ' . "\r\n\t\t" . '<td colspan="2">' . "\r\n\t\t\t" . '<h2>过滤屏蔽设置</h2>' . "\r\n\t\t" . '</td>' . "\r\n\t" . '</tr>' . "\r\n\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>过滤屏蔽开关</b><br>' . "\r\n\t\t\t" . '<font color="#666666">过滤屏蔽</font></td>' . "\r\n\t\t\t" . '<td><select name="con[sifton]">' . "\r\n\t\t\t\t" . '<option value="1" ';
    if ($v_config["sifton"]) echo 'selected';
    echo '>开启</option>' . "\r\n\t\t\t\t" . '<option value="0" ';
    if (!$v_config["sifton"]) echo 'selected';
    echo '>关闭</option>' . "\r\n\t\t\t" . '</select></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t" . '<tr class="firstalt">' . "\r\n\t\t" . '<td width="260">' . "\r\n\t\t\t" . '<b>需要过滤的链接</b></font>' . "\r\n\t\t" . '</td>  ' . "\r\n\t\t" . '<td>每行一条链接，当采集到此地址时自动返回404错误达到屏蔽目的<br>' . "\r\n\t\t" . '<textarea name="con[sifturl]" cols="80" style="height:120px; width:450px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo $v_config["sifturl"];
    echo '</textarea>' . "\r\n\t\t" . '</td>' . "\r\n\t" . '</tr>' . "\r\n" . '<script type="text/javascript">' . "\r\n" . 'document.write(submit);' . "\r\n" . '</script>' . "\r\n" . ' </table>' . "\r\n" . '</form>' . "\r\n" . '  </div>' . "\r\n" . '</div>' . "\r\n";
    include 'footer.php';
    echo '</body>' . "\r\n" . '</html>' . "\r\n\r\n";
}elseif ($var_25 == 'save'){
    $var_30 = $_POST["con"];
    foreach($var_30 as $var_5 => $var_31){
        $var_30[$var_5] = trim($var_30[$var_5]);
    }
    $var_30["sifturl"] = str_replace(array("\r\n", "\r", "\n"), '[cutline]', $var_30["sifturl"]);
    $var_30["sifturl"] = str_replace('<?', '***', $var_30["sifturl"]);
    $var_30 = @array_merge($v_config, $var_30);
    if($var_30){
        arr2file(VV_DATA . '/config.php', $var_30);
    }
    ShowMsg('恭喜你,修改成功！', 'caiji_sift.php', 2000);
} ;
echo "\r\n";
?>