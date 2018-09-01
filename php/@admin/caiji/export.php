<?php
$file = VV_CONFIG .'/'. $id . '.php';
!is_file($file) and ShowMsg("采集配置文件不存在", '-1', 2000);
$caiji_config = require_once($file);
$basecon = "VIVI:" . base64_encode(serialize($caiji_config)) . ":END";
?>
<table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">
    <tbody><tr nowrap class="tb_head"><td><h2>导出采集规则</h2></td></tr></tbody>
    <tr nowrap class="firstalt"><td><b>以下为规则 [<?php echo $caiji_config['name']; ?>] 的配置，你可以共享给你的朋友:</b></td></tr>
    <tr nowrap class="firstalt"><td align="center"><textarea style="height: 350px;width:95%;padding:5px;background:#eee;" onFocus="onfocus(this)" onBlur="onBlur(this)" ><?php echo $basecon; ?></textarea></td></tr>
</table>