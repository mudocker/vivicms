
       <tbody id="config3" style="display:none">
                <tr nowrap class="firstalt">
                    <td colspan="2" align="left">
                        1. 设置的标签可在模板中调用，也可在替换规则中使用<br>
                        2. <font color="red">标签的标识不可重复！！！</font><font color="blue">模板中使用$zdy数组变量进行调用，如：$zdy['标识']</font><br>
                        3. <font color="green">正则截取只获取第一个匹配内容，格式如：&lt;title&gt;(.*)&lt;/title&gt;</font><br>
                        4. <font color="red">注：如没有模板，此处无需设置</font><br>
                    </td>
                </tr>
                <tr class="firstalt">
                    <td colspan="2" align="left">
                        <table cellpadding="3" cellspacing="1" id="quick">
                            <tr class="firstalt">
                                <td width="30" class="title_bg" align="center">编号</td>
                                <td width="100" class="title_bg" align="center">标签名称(中文)</td>
                                <td width="100" align='center'>标识(英文字母)</td>
                                <td width="100" align='center'>类型</td>
                                <td align='center'>设置</td>
                                <td width="50" align="center"><button type="button" class="add">增加</button></td>
                                <td align='center'>&nbsp;</td>
                            </tr>
                            <?php
                            if(empty($caiji_config['zdy'])) $caiji_config['zdy'] = array(array('name' => '', 'ename' => '', 'body' => '',),);
                            foreach($caiji_config['zdy']as $k => $vo){
                                ?>
                                <tr class="firstalt item<?php echo $k; ?>" itemid="<?php echo $k; ?>">
                                    <td align="center"><?php echo $k + 1; ?></td>
                                    <td align="center"><input type="text" name="zdy[<?php echo $k; ?>][name]" style="width:100px" class="input" value="<?php echo _htmlspecialchars($vo['name']); ?>"></td>
                                    <td align='center'><input type="text" name="zdy[<?php echo $k; ?>][ename]" style="width:70px" class="input" value="<?php echo _htmlspecialchars($vo['ename']); ?>"></td>

                                    <td align='center'>
                                        <select name="zdy[<?php echo $k; ?>][type]" onchange="zdytype(this);">
                                            <option value="0"<?php if($vo['type'] == '0')echo " selected"; ?>>自定义内容</option>
                                            <option value="1"<?php if($vo['type'] == '1')echo " selected"; ?>>普通截取</option>
                                            <option value="2"<?php if($vo['type'] == '2')echo " selected"; ?>>正则截取</option>
                                        </select>
                                    </td>

                                    <td align="center">

                                        <div class="zdy_body_<?php echo $k;
                                        ?>"<?php if($vo['type'])echo ' style="display:none"';
                                        ?>><textarea name="zdy[<?php echo $k;
                                            ?>][body]" style="height: 100px; width: 450px" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ><?php echo _htmlspecialchars($vo['body']);
                                                ?></textarea></div>

                                        <div class="zdy_regx_<?php echo $k;
                                        ?>"<?php if($vo['type'] != 2)echo ' style="display:none"';
                                        ?>><textarea name="zdy[<?php echo $k;
                                            ?>][regx]" style="height: 100px; width: 450px" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ><?php echo _htmlspecialchars($vo['regx']);
                                                ?></textarea></div>

                                        <div class="zdy_replace_<?php echo $k;
                                        ?>"<?php if($vo['type'] != 1)echo ' style="display:none"';
                                        ?>>
                                            开始标记 <textarea name="zdy[<?php echo $k;
                                            ?>][start]" style="height: 100px; width: 200px" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ><?php echo _htmlspecialchars($vo['start']);
                                                ?></textarea>
                                            &nbsp;结束标记
                                            <textarea name="zdy[<?php echo $k;
                                            ?>][end]" style="height: 100px; width: 200px" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ><?php echo _htmlspecialchars($vo['end']);
                                                ?></textarea>
                                        </div>
                                    </td>
                                    <td align='center'><a href="javascript:" onclick="deltr(this);">删除</a></td>
                                    <td>&nbsp;</td>
                                </tr>
                            <?php }
                            ?>
                        </table>
                        <script type="text/javascript">
                            function deltr(elem){
                                var itemid=$(elem).parents('tr').attr('itemid');
                                $(elem).parents(".item"+itemid).remove();
                            }
                            function zdytype(_this){
                                var itemid=$(_this).parents('tr').attr('itemid');
                                var id=_this.value;
                                $('.zdy_body_'+itemid).hide();
                                $('.zdy_regx_'+itemid).hide();
                                $('.zdy_replace_'+itemid).hide();
                                if(id=='0'){
                                    $('.zdy_body_'+itemid).fadeIn();
                                }else if(id=='1'){
                                    $('.zdy_replace_'+itemid).fadeIn();
                                }else if(id=='2'){
                                    $('.zdy_regx_'+itemid).fadeIn();
                                }
                            }
                            $(document).ready(function(){
                                $("#quick .add").click(function(){
                                    var id = $("#quick tr").prevAll("tr").length+1;
                                    var input='<tr class="firstalt item'+id+'" itemid="'+id+'">';
                                    input+='<td align="center">'+id+'</td>';
                                    input+='<td align="center"><input type="text" name="zdy['+id+'][name]" style="width:100px" class="input"></td>';
                                    input+='<td align="center"><input type="text" name="zdy['+id+'][ename]" style="width:70px" class="input"></td>';
                                    input+='<td align="center"><select name="zdy['+id+'][type]" onchange="zdytype(this);"><option value="0">自定义内容</option><option value="1">普通截取</option><option value="2">正则截取</option></select></td>';
                                    input+='<td align="center"><div class="zdy_body_'+id+'"><textarea name="zdy['+id+'][body]" style="height: 100px; width: 450px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></textarea></div><div class="zdy_regx_'+id+'" style="display:none"><textarea name="zdy['+id+'][regx]" style="height: 100px; width: 450px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></textarea></div><div style="display:none" class="zdy_replace_'+id+'">开始标记 <textarea name="zdy['+id+'][start]" style="height: 100px; width: 200px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></textarea>&nbsp;结束标记<textarea name="zdy['+id+'][end]" style="height: 100px; width: 200px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></textarea></div></td>';
                                    input+='<td align="center"><a href="javascript:" onclick="deltr(this);">删除</a></td>';
                                    input+='<td>&nbsp;</td></tr>';
                                    $("#quick").append(input);
                                });
                                $("#form").submit(function(e){
                                    $('.firstalt input[type="submit"]').attr('disabled','disabled').val(' 正在保存... ');
                                    $.ajax({
                                        type:"post",
                                        url:"?ac=save&id=<?php echo $id ?>",
                                        data:$("#form").serialize(),
                                        timeout:20000,
                                        dataType:'json',
                                        global:false,
                                        success:function(data){
                                            alert(data.info);
                                            $('.firstalt input[type="submit"]').attr('disabled',false).val(' 提交 ');
                                        }
                                    });
                                    return false;
                                });
                            });
                        </script>
                    </td>
                </tr>
            </tbody>
