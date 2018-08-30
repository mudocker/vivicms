<?php
$tinfo = '';
if($id){
    $file = VV_CONFIG .DS . $id . '.php';
    !is_file($file) and ShowMsg("采集配置文件不存在", '-1', 3000);
    $caiji_config = require_once($file);
    $tinfo = '( 覆盖[' . $caiji_config['name'] . ']？)<input type="hidden" name="id" value="' . $id . '" />';
}
?>
<table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">
    <form action="?ac=saveimport" method="post">
        <tbody><tr nowrap class="tb_head"><td><h2>导入采集规则</h2></td></tr></tbody>
        <tr nowrap class="firstalt">
            <td><b>请在下面输入你要导入的采集配置</b><font color="red"><?php echo $tinfo ?></font>：</td>
        </tr>
        <tr nowrap class="firstalt">
            <td align="center">
                <textarea name="import_text" style="height: 350px;width:95%;padding:5px;background:#eee;"
                          onFocus="onFocus(this)" onBlur="onBlur(this)" ></textarea></td></tr>
        <tbody>
        <tr class="firstalt">
            <td align="center" colspan="2">
                <input type="submit" value=" 提交 " name="submit" class="bginput">&nbsp;&nbsp;
                <input type="button" onclick="history.go(-1);" value=" 返回 " name="Input" class="bginput">
            </td>
        </tr>
        </tbody>
    </form>
</table>