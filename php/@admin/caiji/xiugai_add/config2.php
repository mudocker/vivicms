<tbody id="config2" style="display:none">
<tr nowrap class="firstalt">
    <td width="260" valign='top'><b>主体区域截取</b><br>
        <font color="#666666">当只想采集某个区域的时候使用<br>仅支持截取body之间<br><font color="red">一般留空</font></font></td>
    <td>开始标记
        <textarea name="con[body_start]" style="height: 100px; width: 200px" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ><?php echo _htmlspecialchars($caiji_config['body_start']);
            ?></textarea>&nbsp;结束标记
        <textarea name="con[body_end]" style="height: 100px; width: 200px" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ><?php echo _htmlspecialchars($caiji_config['body_end']);
            ?></textarea>
    </td>
</tr>
<tr nowrap class="firstalt">
    <td width="260"><b>标签过滤</b><br>
        <font color="#666666">采集页面时过滤掉这些标签<br><font color="red">慎用</font>,否则将可能出现采集不完整和错位现象</font></td>
    <td>
        <input name="siftags[]" type="checkbox" value="iframe" <?php if(in_array('iframe', $caiji_config['siftags']) || $ac == 'add'){
        ?>checked<?php }
        ?> /> iframe
        <input name="siftags[]" type="checkbox" value="object" <?php if(in_array('object', $caiji_config['siftags']) || $ac == 'add'){
        ?>checked<?php }
        ?> /> object
        <input name="siftags[]" type="checkbox" value="script" <?php if(in_array('script', $caiji_config['siftags'])){
        ?>checked<?php }
        ?> /> script
        <input name="siftags[]" type="checkbox" value="form" <?php if(in_array('form', $caiji_config['siftags'])){
        ?>checked<?php }
        ?> /> form
        <input name="siftags[]" type="checkbox" value="input" <?php if(in_array('input', $caiji_config['siftags'])){
        ?>checked<?php }
        ?> /> input
        <input name="siftags[]" type="checkbox" value="textarea" <?php if(in_array('textarea', $caiji_config['siftags'])){
        ?>checked<?php }
        ?> /> textarea
        <input name="siftags[]" type="checkbox" value="botton" <?php if(in_array('botton', $caiji_config['siftags'])){
        ?>checked<?php }
        ?> /> botton
        <input name="siftags[]" type="checkbox" value="select" <?php if(in_array('select', $caiji_config['siftags'])){
        ?>checked<?php }
        ?> /> select
        <input name="siftags[]" type="checkbox" value="div" <?php if(in_array('div', $caiji_config['siftags'])){
        ?>checked<?php }
        ?> /> div
        <input name="siftags[]" type="checkbox" value="table" <?php if(in_array('table', $caiji_config['siftags'])){
        ?>checked<?php }
        ?> /> table
        <input name="siftags[]" type="checkbox" value="th" <?php if(in_array('tr', $caiji_config['siftags'])){
        ?>checked<?php }
        ?> /> th
        <input name="siftags[]" type="checkbox" value="tr" <?php if(in_array('tr', $caiji_config['siftags'])){
        ?>checked<?php }
        ?> /> tr
        <input name="siftags[]" type="checkbox" value="td" <?php if(in_array('td', $caiji_config['siftags'])){
        ?>checked<?php }
        ?> /> td
        <input name="siftags[]" type="checkbox" value="span" <?php if(in_array('span', $caiji_config['siftags'])){
        ?>checked<?php }
        ?> /> span
        <input name="siftags[]" type="checkbox" value="img" <?php if(in_array('img', $caiji_config['siftags'])){
        ?>checked<?php }
        ?> /> img
        <input name="siftags[]" type="checkbox" value="font" <?php if(in_array('font', $caiji_config['siftags'])){
        ?>checked<?php }
        ?> /> font
        <input name="siftags[]" type="checkbox" value="a" <?php if(in_array('a', $caiji_config['siftags'])){
        ?>checked<?php }
        ?> /> a
        <input name="siftags[]" type="checkbox" value="html" <?php if(in_array('html', $caiji_config['siftags'])){
        ?>checked<?php }
        ?> /> html
        <input name="siftags[]" type="checkbox" value="style" <?php if(in_array('style', $caiji_config['siftags'])){
        ?>checked<?php }
        ?> /> style
    </td>
</tr>
<tr nowrap class="firstalt">
    <td width="260"><b>站内外过滤</b><br>
        <font color="#666666">可过滤站内或站外不必要的链接或文件</font>
    <td>
        <input name="siftags[]" type="checkbox" value="outa" <?php if(in_array('outa', $caiji_config['siftags'])){
        ?>checked<?php }
        ?> /> <font color="red">站外</font>链接
        <input name="siftags[]" type="checkbox" value="outjs" <?php if(in_array('outjs', $caiji_config['siftags'])){
        ?>checked<?php }
        ?> /> <font color="red">站外</font>js文件
        <input name="siftags[]" type="checkbox" value="outcss" <?php if(in_array('outcss', $caiji_config['siftags'])){
        ?>checked<?php }
        ?> /> <font color="red">站外</font>css文件
        <input name="siftags[]" type="checkbox" value="locala" <?php if(in_array('locala', $caiji_config['siftags'])){
        ?>checked<?php }
        ?> /> <font color="blue">站内</font>链接
        <input name="siftags[]" type="checkbox" value="localjs" <?php if(in_array('localjs', $caiji_config['siftags'])){
        ?>checked<?php }
        ?> /> <font color="blue">站内</font>js文件
        <input name="siftags[]" type="checkbox" value="localcss" <?php if(in_array('localcss', $caiji_config['siftags'])){
        ?>checked<?php }
        ?> /> <font color="blue">站内</font>css文件
    </td>
</tr>
<tr class="firstalt">
    <td width="260" valign='top' style="background:#fafafa"><b>字符串替换规则</b><br>
        <font color="#666666">替换前和替换后直接用<font color="red">******</font>分隔<br>每一对替换后面用下面的字符分隔开来<br><font color="red">##########</font><br>例子：<br><div style='padding:5px;border:1px dotted #ff6600;background:#f6f6f6'>我是替换前<font color="red">******</font>我是替换后<br><font color="red">##########</font><br>百度<font color="red">******</font>{web_name}</font><br><font color="red">##########</font></div>
        <div style="margin:8px 0;padding:5px 0;border-top:1px solid #eee;">
            <b>标签说明：</b><br>
            {web_name} -> 网站名称<br>
            {my_url} -> 网站地址<br>
            {web_domain} -> 当前域名<br>
            {web_thisurl} -> 当前页面url<br>
            {web_remark} -> 伪静态标示符<br>
            {ad.广告标识} -> 广告标签<br>
            {zdy.标签} -> 自定义标签<br>
        </div>
        <div style="margin:8px 0;padding:5px 0;border-top:1px solid #eee;">
            <b>页面区分：</b><br>
            在替换规则开头加<br><font color="red">index@@</font>表示只替换首页<br><font color="red">other@@</font>表示只替换内页
        </div>
        </font>
    </td>
    <?php if($ac == 'add' && $caiji_config['replacerules'] == ''){
        $caiji_config['replacerules'] = '/----------------文字替换（本行格式为注释,仅用于方便查看,下同）----------------/
##########
这里可以写替换规则
##########
/----------------图片替换----------------/
##########
这里可以写替换规则
##########
/----------------广告替换----------------/
##########
这里可以写替换规则
##########
/----------------其他替换----------------/
##########
这里可以写替换规则
##########';
    }
    ?>
    <td><textarea name="con[replacerules]" style="height: 450px; width: 750px" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ><?php echo _htmlspecialchars($caiji_config['replacerules']);
            ?></textarea></td>
</tr>
<tr nowrap class="firstalt">
    <td width="260" valign='top'><b>正则替换规则</b><br>
        <font color="#666666">正则替换表达式，一行一个，格式如下：<br>
            <div style='padding:5px;border:1px dotted #ff6600;background:#f6f6f6'>
                <font color="red">{vivi replace='</font>替换后<font color="red">'}</font>正则表达式<font color="red">{/vivi}</font><br>
                <font color="blue">替换后如含有单引号则使用[d]代替如：</font><br>
                <font color="red">{vivi replace='</font>[d]替换后[d]<font color="red">'}</font>正则<font color="red">{/vivi}</font>
            </div>
            <div style="margin:8px 0;padding:5px 0;border-top:1px solid #eee;">
                <b>标签说明：</b><br>同上
            </div>
        </font></td>
    <td><textarea name="con[siftrules]" style="height: 250px; width: 750px" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ><?php echo _htmlspecialchars($caiji_config['siftrules']);
            ?></textarea></td>
</tr>
<tr nowrap class="firstalt">
    <td width="260"><b>开启前置替换</b><br>
        <font color="#666666">替换最开始的代码（即目标站的原始html）<br><font color="red">特殊用途，一般不用开启</font></font></td>
    <td>
        <label><input type="radio" id="replace_before_on" name="con[replace_before_on]" value="1" <?php if($caiji_config['replace_before_on'])echo " checked"; ?> />开启</label>
        <label><input type="radio" id="replace_before_off" name="con[replace_before_on]" value="0" <?php if(!$caiji_config['replace_before_on'])echo " checked"; ?> />关闭</label>
    </td>
</tr>
<tr class="firstalt replace_before_body"<?php if(!$caiji_config['replace_before_on'])echo " style='display:none'"; ?>>
    <td width="260" valign='top'><b>前置字符串替换规则</b><br><font color="#666666">使用方法同上面的替换规则一致</font></td>
    <td>
                    <textarea name="con[replacerules_before]" style="height: 150px; width: 750px" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ><?php echo _htmlspecialchars($caiji_config['replacerules_before']);
                        ?></textarea>
    </td>
</tr>
<tr nowrap class="firstalt replace_before_body"<?php if(!$caiji_config['replace_before_on'])echo " style='display:none'"; ?>>
    <td width="260" valign='top'><b>前置正则替换规则</b><br><font color="#666666"><font color="#666666">使用方法同上面的正则替换规则一致</font></td>
    <td><textarea name="con[siftrules_before]" style="height: 150px; width: 750px" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ><?php echo _htmlspecialchars($caiji_config['siftrules_before']);
            ?></textarea></td>
</tr>
</tbody>