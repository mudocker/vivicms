<tbody id="config5" style="display:none">
<tr nowrap class="firstalt">
    <td width="260"><b>繁简互转</b> <br><font color="#666666">繁体简体中文之间互转，影响速度</font></td>
    <td>
        <select name="con[big52gbk]" >
            <option value="togbk" <?php if($caiji_config['big52gbk'] == 'togbk')echo " selected"; ?>>繁转简</option>
            <option value="tobig5" <?php if($caiji_config['big52gbk'] == 'tobig5')echo " selected"; ?>>简转繁</option>
            <option value="0" <?php if(!$caiji_config['big52gbk'])echo " selected"; ?>>关闭</option>
        </select>
    </td>
</tr>
<tr nowrap class="firstalt">
    <td width="260"><b>伪原创开关</b><br></td>
    <td>
        <select name="con[replace]" >
            <option value="1" <?php if($caiji_config['replace'])echo " selected"; ?>>开启</option>
            <option value="0" <?php if(!$caiji_config['replace'])echo " selected"; ?>>关闭</option>
        </select>
    </td>
</tr>
<tr nowrap class="firstalt">
    <td width="260"><b>伪静态开关</b> <br></td>
    <td>
        <select name="con[rewrite]" >
            <option value="1" <?php if($caiji_config['rewrite'])echo " selected"; ?>>开启</option>
            <option value="0" <?php if(!$caiji_config['rewrite'])echo " selected"; ?>>关闭</option>
        </select>
    </td>
</tr>
<tr nowrap class="firstalt">
    <td width="260"><b>模板文件名</b><br>
        <font color="#666666">将模板上传到template文件夹内<br>然后填写其文件名，<font color="red">一般留空</font></font></td>
    <td><input type="text" name="con[tplfile]" id="tplfile" size="10" value="<?php echo $caiji_config['tplfile'];
        ?>" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" > 留空则默认为index.html</td>
</tr>
<?php $plusArr = array();
if($caiji_config['plus']){
    $plusArr = explode(',', $caiji_config['plus']);
}
if(is_dir(VV_DATA . '/plus')){
    $arr = scandirs(VV_DATA . '/plus');
    unset($arr[0], $arr[1]);
}
?>
<style type="text/css">
    .custom-header{
        text-align: center;
        padding: 3px;
        background: #000;
        color: #fff;
    }
</style>
<tr nowrap class="firstalt">
    <td width="260"><b>使用插件</b><br>
        <font color="#666666">插件位于/data/plus/文件夹<br>编写方法看示例</td>
    <td><select name="con[plus][]" multiple='multiple' class="selectmultiple">
            <?php if($arr){
                define('VV_PLUS', true);
                $dir = VV_DATA . '/plus';
                foreach($arr as $k => $vo){
                    $plusfile = $dir . '/' . $vo . '/' . $vo . '.class.php';
                    if(!is_dir($dir . '/' . $vo) || !is_file($plusfile)) continue;
                    require_once($plusfile);
                    $plusclass = new $vo;
                    $plusinfo = $plusclass -> info;
                    ?>
                    <option value="<?php echo $vo; ?>"<?php if(in_array($vo, $plusArr))echo " selected"; ?>><?php echo $plusinfo['name'];?></option>
                <?php }
            }
            ?>
        </select>
        <script type="text/javascript">$('.selectmultiple').multiSelect({ keepOrder: true,selectableHeader: "<div class='custom-header'>未使用的插件</div>",selectionHeader: "<div class='custom-header'>正在使用的插件</div>" });</script>
    </td>
</tr>
</tbody>