<tbody id="config6" style="display:none">
            <tr nowrap class="firstalt">
                <td width="260"><b>自定义cookie</b><br><font color="#666666">使用该cookie访问目标站<br>一般用于需要登陆才能采集的站点</font></td>
                <td><textarea name="con[cookie]" style="height: 100px; width: 550px" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ><?php echo _htmlspecialchars($caiji_config['cookie']);
                    ?></textarea>
                </td>
            </tr>
            <tr nowrap class="firstalt">
                <td width="260"><b>自定义浏览器标识（user-agent）</b><br><font color="#666666">可伪造浏览器，伪造蜘蛛爬行</font></td>
                <td><input type="text" name="con[user_agent]" id="user_agent" style="width:300px;" value="<?php echo $caiji_config['user_agent']; ?>"
                           onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" >&nbsp;
                    <select onchange="$('#user_agent').val(this.value);">
                        <option value="">自定义</option>
                        <option value="Baiduspider/2.0+(+http://www.baidu.com/search/spider.htm)" <?php if($caiji_config['user_agent'] == 'Baiduspider/2.0+(+http://www.baidu.com/search/spider.htm)')echo " selected";
                        ?>>模拟百度蜘蛛</option>
                        <option value="Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)" <?php if($caiji_config['user_agent'] == 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)')echo " selected";
                        ?>>模拟谷歌蜘蛛</option>
                    </select>
                </td>
            </tr>
            <tr nowrap class="firstalt">
                <td width="260"><b>自定义来路</b><br><font color="#666666">伪造来路，不填写则自动伪造为目标站url</font></td>
                <td>
                    <input type="text" name="con[referer]" style="width:300px;" value="<?php echo $caiji_config['referer']; ?>"
                           onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" >
                </td>
            </tr>
            <tr nowrap class="firstalt">
                <td width="260"><b>自定义IP</b><br><font color="#666666">自定义IP格式 127.0.0.1<br>代理IP的格式 127.0.0.1:8080@user:pass
                        <br><br>
                        <div style='padding:5px;border:1px dotted #ff6600;background:#f6f6f6'>
                            <font color="black">如有多个代理IP，可保存为txt文件上传到目录</font><br>
                            <font color="blue">选代理IP，填写txt路径如：/data/daili.txt<br>
                                txt每行一个代理，格式如下：<br></font>
                            <font color="red">127.0.0.1:8081</font><br>
                            <font color="red">127.0.0.1:8080@user:pass</font><br>...
                        </div>
                        <br>
                        <?php if(function_exists('curl_init') && function_exists('curl_exec')){
                            echo '<font color="green">你的空间支持curl，支持代理IP功能</font>';
                        }else{
                            echo '<font color="red">你的空间不支持curl，不能使用代理IP功能</font>';
                        }
                        ?>


                    </font></td>
                <td><input type="text" name="con[ip]" style="width:300px;" value="<?php echo $caiji_config['ip'];
                    ?>" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" >&nbsp;
                    <select name="con[ip_type]">
                        <option value="1"<?php if($caiji_config['ip_type'] == 1)echo " selected";
                        ?>>自定义IP</option>
                        <option value="2"<?php if($caiji_config['ip_type'] == 2)echo " selected";
                        ?>>随机IP</option>
                        <option value="3"<?php if($caiji_config['ip_type'] == 3)echo " selected";
                        ?>>代理IP</option>
                    </select>
                </td>
            </tr>
</tbody>