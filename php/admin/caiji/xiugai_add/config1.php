<tbody id="config1">
<tr nowrap class="firstalt">
    <td width="260"><b>项目名</b><br></td>
    <td><input type="text" name="con[name]" size="50" value="<?php echo $caiji_config['name'];
        ?>" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ></td>
</tr>

<tr nowrap class="firstalt">
    <td width="260"><b>目标网站名称</b><br></td>
    <td><input type="text" name="con[from_title]" id="from_title" size="50" value="<?php echo $caiji_config['from_title'];
        ?>" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ></td>
</tr>

<tr nowrap class="firstalt">
    <td width="260"><b>目标站地址</b><br><font color="red">比如：http://www.topthink.com</font></td>
    <td>
        <input type="text" name="con[from_url]" id="from_url" size="50" value="<?php echo $caiji_config['from_url']; ?>" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" >&nbsp;
        <select name="con[charset]" >
            <option value="auto" <?php if($caiji_config['charset'] == 'auto' || empty($caiji_config['charset']))echo " selected"; ?>>自动识别</option>
            <option value="gb2312" <?php if($caiji_config['charset'] == 'gb2312')echo " selected"; ?>>gb2312</option>
            <option value="utf-8" <?php if($caiji_config['charset'] == 'utf-8')echo " selected"; ?>>utf-8</option>
            <option value="gbk" <?php if($caiji_config['charset'] == 'gbk')echo " selected"; ?>>gbk</option>
            <option value="big5" <?php if($caiji_config['charset'] == 'big5')echo " selected"; ?>>big5</option>
        </select>&nbsp;目标站编码</td>
</tr>

<tr nowrap class="firstalt">
    <td width="260"><b>其他域名</b><br>
        <font color="#666666"><div style='padding:5px;border:1px dotted #ff6600;background:#f6f6f6'>如: baidu.com<font color="red">,</font>www.baidu.com</div></font></td>
    <td><input type="text" name="con[other_url]" id="other_url" size="50" value="<?php echo $caiji_config['other_url'];
        ?>" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ></td>
</tr>

<tr nowrap class="firstalt">
    <td width="260"><b>目标站资源域名</b><br>
        <font color="#666666"><div style='padding:5px;border:1px dotted #ff6600;background:#f6f6f6'>如: img1.baidu.com<font color="red">,</font>*.baidu.com</div></font></td>
    <td>
        <input type="text" name="con[resdomain]" id="resdomain" size="50" value="<?php echo $caiji_config['resdomain']; ?>"
               onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" >
    </td>
</tr>

<tr nowrap class="firstalt">
    <td width="260"><b>图片属性名称</b><br>
        <font color="#666666"><div style='padding:5px;border:1px dotted #ff6600;background:#f6f6f6'>如: data-src<font color="red">,</font>_src</div></font></td>
    <td><input type="text" name="con[img_delay_name]" size="50" value="<?php echo $caiji_config['img_delay_name'];
        ?>" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" > <font color="red">一般不用设置</font></td>
</tr>

<tr nowrap class="firstalt">
    <td width="260"><b>目标站搜索地址</b><br></td>
    <td><input type="text" name="con[search_url]" id="search_url" size="50" value="<?php echo $caiji_config['search_url']; ?>"
               onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" >&nbsp;<select name="con[search_charset]" >
            <option value="gb2312" <?php if($caiji_config['search_charset'] == 'gb2312' || empty($caiji_config['search_charset']))echo " selected"; ?>>gb2312</option>
            <option value="utf-8" <?php if($caiji_config['search_charset'] == 'utf-8')echo " selected"; ?>>utf-8</option>
            <option value="gbk" <?php if($caiji_config['search_charset'] == 'gbk')echo " selected"; ?>>gbk</option>
            <option value="big5" <?php if($caiji_config['search_charset'] == 'big5')echo " selected"; ?>>big8</option>
        </select>&nbsp;搜索页面的编码</td>
</tr>

<tr nowrap class="firstalt">
    <td width="260"><b>屏蔽js错误</b><br>
        <font color="#666666">是否屏蔽js错误</font></td>
    <td>
        <select name="con[hidejserror]" >
            <option value="0" <?php if($caiji_config['hidejserror'] == '0')echo " selected"; ?>>关闭</option>
            <option value="1" <?php if($caiji_config['hidejserror'])echo " selected"; ?>>开启</option>
        </select>
    </td>
</tr>

<tr nowrap class="firstalt">
    <td width="260"><b>禁止移动搜索转码</b><br>
        <font color="#666666">此选项可禁止百度移动搜索转码</font></td>
    <td>
        <select name="con[no_siteapp]" >
            <option value="0" <?php if($caiji_config['no_siteapp'] == '0')echo " selected"; ?>>关闭</option>
            <option value="1" <?php if($caiji_config['no_siteapp'])echo " selected"; ?>>开启</option>
        </select>
    </td>
</tr>

<tr nowrap class="firstalt">
    <td width="260" valign='top'><b>使用说明</b><br>
        <font color="#666666">填写作者信息、使用协议或说明、注意事项</font></td>
    <td><textarea name="con[licence]" style="height: 80px; width: 550px" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ><?php echo _htmlspecialchars($caiji_config['licence']);
            ?></textarea></td>
</tr>

</tbody>