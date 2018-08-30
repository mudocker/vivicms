<?php
$dir = VV_CONFIG ;
$filearr = scandirs($dir);
$temp = array();
foreach($filearr as $file){
    if($file <> '.' && $file <> '..'){
        if(is_file("$dir/$file")){
            if(!preg_match('#^\d+\.php$#', $file)){
                continue;
            }
            $thisid = str_replace('.php', '', $file);
            $file = VV_DATA . '/config/' . $file;
            $caiji_config = require_once($file);
            $temp[] = array_merge($caiji_config, array('id' => $thisid));
        }
    }
}
foreach($temp as $key => $row){
    $volume[$key] = $row['id'];
}
@array_multisort($volume, SORT_DESC, $temp);
if(!checktime_log_timeout())$temp = array_slice($temp, 0, 2);
?>
<table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">
    <tbody>
    <tr nowrap class="tb_head">
        <td colspan="8">采集节点管理&nbsp;&nbsp;-&nbsp;<a href="?ac=add" style='color:red'>添加</a>&nbsp;-&nbsp;<a href="?ac=import" style='color:red'>导入</a>&nbsp;-&nbsp;<a href="http://www.vxiaotou.com" target="_blank" style='color:red'>获取更多规则</a>
        </td>
    </tr>
    </tbody>
    <tr nowrap class="firstalt">
        <td colspan="8"><font color="#dd00b0">注：采集开关为关闭时，将停止采集仅使用缓存！</font></td>
    </tr>
    <?php if(!checktime_log_timeout()){
        ?>
        <tr nowrap class="firstalt">
            <td colspan="8" align="center"><font color="blue">未授权只能有2条规则</font></td>
        </tr>
    <?php }
    ?>
    <tr nowrap class="firstalt">
        <td width="60" align="center">默认</td>
        <td width="50" align="center">ID</td>
        <td align="center">节点名称</td>
        <td width="70" align="center">采集开关</td>
        <td width="70" align="center">说明(点击↓↓)</td>
        <td width="100" align="center">编码</td>
        <td width="130" align="center">修改时间</td>
        <td width="250" align="center">操作</td>
    </tr>
    <?php if($temp){
        foreach($temp as $k => $vo){
            ?>
            <tr nowrap class="firstalt">
                <td width="60" align="center"><?php echo $vo['id'] == $v_config['collectid']?'<font color="red">默认节点</font>':'<a href="?ac=savecollectid&collectid=' . $vo['id'] . '&sid=0" title="点击设为默认节点">设为默认</a>';
                    ?></td>
                <td width="50" align="center"><?php echo $vo['id'] ?></td>
                <td style="padding-left:20px">
                    <a href="?ac=xiugai&id=<?php echo $vo['id'] ?>"><?php echo $vo['name'] ?></a>
                </td>
                <td align="center">
                    <?php echo $vo['collect_close']?'<a href="?ac=status&collectid=' . $vo['id'] . '&sid=0" title="点击开启"><font color="red">已关闭</font></a>':'<a href="?ac=status&collectid=' . $vo['id'] . '&sid=1" title="点击关闭"><font color="green">已开启</font></a>'; ?>
                </td>
                <td width="100" align="center">
                    <a href="javascript:" onclick='alert("<?php echo!empty($vo['licence'])?str_replace(array("\r\n", "\r", "\n"), '\\n', $vo['licence']):'无'; ?>");'>点我</a>
                </td>
                <td width="100" align="center">
                    <?php echo $vo['charset'] ?>
                </td>
                <td width="150" align="center">
                    <?php echo date('Y-m-d H:i:s', $vo['time']) ?>
                </td>
                <td width="200" align="center">
                    <a target="_blank" href="?ac=yulan&collectid=<?php echo $vo['id'] ?>">预览源代码</a>&nbsp;&nbsp;<a href="?ac=xiugai&id=<?php echo $vo['id'] ?>">修改</a>&nbsp;&nbsp;
                    <a href="?ac=export&id=<?php echo $vo['id'] ?>">导出</a>&nbsp;&nbsp;
                    <a href="?ac=import&id=<?php echo $vo['id'] ?>">导入</a>&nbsp;&nbsp;<a href="?ac=del&id=<?php echo $vo['id'] ?>" onClick="return confirm('确定删除?')">删除</a>
                </td>
            </tr>
        <?php }
    }else{
        ?>
        <tr nowrap class="firstalt">
            <td colspan="8" align="center">没有找到采集节点！</td>
        </tr>
    <?php }
    ?>

</table>