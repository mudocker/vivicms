<?php
require_once('data.php');
$v_config = require_once('../data/config.php');
require_once('checkAdmin.php');
$var_25 = isset($_GET ["id"])?$_GET ["id"]:"";
if($var_25 == ""){
    $v_config["ban_zhizhu_list"] = explode(',', $v_config["ban_zhizhu_list"]);
    echo ADMIN_HEAD; ;
    echo '<body>' . "\r\n" . '<div class="right">' . "\r\n" . '   ';
    include 'welcome.php';
    echo '  <div class="right_main">' . "\r\n" . '  <form action="?id=save" method="post">' . "\r\n" . '  <table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">' . "\r\n\t" . '<tr class="tb_head">  ' . "\r\n\t\t" . '<td colspan="2">' . "\r\n\t\t\t" . '<h2>÷©÷Î∆¡±Œ…Ë÷√</h2>' . "\r\n\t\t" . '</td>' . "\r\n\t" . '</tr>' . "\r\n\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="200"><b>÷©÷Î∆¡±Œø™πÿ</b><br>' . "\r\n\t\t\t" . '<font color="#666666">÷©÷Î∆¡±Œ</font></td>' . "\r\n\t\t\t" . '<td><select name="con[ban_zhizhu_on]">' . "\r\n\t\t\t\t" . '<option value="1" ';
    if ($v_config["ban_zhizhu_on"]) echo 'selected';
    echo '>ø™∆Ù</option>' . "\r\n\t\t\t\t" . '<option value="0" ';
    if (!$v_config["ban_zhizhu_on"]) echo 'selected';
    echo '>πÿ±’</option>' . "\r\n\t\t\t" . '</select></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t" . '<tr class="firstalt">' . "\r\n\t\t" . '<td>' . "\r\n\t\t\t" . '<b>÷©÷Î¡–±Ì</b><br>' . "\r\n\t\t\t" . '<font color="#666666">–Ë“™∆¡±Œµƒ÷©÷Î¥Úπ≥</font>' . "\r\n\t\t" . '</td>  ' . "\r\n\t\t" . '<td>' . "\r\n\t\t\t" . '<label><input type="checkbox" name="ban[]" value="baiduspider" ';
    if (in_array('baiduspider', $v_config["ban_zhizhu_list"])) echo 'checked';
    echo ' />∞Ÿ∂»÷©÷Î</label><br>' . "\r\n\t\t\t" . '<label><input type="checkbox" name="ban[]" value="googlebot" ';
    if (in_array('googlebot', $v_config["ban_zhizhu_list"])) echo 'checked';
    echo ' />π»∏Ë÷©÷Î</label><br>' . "\r\n\t\t\t" . '<label><input type="checkbox" name="ban[]" value="360spider" ';
    if (in_array('360spider', $v_config["ban_zhizhu_list"])) echo 'checked';
    echo ' />360÷©÷Î</label><br>' . "\r\n\t\t\t" . '<label><input type="checkbox" name="ban[]" value="Yisouspider" ';
    if (in_array('Yisouspider', $v_config["ban_zhizhu_list"])) echo 'checked';
    echo ' />…Ò¬ÌÀ—À˜</label><br>' . "\r\n\t\t\t" . '<label><input type="checkbox" name="ban[]" value="soso" ';
    if (in_array('soso', $v_config["ban_zhizhu_list"])) echo 'checked';
    echo ' />soso÷©÷Î</label><br>' . "\r\n\t\t\t" . '<label><input type="checkbox" name="ban[]" value="sogou" ';
    if (in_array('sogou', $v_config["ban_zhizhu_list"])) echo 'checked';
    echo ' />sogou÷©÷Î</label><br>' . "\r\n\t\t\t" . '<label><input type="checkbox" name="ban[]" value="yahoo" ';
    if (in_array('yahoo', $v_config["ban_zhizhu_list"])) echo 'checked';
    echo ' />yahoo÷©÷Î</label><br>' . "\r\n\t\t\t" . '<label><input type="checkbox" name="ban[]" value="msn" ';
    if (in_array('msn', $v_config["ban_zhizhu_list"])) echo 'checked';
    echo ' />msn÷©÷Î</label><br>' . "\r\n\t\t\t" . '<label><input type="checkbox" name="ban[]" value="sohu" ';
    if (in_array('sohu', $v_config["ban_zhizhu_list"])) echo 'checked';
    echo ' />Sohu÷©÷Î</label><br>' . "\r\n\t\t\t" . '<label><input type="checkbox" name="ban[]" value="yodaoBot" ';
    if (in_array('yodaoBot', $v_config["ban_zhizhu_list"])) echo 'checked';
    echo ' />yodao÷©÷Î</label><br>' . "\r\n\t\t\t" . '<label><input type="checkbox" name="ban[]" value="iaskspider" ';
    if (in_array('iaskspider', $v_config["ban_zhizhu_list"])) echo 'checked';
    echo ' />–¬¿À∞ÆŒ </label><br>' . "\r\n\t\t\t" . '<label><input type="checkbox" name="ban[]" value="ia_archiver" ';
    if (in_array('ia_archiver', $v_config["ban_zhizhu_list"])) echo 'checked';
    echo ' />Alexa÷©÷Î</label><br>' . "\r\n\t\t\t" . '<label><input type="checkbox" name="ban[]" value="other" ';
    if (in_array('other', $v_config["ban_zhizhu_list"])) echo 'checked';
    echo ' />∆‰À˚÷©÷Î</label><br>' . "\r\n\t\t" . '</td>' . "\r\n\t" . '</tr>' . "\r\n" . '<script type="text/javascript">' . "\r\n" . 'document.write(submit);' . "\r\n" . '</script>' . "\r\n" . ' </table>' . "\r\n" . '</form>' . "\r\n" . '  </div>' . "\r\n" . '</div>' . "\r\n";
    include 'footer.php';
    echo '</body>' . "\r\n" . '</html>' . "\r\n\r\n";
}elseif ($var_25 == 'save'){
    $var_30 = $_POST["con"];
    foreach($var_30 as $var_5 => $var_31){
        $var_30[$var_5] = trim($var_30[$var_5]);
    }
    $var_30["ban_zhizhu_list"] = @implode(',', $_POST["ban"]);
    $var_30 = @array_merge($v_config, $var_30);
    if($var_30){
        arr2file(VV_DATA . '/config.php', $var_30);
    }
    ShowMsg('πßœ≤ƒ„,–ﬁ∏ƒ≥…π¶£°', '?', 1000);
} ;
echo "\r\n";
?>